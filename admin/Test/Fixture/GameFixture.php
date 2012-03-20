<?php
/* Game Fixture generated on: 2012-02-23 21:56:49 : 1330059409 */

/**
 * GameFixture
 *
 */
class GameFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'league_id' => array('type' => 'integer', 'null' => false, 'default' => '4', 'collate' => NULL, 'comment' => ''),
		'home_team' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'away_team' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'field_id' => array('type' => 'integer', 'null' => false, 'default' => '4', 'collate' => NULL, 'comment' => ''),
		'machine_pitch' => array('type' => 'boolean', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'game_time' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'cancelled' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'collate' => NULL, 'comment' => ''),
		'makeup' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'collate' => NULL, 'comment' => ''),
		'playoff' => array('type' => 'boolean', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'league_id' => 1,
			'home_team' => 'Lorem ip',
			'away_team' => 'Lorem ip',
			'field_id' => 1,
			'machine_pitch' => 1,
			'game_time' => '2012-02-23 21:56:49',
			'cancelled' => 1,
			'makeup' => 1,
			'playoff' => 1,
			'created' => '2012-02-23 21:56:49',
			'modified' => '2012-02-23 21:56:49'
		),
	);
}
