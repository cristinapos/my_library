<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Carts Controller
 *
 * @method \App\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Books = $this->fetchTable('Books');

        $session = $this->request->getSession();
        $cart = $session->read('Cart') ?? [
            'Books' => [],
            'itemCount' => 0,
            'total' => 0,
        ];

        $cartItems = [];
        $books = [];

        if (isset($cart['Books'])) {
            foreach ($cart['Books'] as $bookId => $cartBook) {
                $book = $this->Books->get($bookId);
                $cartItems[] = [
                    'book' => $book,
                    'quantity' => $cartBook['quantity']
                ];
            }
        }

        $totalPrice = $cart['total'];
        $this->set(compact('cartItems', 'totalPrice'));
    }

    /**
     * Function that update the cart items
     *
     * @param integer $bookId
     * @param integer $quantity
     * @return void
     */
    public function update(int $bookId, int $quantity): void
    {
        $this->autoRender = false;
        $session = $this->request->getSession();
        $cart = $session->read('Cart') ?? [
            'Books' => [],
            'itemCount' => 0,
            'total' => 0,
        ];

        if (!isset($cart['Books'])) {
            $cart['Books'] = [];
        }

        if (array_key_exists($bookId, $cart['Books'])) {
            $cart['Books'][$bookId]['quantity'] = $quantity;

            $itemCount = 0;
            $total = 0;
            foreach ($cart['Books'] as $book) {
                $itemCount += $book['quantity'];
                $total += $book['quantity'] * $book['price'];
            }
            $cart['itemCount'] = $itemCount;
            $cart['total'] = $total;

            $session->write('Cart', $cart);
            $session->write('Cart.itemCount', $itemCount);
            $session->write('Cart.total', $total);
        }
        return;
    }

    /**
     * Add to cart function
     *
     * @param integer $bookId
     * @param integer $quantity
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(int $bookId, int $quantity = 1)
    {
        $this->autoRender = false;
        $this->Books = $this->fetchTable('Books');

        $session = $this->request->getSession();
        $book = $this->Books->get($bookId);
        $cart = $session->read('Cart') ?? [
            'Books' => [],
            'itemCount' => 0,
            'total' => 0,
        ];

        if (!isset($cart['Books'])) {
            $cart['Books'] = [];
        }

        if (array_key_exists($bookId, $cart['Books'])) {
            $cart['Books'][$bookId]['quantity'] += $quantity;
            $cart['Books'][$bookId]['price'] = $cart['Books'][$bookId]['price'] * $quantity;
        } else {
            $cart['Books'][$bookId]['id'] = $bookId;
            $cart['Books'][$bookId]['quantity'] = $quantity;
            $cart['Books'][$bookId]['price'] = $book->price;
        }

        $total = 0;
        foreach ($cart['Books'] as $book) {
            $total += $book['price'] * $book['quantity'];
        }
        $cart['total'] = $total;

        $session->write('Cart', $cart);

        $itemCount = $this->getRequest()->getSession()->read('Cart.itemCount');
        $this->getRequest()->getSession()->write('Cart.itemCount', $itemCount + 1);
        $this->Flash->success('Book was successfully added to your cart.');
        $this->redirect($this->referer());
        return;
    }

    /**
     * Function that remove books from cart
     *
     * @param integer $bookId
     * @return void
     */
    public function remove(int $bookId): void
    {
        $session = $this->request->getSession();
        $cart = $session->read('Cart') ?? [];
        if (isset($cart['Books'][$bookId])) {
            $quantity = $cart['Books'][$bookId]['quantity'];
            unset($cart['Books'][$bookId]);
            $session->write('Cart', $cart);

            $itemCount = $session->read('Cart.itemCount');
            $session->write('Cart.itemCount', $itemCount - $quantity);

            $this->Flash->success('Book was successfully removed from your cart.');
        } else {
            $this->Flash->error('Book could not be removed from your cart.');
        }
        $this->redirect($this->referer());
        return;
    }
}
