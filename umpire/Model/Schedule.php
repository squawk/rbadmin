<?php
class Schedule extends AppModel {
	var $name = 'Schedule';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Game' => array(
			'className' => 'Game',
			'foreignKey' => false,			
			'conditions' => array('Game.game_time = Schedule.game_time', 'Game.field_id = Schedule.field_id', 'Game.league_id = Schedule.league_id'),
			'fields' => '',
			'order' => ''
		),
		'Umpire' => array(
			'className' => 'Umpire',
			'foreignKey' => 'umpire_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>