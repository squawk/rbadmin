<?php
class UsersController extends AppController
{

	var $name = 'Users';

	/**
	 * Log into the system.
	 * Take information from the user and have it validated and handle it accordingly
	 */
	function login()
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
	function logout()
	{
		$this->Session->setFlash('You have successfully logged out.');
		$this->redirect($this->Auth->logout());
	}

}
