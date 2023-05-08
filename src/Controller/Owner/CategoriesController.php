<?php
declare(strict_types=1);

namespace App\Controller\Owner;

use App\Controller\AppController;
use Cake\Http\Exception\ForbiddenException;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
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
            'conditions' => ['Categories.user_id'=> $user_id]
        ];
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));
    }

    /**
     * View method
     *
     * @param integer $id Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $user_id = $this->request->getAttribute('identity')->get('id');

        $category = $this->Categories->find()
            ->where(['Categories.id' => $id, 'Categories.user_id' => $user_id])
            ->contain(['Users', 'Books'])
            ->first();

        if ($category == null) {
            throw new ForbiddenException(__('The record has not been found.'));
        }

        $this->set(compact('category'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $category = $this->Categories->newEmptyEntity();
        $user_id = $this->request->getAttribute('identity')->get('id');
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $user_id;
            $category = $this->Categories->patchEntity($category, $data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
    }

    /**
     * Edit method
     *
     * @param integer $id Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $user_id = $this->request->getAttribute('identity')->get('id');
        $users = $this->Categories->Users->find('list')
        ->where(['Users.id' => $user_id])
        ->all();
        $this->set(compact('category', 'users'));
    }

    /**
     * Delete method
     *
     * @param integer $id Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
