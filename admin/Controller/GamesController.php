<?php
App::uses('AppController', 'Controller');
/**
 * Games Controller
 *
 * @property Game $Game
 */
class GamesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Game->recursive = 0;
		$this->set('games', $this->paginate());
		$this->loadModel('Team');
		$this->Team->contain();
		$this->set('teams', $this->Team->teamlist());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Game->id = $id;
		if (!$this->Game->exists()) {
			throw new NotFoundException(__('Invalid game'));
		}
		$this->set('game', $this->Game->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Game->create();
			if ($this->Game->save($this->request->data)) {
				$this->Session->setFlash(__('The game has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The game could not be saved. Please, try again.'));
			}
		}
		$leagues = $this->Game->League->find('list');
		$fields = $this->Game->Field->find('list');
		$this->set(compact('leagues', 'fields'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Game->id = $id;
		if (!$this->Game->exists()) {
			throw new NotFoundException(__('Invalid game'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Game->save($this->request->data)) {
				$this->Session->setFlash(__('The game has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The game could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Game->read(null, $id);
		}
		$leagues = $this->Game->League->find('list');
		$fields = $this->Game->Field->find('list');
		$this->set(compact('leagues', 'fields'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Game->id = $id;
		if (!$this->Game->exists()) {
			throw new NotFoundException(__('Invalid game'));
		}
		if ($this->Game->delete()) {
			$this->Session->setFlash(__('Game deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Game was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function upload()
	{
		
		if ($this->request->is('post')) {
			$league_id = $this->request->data['Game']['league_id'];
			$filename = $this->request->data['Game']['filename']['tmp_name'];
			if (empty($league_id) or empty($filename))
			{
				$this->Session->setFlash('Both fields are required.');
			}
			else if ($league_id < 7)
			{
				$games = $this->_load_calripken($league_id, $filename);
				if ($games) $this->Session->setFlash($games . ' games loaded.');
			}
			else
			{
				$games = $this->_load_baberuth($league_id, $filename);
				if ($games) $this->Session->setFlash($games . ' games loaded.');			   
			}
		}
		$leagues = $this->Game->League->find('list');
		$this->set(compact('leagues'));
		
	}
	
	private function _load_calripken($league_id, $filename)
	{
		App::uses('SimpleXLSX', 'Lib');
		$xlsx = new SimpleXLSX($filename);
		$rows = $xlsx->rows(); 
		$keys = array('date', 'time', 'field', 'home', 'v', 'away', 'type');
		$skip = true;
		$games = array();
		$this->errors = array();
		if ($rows)
		{
			foreach($rows as $r)
			{
				if ($r[0] == 'Date')
				{
					$skip = false;
					continue;
				}
				if ($skip)
				{
					continue;
				}
				$game = $this->_array_combine($keys, $r);
				
				$new_game['Game'] = array(
					'league_id' => $league_id,
					'home_team' => $this->_team($league_id, $game['home']),
					'away_team' => $this->_team($league_id, $game['away']),
					'field_id' => $this->_field($league_id, $game['field']),
					'game_type' => $game['type'],
					'game_time' => $this->_gametime($game['date'], $game['time']),
				);
				$games[] = $new_game;
			}
			
			if (count($this->errors))
			{
				$this->Session->setFlash(implode('<br>', $this->errors));
				return false;
			}
			
			$this->Game->deleteAll(array('Game.league_id' => $league_id));
			$this->Game->saveAll($games);
		}
		
		return count($games);
	}
	
	private function _load_baberuth($league_id, $filename)
	{
		App::uses('SimpleXLSX', 'Lib');
	   $xlsx = new SimpleXLSX($filename); 
      $rows = $xlsx->rows();
      $keys = array('field','time','sun','mon','tue','wed','thu','fri','sat');
      $games = array();
      if ($rows)
      {
         foreach ($rows as $data)
         {
            $row = $this->_array_combine($keys, $data);

            // Calculate days
            if ($row['field'] == 'Field')
            {
               $monday = trim(str_replace('Monday', '', $row['mon']));
               $date = array(
                  'mon' => date('m/d', strtotime($monday)),
                  'tue' => date('m/d', strtotime($monday . ' +1 day')),
                  'wed' => date('m/d', strtotime($monday . ' +2 day')),
                  'thu' => date('m/d', strtotime($monday . ' +3 day')),
                  'fri' => date('m/d', strtotime($monday . ' +4 day')),
                  'sat' => date('m/d', strtotime($monday . ' +5 day')),
                );
               continue;
            }

            // Get field
            if (!empty($row['field']))
            {
               //$field = $fields[$row['field']];
               $field = $row['field'];
            }

            // Get game time
            if (!empty($row['time']))
            {
               $time = $this->_formatTime($row['time']);
            }

            // Get teams and (sometimes) times
            $time_pattern = "/\(.*\)/";
            $field_pattern = "/@.*/";
            $temp_time = false;
            foreach (array('mon', 'tue', 'wed', 'thu', 'fri', 'sat') as $day)
            {
               $teams = !empty($row[$day]) ? trim($row[$day]) : null;
               if (!empty($teams))
               {
                  if ($temp_time)
                  {
                     $time = $temp_time;
                     $temp_time = false;
                  }

                  if (preg_match($time_pattern, $teams, $matches))
                  {
                     $temp_time = $time;
                     $new_time = $matches[0];
                     $teams = trim(str_replace($new_time, '', $teams));
                     $time = str_replace(array('(', ')'), array('', ''), $new_time);
                  }

                  $new_field = null;
                  if (preg_match($field_pattern, $teams, $matches))
                  {
                     $new_field = $matches[0];
                     $teams = trim(str_replace($new_field, '', $teams));
                     $new_field = trim(str_replace('@', '', $new_field));
                  }

                  $my_time = $date[$day] . ' ' . $time;

                  $split = explode('-', $teams);
                  if (count($split) > 1)
                  {
                     $home = trim($split[0]);
                     $away = trim($split[1]);

                     if (strpos($home, 'RBR') !== false or strpos($away, 'RBR') !== false)
                     {
                        $league = 9;
                     }
                     else if (strpos($home, 'RP') !== false or strpos($away, 'RP') !== false)
                     {
                        $league = 7;
                     }
                     else
                     {
                        $league = 8;
                     }

                     $my_time = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $my_time)));
         				$new_game['Game'] = array(
         					'league_id' => $league,
         					'home_team' => $home,
         					'away_team' => $away,
         					'field_id' => $this->_field($league, is_null($new_field) ? $field : $new_field),
         					'game_time' => $my_time,
         				);
         				$games[] = $new_game;
                  } // count > 1
               } // !empty($teams)
            } // foreach
         } // $rows
         
         $this->Game->deleteAll(array('Game.league_id' => array(7, 8, 9)));
   		$this->Game->saveAll($games);
		}
		
      return count($games);
	}
	
	private function _team($league_id, $name)
	{
		static $teams = null;
		if (is_null($teams))
		{
			$this->loadModel('Team');
			$this->Team->contain();
			$teams = $this->Team->find('all', array('conditions' => array('Team.league_id' => $league_id)));
			$teams = Set::combine($teams, '{n}.Team.name', '{n}.Team.team_id');
		}
		
		return empty($teams[$name]) ? $name : $teams[$name];
	}

	private function _field($league_id, $name)
	{
		static $fields = null;
		if (is_null($fields))
		{
			$this->loadModel('Field');
			$this->Field->contain();
			$fields = $this->Field->find('all');
			$fields = Set::combine($fields, '{n}.Field.name', '{n}.Field.id');
		}
		
		if (!empty($name) and !isset($fields[$name]))
		{
		   $new = array('league_id' => $league_id, 'name' => $name);
		   $this->Field->create();
		   $this->Field->save($new);
		   $fields[$name] = $this->Field->id;
		}
		
		return empty($fields[$name]) ? $league_id : $fields[$name];
	}
	
	private function _gametime($d, $t)
	{
		$date = $this->_formatDate($d);
		$time = $this->_formatTime($t);
		if ($date == null)
		{
			$this->errors[] = 'Invalid game time: ' . $d;
			return null;
		}
		return $date . ' ' . $time;
	}
	
	private function _formatDate($d)
	{
		$date = null;
		$tmp = strtotime($d);
		if ($tmp !== false)
		{
			$date = date('Y-m-d', $tmp);
		}
		return $date;
	}
	
	private function _formatTime($t)
	{
		$hour = (int) ($t * 24);
		$minute = (int) ((($t * 24) - $hour) * 60);

		return sprintf('%02d:%02d:00', $hour, $minute);
	}
	
	private function _array_combine($key, $val, $pad = true) 
	{
	   $count = max(count($key), count($val));
	   $result = array();
	   $dummy = 1;
	   
	   for ($i = 0; $i < $count; $i++)
	   {
	      if (empty($key[$i]))
	      {
	         $key[$i] = 'Dummy ' . $dummy++;
	      }
	      if (empty($val[$i]))
	      {
	         $val[$i] = null;
	      }
	      $result[$key[$i]] = $val[$i];
	   }
      return $result;
	}
}
