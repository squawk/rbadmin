<?php
class Game extends AppModel
{
	var $name = 'Game';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'Schedule' => array(
			'className' => 'Schedule',
			'foreignKey' => false,
			'conditions' => array('Game.game_time = Schedule.game_time', 'Game.field_id = Schedule.field_id', 'Game.league_id = Schedule.league_id'),
			'fields' => '',
			'order' => ''
		)
	);

	var $belongsTo = array(
		'TeamHome' => array(
			'className' => 'Team',
			'foreignKey' => 'home_team',
			'conditions' => 'TeamHome.league_id = Game.league_id',
			'fields' => '',
			'order' => ''
		),
		'TeamAway' => array(
			'className' => 'Team',
			'foreignKey' => 'away_team',
			'conditions' => 'TeamAway.league_id = Game.league_id',
			'fields' => '',
			'order' => ''
		),
		'League' => array(
			'className' => 'League',
			'foreignKey' => 'league_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Field' => array(
			'className' => 'Field',
			'foreignKey' => 'field_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}

?>