<?php
declare(strict_types=1);

namespace App\Controller\Owner;

use App\Controller\AppController;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
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
        $user_id = $this->request->getAttribute('identity')->get('id');
        $group_id = $this->request->getAttribute('identity')->get('group_id');

        if ($group_id == 1) {
            $this->paginate = [];
        } else {
            $this->paginate = [
                'contain' => ['Users'],
                'conditions' => ['Orders.user_id' => $user_id]
            ];
        }

        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
    }
}
