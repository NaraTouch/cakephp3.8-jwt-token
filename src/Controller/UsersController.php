<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

class UsersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['login']);
	}

	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if (!$user) {
				throw new UnauthorizedException('Invalid email or password');
			}
			$response = $this->set([
				'success' => true,
				'data' => [
					'token' => JWT::encode([
						'sub' => $user['id'],
						'exp' =>  time() + 3600, // 1 hour
						'role' => $user['role']['name']
					],
					Security::salt())
				],
				'_serialize' => ['success', 'data']
			]);
			return $this->response->withType('application/json')
			->withStringBody(json_encode($response));
		}
	}

	public function index()
	{
		$this->paginate = [
			'contain' => ['Roles'],
		];
		$users = $this->paginate($this->Users);

		$this->set(compact('users'));
	}

	public function view($id = null)
	{
		$user = $this->Users->get($id, [
			'contain' => ['Roles'],
		]);

		$this->set('user', $user);
	}

	public function add()
	{
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$roles = $this->Users->Roles->find('list', ['limit' => 200]);
		$this->set(compact('user', 'roles'));
	}

	public function edit($id = null)
	{
		$user = $this->Users->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$roles = $this->Users->Roles->find('list', ['limit' => 200]);
		$this->set(compact('user', 'roles'));
	}

	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$user = $this->Users->get($id);
		if ($this->Users->delete($user)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
