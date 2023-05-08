<?php
declare(strict_types=1);

namespace App\Controller\Owner;

use App\Controller\AppController;
use Cake\Mailer\Mailer;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Http\Cookie\Cookie;
use Cake\I18n\FrozenTime;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $open_actions = ['login', 'logout', 'activate', 'recoverPassword', 'resetPassword', 'setupAdmin', 'add', 'forgot', 'messageforgot'];

        $this->Authentication->allowUnauthenticated($open_actions);

        if (in_array($this->request->getParam('action'), $open_actions)) {
            $this->Authorization->skipAuthorization();
        }
        $this->Authentication->addUnauthenticatedActions(['forgot', 'resetpassword', 'messageforgot']);
    }

    /**
     * Function to display the dashboard
     *
     * @return void
     */
    public function index(): void
    {
        $this->Authorization->skipAuthorization();
        return;
    }

    /**
     * View method
     *
     * @param integer $id
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(int $id = null): void
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->get($id, [
            'contain' => [ 'Books'],
        ]);

        $this->set(compact('user'));
        return;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->skipAuthorization();
        if ($this->request->is('post')) {
            $group1User = $this->Users->find()
                ->where(['group_id' => 1])
                ->first();
            $data = $this->request->getData();

            if ($group1User) {
                $data = $this->request->getData();
                $data['group_id'] = 2;
            } else {
                $data = $this->request->getData();
                $data['group_id'] = 1;
            }

            $user = $this->Users->patchEntity($user, $data, [
                'validate' => 'register',
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set('user', $user);
        return null;
    }

    /**
     * Edit function
     *
     * @param integer $id User id
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loggedUserId = $this->request->getAttribute('identity')->getIdentifier();
        $this->Authorization->skipAuthorization();
        $user = $this->Users->get($loggedUserId);

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

            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->save($user)) {
                $session = $this->request->getSession();
                $session->write('Auth', $user);

                return $this->redirect(['controller'=> 'Users', 'action' => 'edit']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        return null;
    }

    /**
     * Delete method
     *
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $loggedUserId = $this->request->getAttribute('identity')->getIdentifier();
        $this->Authorization->skipAuthorization();
        $user = $this->Users->get($loggedUserId);

        if ($this->request->is(['post', 'delete'])) {
            $data = $this->request->getData();

            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->delete($user)) {
                $session = $this->request->getSession();
                $session->destroy();
            } else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
        }
        return $this->redirect(['controller'=> 'Users', 'action' => 'logout']);
    }

    /**
     * Fuction that display the users profile with group_id = 2
     *
     * @param integer $id
     * @return void
     */
    public function profile(int $id): void
    {
        $this->Authorization->skipAuthorization();
    }

    /**
    * Handles user login.
    *
    * @return \Cake\Http\Response|null Redirects on successful login, renders view otherwise.
    */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        $this->Authorization->skipAuthorization();

        if ($this->request->is('post') && $result->isValid()) {
            $loginData = [
                'user_id' => $result->getData()->id,
                'ip' => $this->request->clientIp(),
                'timestamp' => new FrozenTime()
            ];
            $this->UserLogins = $this->fetchTable('UserLogins');

            $userLogin = $this->UserLogins->newEmptyEntity();
            $userLogin = $this->UserLogins->patchEntity($userLogin, $loginData);
            $this->UserLogins->save($userLogin);
        }
        if ($result->isValid() && $result->getData()->group_id == 1) {
            $redirect = $this->request->getQuery('redirect', [
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        } elseif ($result->isValid() && $result->getData()->group_id == 2) {
            $userId = $result->getData()->id;
            $redirect = ['controller' => 'Users', 'action' => 'profile', $userId];

            return $this->redirect($redirect);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }

        $this->viewBuilder()->setLayout('owner_login');
        return null;
    }


    public function forgot($recovery_hash = null)
    {
        $this->Authorization->skipAuthorization();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->find()
                ->where(['email' => $this->request->getData('email')])
                ->first();
            if (!is_null($user)) {
                $data['recovery_hash'] = substr(md5((string) rand(0, 10)), 0, 10);
                $recovery_hash = $data['recovery_hash'];
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $message = 'In order to reset your password please <a href="http://library.local/owner/users/resetpassword/'.$recovery_hash.'">click this link</a> to reset your password.';

                    $mailer = new Mailer('default');
                    $mailer->setFrom(['info@mysite.com' => 'My Site'])
                        ->setTo($user['email'])
                        ->setSubject('Forgot password')
                        ->setEmailFormat('html')
                        ->deliver($message);

                        return $this->redirect(['controller'=> 'Users', 'action' => 'messageforgot']);
                }
            }
        }
    }

    /**
     * Function that display a forgot password layout
     *
     * @return void
     */
    public function messageforgot(): void
    {
        $this->Authorization->skipAuthorization();
        return;
    }

    /**
     * Reset password method
     *
     * @param string $recovery_hash
     * @return \Cake\Http\Response|null Redirects on successful login, renders view otherwise.
     */
    public function resetpassword($recovery_hash = null)
    {
        $this->Authorization->skipAuthorization();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $user = $this->Users->find()
                    ->where(['recovery_hash' => $recovery_hash])
                    ->first();
            if (!is_null($user)) {
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $this->Flash->success('Your password has been changed');
                    return $this->redirect(['controller'=> 'Users', 'action' => 'login']);
                }
            }
        }
        return null;
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null Redirects on successful login, renders view otherwise.
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        $this->Authorization->skipAuthorization();
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        return null;
    }
}
