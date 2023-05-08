<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Hash;

/**
 * Orders Controller
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('order'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $this->set(compact('order'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $this->set(compact('order'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Function for checkout a order
     *
     * @return void
     */
    public function checkout()
    {
        $this->Books = $this->fetchTable('Books');
        $this->Counties = $this->fetchTable('Counties');
        $this->Users = $this->fetchTable('Users');

        $session = $this->getRequest()->getSession();
        $cart = $session->read('Cart');

        $identity = $this->request->getAttribute('identity');
        $user_id = $identity ? $identity->get('id') : '';

        if ($user_id) {
            $user = $this->Users->get($user_id);

            $county = $this->Counties->find()
                ->where(['name' => $user->county])
                ->first();

            if (!empty($county)) {
                $cities = $this->getTableLocator()->get('Cities')->find()
                            ->where(['county_id' => $county->id])
                            ->order(['name' => 'ASC'])
                            ->toArray();
                $cities = Hash::combine($cities, '{n}.name', '{n}.name');
                $this->set('cities', $cities);
            }
        } else {
            $user = '';
            $county = '';
        }

        if (isset($cart['Books'])) {
            foreach ($cart['Books'] as $bookId => $cartBook) {
                $book = $this->Books->get($bookId);
                $cartItems[] = [
                    'book' => $book,
                    'quantity' => $cartBook['quantity']
                ];
            }
        }

        $counties = $this->Counties->find()
            ->all()
            ->toArray();

        $counties = Hash::combine($counties, '{n}.name', '{n}.name');

        $this->set(compact('cart', 'cartItems', 'counties', 'user', 'county'));
        return;
    }

    /**
     * Place a order function
     *
     * @return void
     */
    public function placeOrder()
    {
        $this->autoRender = false;
        $this->Books = $this->fetchTable('Books');
        $this->OrdersBooks = $this->fetchTable('OrdersBooks');
        $this->OrderUserDatas = $this->fetchTable('OrderUserDatas');
        $this->Users = $this->fetchTable('Users');
        $order = $this->Orders->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $session = $this->request->getSession();
            $cart = $session->read('Cart');
            if (!empty($data['user_id'])) {
                $order->user_id = $data['user_id'];
            } elseif ($data['user_id'] == '' && $data['create_account'] == 1) {
                $user = $this->Users->newEmptyEntity();
                $user->group_id = 2;
                $user->username = $data['username'];
                $user->password = $data['password'];
                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->email = $data['email'];
                $user->country = $data['country'];
                $user->county = $data['county'];
                $user->city = $data['city'];
                $user->street = $data['street'];

                $this->Users->save($user);

                $order->user_id = $user->id;
            } else {
                $order->user_id = 0;
            }
            $order->total_price = $cart['total'];

            if ($this->Orders->save($order)) {
                $i = 0;
                $ordersBooks = [];
                foreach ($cart['Books'] as $book) {
                    $bookObj = $this->Books->get($book['id']);
                    $ordersBooks[$i]['order_id'] = $order->id;
                    $ordersBooks[$i]['book_id'] = $book['id'];
                    $ordersBooks[$i]['quantity'] = $book['quantity'];
                    $ordersBooks[$i]['price'] = $book['price'];
                    $ordersBooks[$i]['name'] = $bookObj->title;
                    $i++;
                }
                $entities = $this->OrdersBooks->newEntities($ordersBooks);
                $this->OrdersBooks->saveMany($entities);

                $orderUserData = $this->OrderUserDatas->newEmptyEntity();

                $orderUserData->order_id = $order->id;
                $orderUserData->first_name = $data['first_name'];
                $orderUserData->last_name = $data['last_name'];
                $orderUserData->email = $data['email'];
                $orderUserData->country = $data['country'];
                $orderUserData->county = $data['county'];
                $orderUserData->city = $data['city'];
                $orderUserData->street = $data['street'];

                $this->OrderUserDatas->save($orderUserData);

                $session = $this->request->getSession();
                $session->delete('Cart');

                $this->Flash->success(__('Your order has been placed.'));
                $this->redirect(['controller' => 'Pages', 'action' => 'shop']);
                return;
            }
        }
        return;
    }
}
