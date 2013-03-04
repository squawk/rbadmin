<?php
class GamesController extends AppController
{
	var $name = 'Games';

	function beforeFilter()
	{
		$this->Auth->allow('schedule');
		parent::beforeFilter();
	}

	/**
	 * Handle display and saving requests
	 * @param $month
	 */
	function request($month = null)
	{
		$this->loadModel('Request');
		$umpire_id = $this->Auth->user('id');

		// Save the requests
		if ($this->request->is('post'))
		{
			$requests = array_keys($this->request->data['Game'], 1);
			foreach ($requests as $request)
			{
				$date = str_replace(array('_', '-', 'x'), array('/', ' ', ':'), $request);
				$this->Request->add($umpire_id, $date);
			}

			$requests = array_keys($this->request->data['Game'], 0);
			foreach ($requests as $request)
			{
				$date = str_replace(array('_', '-', 'x'), array('/', ' ', ':'), $request);
				$this->Request->remove($umpire_id, $date);
			}

			$this->Session->setFlash('Thank you. Your requests have been saved');
		}

		// Build the calendar
		$months = array('march' => 3, 'april' => 4, 'may' => 5, 'june' => 6);
		$year = date('Y');
		$week = date('W');
		if (date('N') > 5)
		{
			$week++;
		}

		if (isset($months[$month]))
		{
			$month = $months[$month];
		}

		if (empty($month))
		{
			$month = date('n');
		}

		$fields = array(
			'Game.game_time',
			"DATE_FORMAT(Game.game_time, '%l:%i %p') AS time",
			'DAY(Game.game_time) AS day',
			'COUNT(*) AS count'
		);
		$conditions = array(
			'Game.league_id' => array(4, 5, 6),
			'MONTH(Game.game_time)' => $month,
			'OR' => array(
				'WEEK(Game.game_time) >' => $week,
				array(
					'WEEK(Game.game_time) >' => $week - 1,
					//'Game.makeup' => 1,
					'Game.game_time >= CURRENT_DATE()'
				),
			),
		);
		$order = array(
			'Game.game_time'
		);
		$group = array(
			'Game.game_time',
			"DATE_FORMAT(Game.game_time, '%l:%m %p')",
			'DAY(Game.game_time)'
		);

		$tmp = $this->Game->find('all', compact('fields', 'conditions', 'order', 'group'));
		foreach ($tmp as $g)
		{
			$games[$g[0]['day']][] = $g[0]['time'];
		}

		$this->set(compact('games', 'month', 'year'));

		// Get the current requests
		$conditions = array('umpire_id' => $umpire_id);
		$requests = $this->Request->find('all', compact('conditions'));
		foreach ($requests as $request)
		{
			$time = strtotime($request['Request']['game_time']);
			$month = date('n', $time);
			$now = date('j', $time);
			$year = date('Y', $time);
			$game = date('g:i A', $time);
			$key = str_replace(array(':', ' '), array('x', ''), $month . '_' . $now . '_' . $year . '-' . $game);
			$this->request->data['Game'][$key] = 1;
		}
	}

	/**
	 * schedule this week
	 */
	function schedule()
	{
		$conditions = array(
			'WEEK(Game.game_time) BETWEEN WEEK(CURRENT_DATE()) AND WEEK(CURRENT_DATE()) + 1',
			'Game.league_id' => array(4, 5, 6),
		);
		$order = array('Game.league_id', 'Game.game_time');
//      $this->Game->contain('TeamHome', 'TeamAway', 'Field', 'League', array('Schedule' => array('Umpire' => 'Request')));
		$this->Game->contain('TeamHome', 'TeamAway', 'Field', 'League', 'Schedule');
		$games = $this->Game->find('all', compact('conditions', 'order'));

		return $games;
		if (isset($this->params['requested']))
		{
			return $games;
		}
		$this->set('games', $games);
	}

