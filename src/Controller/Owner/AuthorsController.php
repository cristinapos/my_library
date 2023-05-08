<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;

/**
 * Authors Controller
 *
 * @property \App\Model\Table\AuthorsTable $Authors
 * @method \App\Model\Entity\Author[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuthorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $user_id = $this->request->getAttribute('identity')->get('id');
        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => ['Authors.user_id'=> $user_id],
            'order' => [
                'Authors.name' => 'asc'
            ]
        ];

        $authors = $this->paginate($this->Authors);

        $this->set(compact('authors'));
    }

    /**
     * View method
     *
     * @param integer $id Author id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(int $id = null)
    {
        $this->Authorization->skipAuthorization();

        $user_id = $this->request->getAttribute('identity')->get('id');

        $author = $this->Authors->find()
            ->where(['Authors.id' => $id, 'Authors.user_id' => $user_id])
            ->contain(['Users', 'Books'])
            ->first();

        if ($author == null) {
            throw new ForbiddenException(__('The record has not been found.'));
        }

        $this->set(compact('author'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $author = $this->Authors->newEmptyEntity();
        if ($this->request->is('post')) {
            $author = $this->Authors->patchEntity($author, $this->request->getData());
            if ($this->Authors->save($author)) {
                $this->Flash->success(__('The author has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The author could not be saved. Please, try again.'));
        }
        $user_id = $this->request->getAttribute('identity')->get('id');
        $users = $this->Authors->Users->find('list')
        ->where(['Users.id' => $user_id])
        ->all();
        $this->set(compact('author', 'users'));
    }

    /**
     * Edit method
     *
     * @param integer $id Author id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $author = $this->Authors->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $author = $this->Authors->patchEntity($author, $this->request->getData());
            if ($this->Authors->save($author)) {
                $this->Flash->success(__('The author has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The author could not be saved. Please, try again.'));
        }
        $user_id = $this->request->getAttribute('identity')->get('id');
        $users = $this->Authors->Users->find('list')
        ->where(['Users.id' => $user_id])
        ->all();
        $this->set(compact('author', 'users'));
    }

    /**
     * Delete method
     *
     * @param integer $id Author id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $author = $this->Authors->get($id);
        if ($this->Authors->delete($author)) {
            $this->Flash->success(__('The author has been deleted.'));
        } else {
            $this->Flash->error(__('The author could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
