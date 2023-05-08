<?php
declare(strict_types=1);

namespace App\Controller\Owner;

use App\Controller\AppController;
use Cake\Http\Exception\ForbiddenException;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user_id = $this->request->getAttribute('identity')->get('id');
        $this->paginate = [
            'contain' => ['Categories', 'Authors', 'Tags', 'Users'],
            'conditions' => ['Books.user_id'=> $user_id],
            'limit' => '5',
            'order' => [
                'Books.created' => 'desc'
            ]
        ];

        $books = $this->paginate($this->Books);

        $this->set(compact('books'));
        $this->Authorization->skipAuthorization();
    }

    /**
     * View method
     *
     * @param integer $id Book id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(int $id = null)
    {
        $user_id = $this->request->getAttribute('identity')->get('id');

        $book = $this->Books->find()
            ->where(['Books.id' => $id, 'Books.user_id' => $user_id])
            ->contain(['Categories', 'Authors', 'Tags', 'Users'])
            ->first();

        if ($book == null) {
            throw new ForbiddenException(__('The record has not been found.'));
        }

        $this->set(compact('book'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->request->getAttribute('identity')->get('id');
        $book = $this->Books->newEmptyEntity();
        $this->Authorization->skipAuthorization();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($data['image']->getError() === UPLOAD_ERR_NO_FILE) {
                $data['image'] = '1.jpg';
            } else {
                $image = $data['image'];

                $name = $image->getClientFilename();

                $image->moveTo(WWW_ROOT . 'img' . DS . $name);
                $data['image'] = $name;
            }
            $data['user_id'] = $user_id;
            $book = $this->Books->patchEntity($book, $data);
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }

        $categories = $this->Books->Categories->find('list')
        ->where(['Categories.user_id' => $user_id])
        ->all();

        $authors = $this->Books->Authors->find('list')
        ->where(['Authors.user_id' => $user_id])
        ->all();

        $tags = $this->Books->Tags->find('list')
        ->where(['Tags.user_id' => $user_id])
        ->all();

        $this->set(compact('book', 'categories', 'authors', 'tags'));
    }

    /**
     * Edit method
     *
     * @param integer $id Book id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $book = $this->Books->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $image = $data['image'];

            if ($image->getError() == 0) {
                $data = $this->request->getData();
                $image = $data['image'];
                $name = $image->getClientFilename();
                $image->moveTo(WWW_ROOT . 'img' . DS . $name);
                $data['image'] = $name;
            } else {
                unset($data['image']);
            }

            $book = $this->Books->patchEntity($book, $data);
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['controller'=> 'Books','action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $user_id = $this->request->getAttribute('identity')->get('id');
        $users = $this->Books->Users->find('list')
        ->where(['Users.id' => $user_id])
        ->contain(['Categories', 'Authors', 'Tags'])
        ->all();
        $categories = $this->Books->Categories->find('list')
        ->where(['Categories.user_id' => $user_id])
        ->all();
        $authors = $this->Books->Authors->find('list')
        ->where(['Authors.user_id' => $user_id])
        ->all();
        $tags = $this->Books->Tags->find('list')
        ->where(['Tags.user_id' => $user_id])
        ->all();
        $this->set(compact('book', 'categories', 'authors', 'tags', 'users'));
    }

    /**
     * Delete method
     *
     * @param integer $id Book id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);

        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
