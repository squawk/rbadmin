<?php
App::uses('AppModel', 'Model');
/**
 * Team Model
 *
 * @property League $League
 * @property Player $Player
 */
class Team extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'list_name';
	public $virtualFields = array(
		'list_name' => 'CONCAT(Team.name, " (", Team.coach, ")")'
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'League' => array(
			'className' => 'League',
			'foreignKey' => 'league_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Player' => array(
			'className' => 'Player',
			'foreignKey' => 'team_id',
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
	
	public function teamlist($division_id = null)
	{
      return Set::combine($this->find('all'), '{n}.Team.team_id', '{n}.Team.name', '{n}.Team.league_id');
	}

}
