<?php
/* Schedule Test cases generated on: 2012-02-24 08:13:41 : 1330096421*/
App::uses('Schedule', 'Model');

/**
 * Schedule Test Case
 *
 */
class ScheduleTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.schedule');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Schedule = ClassRegistry::init('Schedule');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Schedule);

		parent::tearDown();
	}

}
