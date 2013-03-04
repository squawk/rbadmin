<?php
class LeagueUmpire extends AppModel
{
	var $name = 'LeagueUser';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Umpire' => array(
			'className' => 'Umpire',
			'foreignKey' => 'umpire_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'League' => array(
			'className' => 'League',
			'foreignKey' => 'league_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

?>