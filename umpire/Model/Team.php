<?php
class Team extends AppModel
{
	public $displayField = 'name';
	public $primaryKey = 'team_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'League' => array(
			'className' => 'League',
			'foreignKey' => 'league_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'GameHome' => array(
			'className' => 'Game',
			'foreignKey' => 'home_team',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'GameAway' => array(
			'className' => 'Game',
			'foreignKey' => 'away_team',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
