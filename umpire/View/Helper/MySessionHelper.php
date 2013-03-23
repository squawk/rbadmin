<?php

App::uses('SessionHelper', 'View/Helper');

/**
 * Session Helper.
 */
class MySessionHelper extends SessionHelper {

	public function flash($key = 'flash', $attrs = array()) {
		$out = false;
		$result = false;

		$index = 'Message.' . $key;
		if (CakeSession::check($index)) {

			$flashes = CakeSession::read($index);

			foreach ($flashes as $flash)
			{
				$message = $flash['message'];
				unset($flash['message']);

				if (!empty($attrs)) {
					$flash = array_merge($flash, $attrs);
				}

				if ($flash['element'] == 'default') {
					$class = 'message';
					if (!empty($flash['params']['class'])) {
						$class = $flash['params']['class'];
					}
					$out = '<div id="' . $key . 'Message" class="' . $class . '">' . $message . '</div>';
				} elseif ($flash['element'] == '' || $flash['element'] == null) {
					$out = $message;
				} else {
					$options = array();
					if (isset($flash['params']['plugin'])) {
						$options['plugin'] = $flash['params']['plugin'];
					}
					$tmpVars = $flash['params'];
					$tmpVars['message'] = $message;
					$out = $this->_View->element($flash['element'], $tmpVars, $options);
				}

				$result .= $out;
			}

			CakeSession::delete($index);

		}
		return $result;
	}
}
