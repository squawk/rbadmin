<?php
App::uses('AppController', 'Controller');
/**
 * Click Controller
 *
 * @property Click $Click
 */
class ClicksController extends AppController {

	public $cookie_name = 'rivertonbaseball-click';
	public $store = 'http://www.desertfalls-utah.com/';

	public function beforeFilter()
	{
		$this->Auth->allow('track', 'transaction');
	}

	public function track()
	{
		Configure::write('debug', 2);

		$click = array(
			'ip' => $_SERVER['REMOTE_ADDR'],
			'referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
			'session' => session_id(),
			'uri' => $_SERVER['REQUEST_URI'],
			'browser' => $_SERVER['HTTP_USER_AGENT'],
		);

		if ($this->Cookie->check($this->cookie_name))
		{
			$click['first_click'] = 0;
		}
		else
		{
			$click['first_click'] = 1;
		}

		// Set cookie -- overwrite the cookie if it's already there -- we'll employ a "last touch" methodology
		$this->Cookie->write($this->cookie_name, 1, false, time()+60*60*24*60);

		// Save the click
		$this->Click->create();
		$this->Click->save($click);

		// redirect to the site
		return $this->redirect($this->store);
	}

	/**
	 * for BigCommerce: <img src="http://admin.rivertonbaseball.org/clicks/transaction/%%ORDER_ID%%/%%ORDER_AMOUNT%%">
	 */
	public function transaction($order_id, $order_amount)
	{
		$this->layout = null;

		if ($this->Cookie->check($this->cookie_name))
		{
			$this->loadModel('Transaction');

			// Does this order already exist
			if ($this->Transaction->findByOrderId($order_id))
			{
				return;
			}
			$transaction = array(
				'ip' => $_SERVER['REMOTE_ADDR'],
				'referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
				'session' => session_id(),
				'uri' => $_SERVER['REQUEST_URI'],
				'browser' => $_SERVER['HTTP_USER_AGENT'],
				'order_id' => $order_id,
				'order_amount' => $order_amount
			);
			$this->Transaction->create();
			$this->Transaction->save($transaction);
		}
		else
		{
			// For testing.
			$this->loadModel('TestTransaction');

			$transaction = array(
				'ip' => $_SERVER['REMOTE_ADDR'],
				'referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
				'session' => session_id(),
				'uri' => $_SERVER['REQUEST_URI'],
				'browser' => $_SERVER['HTTP_USER_AGENT'],
				'order_id' => $order_id,
				'order_amount' => $order_amount
			);
			$this->TestTransaction->create();
			$this->TestTransaction->save($transaction);
		}
	}
}