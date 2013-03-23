<?php
App::uses('SessionComponent', 'Controller/Component');

class MySessionComponent extends SessionComponent {

	public function setFlash($message, $element = 'default', $params = array(), $key = 'flash') {
		$messages = array();
		$index = 'Message.' . $key;
		if (CakeSession::check($index))
		{
			$messages = CakeSession::read($index);
		}

		array_push($messages, compact('message', 'element', 'params'));
		CakeSession::write($index, $messages);
	}

}