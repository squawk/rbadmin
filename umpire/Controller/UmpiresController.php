<?php
class UmpiresController extends AppController
{

	public $scaffold;

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('register', 'all'));
	}

	/**
	 * Log into the system.
	 * Take information from the user and have it validated and handle it accordingly
	 */
	public function login()
	{
		if ($this->request->is('post'))
		{
			if ($this->Auth->login())
			{
				return $this->redirect($this->Auth->redirect());
			}
			else
			{
				$this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
			}
		}
	}

	/**
	 * Logout of the system.
	 */
	public function logout()
	{
		$this->Session->setFlash('You have successfully logged out.');
		$this->redirect($this->Auth->logout());
	}

	/**
	 *
	 */
	public function profile()
	{
		$id = $this->Auth->user('id');
		$this->Umpire->id = $id;
		if (!$this->Umpire->exists())
		{
			throw new NotFoundException(__('Invalid profile'));
		}
		if ($this->request->is('post') || $this->request->is('put'))
		{
			if ($this->Umpire->save($this->request->data))
			{
				$this->Session->setFlash(__('Your profile has been saved'));
				$this->redirect('/');
			}
			else
			{
				$this->Session->setFlash(__('Your profile could not be saved. Please, try again.'));
				unset($this->request->data['Umpire']['password']);
				unset($this->request->data['Umpire']['password_confirmation']);
			}
		}
		else
		{
			$this->request->data = $this->Umpire->read(null, $id);
		}
	}

	/**
	 * register method
	 *
	 * @return void
	 */
	public function register()
	{
		if ($this->Auth->user('id'))
		{
			return $this->redirect('profile');
		}
		if ($this->request->is('post'))
		{
			$this->Umpire->create();
			if ($this->Umpire->save($this->request->data))
			{
				$this->Session->setFlash(__('Your account has been created'));
				$this->redirect(array('action' => 'login'));
			}
			else
			{
				$this->Session->setFlash(__('Your account could not be created. Please, try again.'));
			}
		}
	}

	public function all()
	{
		return $this->Umpire->find('list');
	}


}
