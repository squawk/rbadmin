<?php
class Request extends AppModel
{
	var $name = 'Request';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Umpire' => array(
			'className' => 'Umpire',
			'foreignKey' => 'umpire_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function add($umpire_id, $date)
	{
		$conditions = array(
			'umpire_id' => $umpire_id,
			'game_time' => date('Y-m-d H:i:s', strtotime($date))
		);

		$this->contain();
		$request = $this->find('first', compact('conditions'));
		$this->create();
		if ($request)
		{
			$this->id = $request['Request']['id'];
		}

		$this->save($conditions);
	}

	function remove($umpire_id, $date)
	{
		$conditions = array(
			'umpire_id' => $umpire_id,
			'game_time' => date('Y-m-d H:i:s', strtotime($date))
		);

		$this->contain();
		$request = $this->find('first', compact('conditions'));
		if ($request)
		{
			$this->id = $request['Request']['id'];
			$this->delete();
		}
	}
}

?>