	/**
	 * Show my schedule
	 */
	function myschedule($week = 0)
	{
		$conditions = array(
			'WEEK(Game.game_time) = WEEK(CURRENT_DATE()) + ' . $week,
			'Schedule.umpire_id' => $this->Auth->user('id'),
		);
		$order = array('Game.league_id', 'Game.game_time');
		$this->Game->contain('TeamHome', 'TeamAway', 'Field', 'League', array('Schedule' => array('Umpire' => 'Request')));
		$games = $this->Game->find('all', compact('conditions', 'order'));
		$this->set('games', $games);
	}

	/**
	 * Assign the umpire to this game and then return to previous page
	 * @param $game_id
	 * @param $umpire_id
	 */
	function assign($game_id, $umpire_id)
	{
		if ($this->Auth->user('role') != 'admin')
		{
			$this->Session->setFlash('You are not authorized to access that location.');
			$this->redirect('/');
		}

		$this->loadModel('Request');
		$this->loadModel('Schedule');

		// Get the game time
		$this->Game->contain();
		$game = $this->Game->findById($game_id);

		// Get the request time
		$conditions = array(
			'umpire_id' => $umpire_id,
			'game_time' => $game['Game']['game_time'],
		);
		$this->Request->contain();
		$request = $this->Request->find('first', compact('conditions'));
		$request_id = $request['Request']['id'];
		$schedule = array(
			'umpire_id' => $umpire_id,
			'request_id' => $request_id,
			'game_time' => $game['Game']['game_time'],
			'field_id' => $game['Game']['field_id'],
			'league_id' => $game['Game']['league_id'],
		);
		$this->Schedule->create();
		$this->Schedule->save($schedule);

		$this->Session->setFlash('New game assigned');
		$this->redirect($this->referer());
	}

	function unassign($schedule_id)
	{
		$this->loadModel('Schedule');
		$this->Schedule->id = $schedule_id;
		$this->Schedule->delete();

		$this->Session->setFlash('Game unassigned');
		$this->redirect($this->referer());
	}

	/**
	 * Show the games this week and those available
	 */
	function assign_games($week = 0)
	{
		set_time_limit(0);
		$this->loadModel('Request');
//      $order = array('Game.game_time', 'Schedule.umpire_id');
		$order = array();
		$requests = $this->Request->find('all', compact('order'));
		$requests = Set::combine($requests, '{n}.Umpire.id', array('{0}: {1} ({2})', '{n}.Umpire.id', '{n}.Umpire.name', '{n}.Umpire.age'), '{n}.Request.game_time');

		$this->loadModel('Schedule');
		$schedules = $this->Schedule->find('all', compact('order'));
		$schedules = Set::combine($schedules, '{n}.Umpire.id', array('{0}: {1} ({2})', '{n}.Umpire.id', '{n}.Umpire.name', '{n}.Umpire.age'), '{n}.Game.game_time');

		$conditions = array(
			'WEEK(Game.game_time) = WEEK(CURRENT_DATE()) + ' . $week,
			'Game.league_id' => array(4, 5, 6),
		);
		$order = array('Game.league_id', 'Game.game_time');
//      $this->Game->contain('TeamHome', 'TeamAway', 'Field', 'League', array('Schedule' => array('Umpire' => 'Request')));
		$this->Game->contain('TeamHome', 'TeamAway', 'Field', 'League', 'Schedule');
		$games = $this->Game->find('all', compact('conditions', 'order'));

		$this->loadModel('Umpire');
		$umpires = $this->Umpire->find('list');

		if (isset($this->params['requested']))
		{
			return $games;
		}
		$this->set(compact('requests', 'games', 'schedules', 'umpires', 'week'));
	}

	/**
	 * Show this week's schedule
	 */
	function thisweek1()
	{
		$conditions = array(
			'WEEK(game_time) = WEEK(CURRENT_DATE())+1',
			'Schedule.umpire_id' => $this->Auth->user('id'),
		);
		$order = array('Game.game_time');
		$games = $this->Game->find('all', compact('conditions', 'order'));
		pr($games);
	}
}
