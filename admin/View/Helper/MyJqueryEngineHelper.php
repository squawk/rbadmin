<?php
App::uses('JqueryEngineHelper', 'View/Helper');
class MyJqueryEngineHelper extends JqueryEngineHelper {

	public function live($type, $callback, $options = array()) {
		$defaults = array('wrap' => true, 'stop' => true);
		$options = array_merge($defaults, $options);

		$function = 'function (event) {%s}';
		if ($options['wrap'] && $options['stop']) {
			$callback .= "\nevent.preventDefault();";
		}
		if ($options['wrap']) {
			$callback = sprintf($function, $callback);
		}
		return sprintf('%s.live("%s", %s);', $this->selection, $type, $callback);
	}
}