<?php
declare(strict_types=1);

namespace App\Controller\Owner;

use App\Controller\AppController;
use Cake\Http\Exception\ForbiddenException;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController
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
            'conditions' => ['Tags.user_id'=> $user_id]
        ];
        $tags = $this->paginate($this->Tags);

        $this->set(compact('tags'));
    }

    /**
     * View method
     *
     * @param integer $id Tag id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $user_id = $this->request->getAttribute('identity')->get('id');

        $tag = $this->Tags->find()
            ->where(['Tags.id' => $id, 'Tags.user_id' => $user_id])
            ->contain(['Users', 'Books'])
            ->first();

        if ($tag == null) {
            throw new ForbiddenException(__('The record has not been found.'));
        }

        $this->set(compact('tag'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $tag = $this->Tags->newEmptyEntity();
        $user_id = $this->request->getAttribute('identity')->get('id');
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $user_id;
            $tag = $this->Tags->patchEntity($tag, $data);
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }

        $this->set(compact('tag'));
    }

    /**
     * Edit method
     *
     * @param integer $id Tag id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $tag = $this->Tags->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The location has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The location could not be saved. Please, try again.'));
        }

        $this->set(compact('tag'));
    }

    /**
     * Delete method
     *
     * @param integer $id Tag id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(int $id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
