<?php
class PlayersController extends AppController {

	var $name = 'Players';
	//var $helpers = array('Pdf');

   /**
    * List of players
    */
	public function index()
	{
      $conditions = array();
		$league_id = $this->Auth->user('default_league_id');
		if ($this->request->is('ajax'))
		{
		   $q = $this->request->data['Player']['name'];
         $conditions[] = array(
         'OR' => array(
            sprintf("Player.last_name LIKE '%%%s%%'", $q),
            sprintf("Player.first_name LIKE '%%%s%%'", $q)
         )
         );
		}
		if ($league_id)
		{
			$conditions[] = array(
				'Player.league_id' => $league_id,
			);
		}
		if ($conditions)
      {
         $this->paginate = compact('conditions');
      }
		$this->set('players', $this->paginate());

      if ($this->request->is('ajax'))
      {
         $this->layout = 'ajax';
         $this->render('/Elements/player_table');
         return;
      }

	}

   /**
    * A read-only view of a player
    * @param $id
    */
	function view($id = null)
	{
		$this->Player->id = $id;
		if (!$this->Player->exists())
		{
			throw new NotFoundException(__('Invalid player'));
		}
		$this->set('player', $this->Player->read(null, $id));
	}

   /**
    * Add a new player
    */
	function add()
	{
	   if ($this->request->is('post'))
		{
			$this->Player->create();
			if ($this->Player->save($this->request->data))
			{
				$this->Session->setFlash(__('%s %s has been saved', $this->request->data['Player']['first_name'], $this->request->data['Player']['last_name']));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__('The player could not be saved. Please, try again.'));
			}
		}

	   // Default city to riverton
	   //$this->request->data['Player']['city'] = 'Riverton';
	   //$this->request->data['Player']['zip'] = '84065';
	   $this->request->data['Player']['league_id'] = $this->Auth->user('default_league_id');

	   $leagues = $this->Player->League->find('list');
	   $teams = array();
	   if (isset($this->request->data['Player']['team_id']) or isset($this->request->data['Player']['league_id']))
	   {
		   $conditions = array('Team.league_id' => $this->request->data['Player']['league_id']);
		   $teams = $this->Player->Team->find('list', compact('conditions'));
		}
		$this->set(compact('leagues', 'teams'));
	}

   function qedit($id = null)
   {
      $this->edit($id);
      $this->layout = 'ajax';
   }

   /**
    * Edit a player
    * @param $id
    */
	function edit($id = null)
	{
	   $this->Player->id = $id;
	   if (!$this->Player->exists())
		{
			throw new NotFoundException(__('Invalid player'));
		}
		if ($this->request->is('post') or $this->request->is('put'))
		{
			if ($this->Player->save($this->request->data))
			{
				$this->Session->setFlash(__('%s %s has been saved', $this->request->data['Player']['first_name'], $this->request->data['Player']['last_name']));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
			   $this->Session->setFlash(__('The player could not be saved. Please, try again.'));
			   $this->request->data['Player']['birthdate'] = date('n/j/Y', strtotime($this->data['Player']['birthdate']));
			}
		}
		else
		{
			$this->request->data = $this->Player->read(null, $id);
			$this->request->data['Player']['birthdate'] = date('n/j/Y', strtotime($this->request->data['Player']['birthdate']));
		}
		$leagues = $this->Player->League->find('list');
		$teams = array();
		if ($this->request->data['Player']['team_id'] or $this->request->data['Player']['league_id'])
		{
		   $conditions = array('Team.league_id' => $this->request->data['Player']['league_id']);
		   $teams = $this->Player->Team->find('list', compact('conditions'));
		}
		$this->set(compact('leagues', 'teams'));
	}

   /**
    * Delete a player
    */
   public function delete($id = null)
 	{
 		if (!$this->request->is('post'))
 		{
 			throw new MethodNotAllowedException();
 		}
 		$this->Player->id = $id;
 		if (!$this->Player->exists())
 		{
 			throw new NotFoundException(__('Invalid player'));
 		}
 		if ($this->Player->delete())
 		{
 			$this->Session->setFlash(__('Player deleted'));
 			$this->redirect(array('action' => 'index'));
 		}
 		$this->Session->setFlash(__('Player was not deleted'));
 		$this->redirect(array('action' => 'index'));
 	}

	/**
	 * Ajax look up of last year's players.
	 */
	function search()
	{
      if ($this->request->is('ajax'))
      {
         $this->layout = 'ajax';
      }

      $name = explode(' ', $this->request->query['q']);

      $fields = array(
         'LastYearPlayer.first_name',
         'LastYearPlayer.last_name',
         'LastYearPlayer.birthdate',
         'LastYearPlayer.address',
         'LastYearPlayer.city',
         'LastYearPlayer.zip',
         'LastYearPlayer.dads_name',
         'LastYearPlayer.moms_name',
         'LastYearPlayer.day_phone',
         'LastYearPlayer.evening_phone',
         'LastYearPlayer.cell_phone',
         'LastYearPlayer.email',
         'LastYearPlayer.last_team',
         'LastYearPlayer.school_boundary',
         'LastYearPlayer.jersey_name',
         );
      $conditions = array();
      foreach ($name as $n)
      {
			$conditions[] = array(
				'OR' => array(
				sprintf("LastYearPlayer.last_name LIKE '%%%s%%'", $n),
				sprintf("LastYearPlayer.first_name LIKE '%%%s%%'", $n)
			));
		}
		$order = array('LastYearPlayer.last_name', 'LastYearPlayer.first_name');
		$limit = '';
		if (isset($this->request->query['limit']))
		{
			$limit = $this->request->query['limit'];
		}

		$this->loadModel('LastYearPlayer');
		$this->set('players', $this->LastYearPlayer->find('all', compact('fields', 'conditions', 'order', 'limit')));
	}

	/**
	 * List of players for tryout
	 */
	function tryout($type=null, $league_id=0)
	{
	   if (empty($league_id))
	   {
	      $league_id = $this->Auth->user('default_league_id');
	   }
	   if (!empty($this->data))
      {
         $league_id = $this->data['Player']['league_id'];
      }

      if ($league_id > 0)
      {
         //$conditions = array('Player.league_id'=> $league_id, 'Player.tryout'=> 1);
         $conditions = array('Player.league_id' => $league_id, 'Player.team_id IS NULL');
         $order = array('last_name ASC', 'first_name ASC');
         $players = $this->Player->find('all', compact('conditions', 'order'));
         if ($type == 'number')
         {
            $number = 1;
            foreach ($players as $p)
            {
            	$this->Player->id = $p['Player']['id'];
               $rec['Player']['tryout_number'] = $number++;
               $this->Player->save($rec);
            }
            $players = $this->Player->find('all', compact('conditions', 'order'));
         }
         $this->set('league_id', $league_id);
         $this->set('players', $players);
      }

      if ($type == 'csv')
      {
         // CSV file
         $this->set('title_for_layout', 'TryoutList.csv');
         $this->layout = 'csv';
         $this->render('tryout_csv');
      }
      else if ($type == 'pdf')
      {
         // PDF file
         $this->set('title_for_layout', 'TryoutList.pdf');
         $this->layout='pdf';
         $this->render('tryout_pdf');
      }
      else
      {
         $this->loadModel('League');
   	   $this->set('leagues', $this->League->find('list'));
      }

	}


	/**
	 * List of players for tryout
	 */
	function allstar_tryout($type=null, $league_id=0)
	{
	   if (empty($league_id))
	   {
	      $league_id = $this->Auth->user('default_league_id');
	   }
	   if (!empty($this->data))
      {
         $league_id = $this->data['Player']['league_id'];
      }

      if ($league_id > 0)
      {
         $conditions = array('Player.league_id'=> $league_id, 'Player.allstar_tryout'=> 1);
         $order = array('last_name DESC', 'first_name DESC');
         $players = $this->Player->find('all', compact('conditions', 'order'));
         if ($type == 'number')
         {
            $number = 1;
            foreach ($players as $p)
            {
               $p['Player']['allstar_tryout_number'] = $number++;
               $this->Player->save($p);
            }
            $players = $this->Player->find('all', compact('conditions', 'order'));
         }
         $this->set('league_id', $league_id);
         $this->set('players', $players);
      }

      if ($type == 'csv')
      {
         // CSV file
         $this->set('title_for_layout', 'AllstarTryoutList');
         $this->layout = 'csv';
         $this->render('allstar_tryout_csv');
      }
      else if ($type == 'pdf')
      {
         // PDF file
         $this->set('title_for_layout', 'AllstarTryoutList.pdf');
         $this->layout='pdf';
         $this->render('allstar_tryout_pdf');
      }
      else
      {
         $this->loadModel('League');
   	   $this->set('leagues', $this->League->find('list'));
      }

	}

	/**
	 * Roster list
	 */
	public function rosters($type=null, $league_id=0)
	{
	   if (empty($league_id))
	   {
	      $league_id = $this->Auth->user('default_league_id');
	   }
	   if (!empty($this->data))
      {
         $league_id = $this->data['Player']['league_id'];
      }

      if ($league_id > 0)
      {
         $conditions = array('Player.league_id' => $league_id);
         $order = array('Player.team_id', 'Player.last_name ');
         $allPlayers = $this->Player->find('all', compact('conditions', 'order'));
         foreach ($allPlayers as $p)
         {
         	if (empty($p['Team']['name']))
         	{
	            $players[''][] = $p;
         	}
         	else
         	{
	         	$players[sprintf('%s (%s)', $p['Team']['name'], $p['Team']['coach'])][] = $p;
         	}
         }
         $this->set('players', $players);
         $this->set('league', $this->Player->League->findById($league_id));
      }

      if ($type == 'pdf')
      {
         // PDF file
         $this->set('title_for_layout', 'PlayerRoster.pdf');
         $this->layout = 'pdf';
         $this->render('roster_pdf');
      }
      else if ($type == 'lastname')
      {
         // PDF file
         $this->set('title_for_layout', 'LastnameList.txt');
         $this->layout = 'txt';
         $this->render('roster_txt');
      }
      else
      {
         $this->loadModel('League');
   	   $this->set('leagues', $this->League->find('list'));
      }
   }

   public function export()
   {
      $order = array('Player.league_id', 'Player.team_id', 'Player.last_name');
      $players = $this->Player->find('all', compact('conditions', 'order'));
      $this->set('players', $players);
   }

   /**
    * Main draft page.
    *
    * @param integer $league_id
    */
   function draft($league_id=0)
   {
//      $this->layout = 'draft';
      $draft = 1;
      if (!empty($this->request->data))
      {
         $league_id = $this->request->data['Player']['league_id'];
      }
      if ($league_id > 0)
      {
      	// Draft players
         $conditions = array('Player.league_id'=> $league_id, 'Player.team_id IS NULL', 'Player.picked'=> 0);
         $order = array('tryout_number', 'last_name', 'first_name');
         $this->Player->contain();
         $players = $this->Player->find('all', compact('conditions', 'order'));
         $teams = $this->Player->Team->find('list', array('conditions' => array('league_id' => $league_id)));

         // Picked players
         $this->Player->contain('Team');
         $conditions = array('Player.league_id' => $league_id, 'Player.team_id IS NOT NULL', 'Team.name is NOT NULL');
         $fields = array('Team.name', 'COUNT(*) count');
         $group = array('Team.name');
         $team_status = $this->Player->find('all', compact('fields', 'conditions', 'group'));

         $this->set(compact('players', 'teams', 'team_status', 'league_id'));
      }
      $leagues = $this->Player->League->find('list', array('conditions' => array('id > 3')));
      $this->set(compact('leagues', 'draft'));
   }

   /**
    * Handles the ajax call to select a player from the draft.
    */
   function draft_choose()
   {
      //$this->layout = '';
      $team = $this->request->query['team'];
      $player_id = $this->request->query['player'];
      $league_id = $this->request->query['league'];

      // Add player to the team
      $this->Player->contain();
      $player = $this->Player->find('first', array('conditions' => array('Player.id' => $player_id)));
      $this->Player->id = $player['Player']['id'];
      $record['Player']['team_id'] = $team;
      $record['Player']['picked'] = 1;
		$this->Player->save($record);

      $this->Player->contain('Team');
      $conditions = array('Player.league_id' => $league_id, 'Player.team_id IS NOT NULL', 'Team.name is NOT NULL');
      $fields = array('Team.name', 'COUNT(*) count');
      $group = array('Team.name');
      $team_status = $this->Player->find('all', compact('fields', 'conditions', 'group'));
      $this->set(compact('team_status', 'league_id'));
   }

   /**
    * Handles the ajax call to undo a selected player from the draft.
    */
   function draft_undo()
   {
      $this->layout = '';
      $player_id = $this->request->query['player'];
      $league_id = $this->request->query['league'];
      $this->Player->contain();
      $player = $this->Player->find('first', array('conditions' => array('Player.id' => $player_id)));
      $this->Player->id = $player['Player']['id'];
      $record['Player']['team_id'] = null;
      $record['Player']['picked'] = 0;
      $this->Player->save($record);

      $this->Player->contain('Team');
      $conditions = array('Player.league_id' => $league_id, 'Player.team_id IS NOT NULL', 'Team.name is NOT NULL');
      $fields = array('Team.name', 'COUNT(*) count');
      $group = array('Team.name');
      $team_status = $this->Player->find('all', compact('fields', 'conditions', 'group'));
      $this->set(compact('team_status', 'league_id'));
   }

   /**
    * List the current players for a team
    *
    * @param unknown_type $league_id
    * @param unknown_type $teamName
    */
   function teamlist($league_id, $team_id)
   {
      $this->layout = '';
      $conditions = array('Player.league_id'=> $league_id, 'Player.team_id'=> $team_id);
      $order = array('last_name', 'first_name');
      $this->Player->contain();
      $players = $this->Player->find('all', compact('conditions', 'order'));
      $team = $this->Player->Team->find('first', array('conditions' => array('Team.id' => $team_id)));
      $this->set('players', $players);
      $this->set('league_id', $league_id);
      $this->set('team_name', $team['Team']['name']);
   }

   public function validate_form()
   {
      if ($this->request->is('ajax'))
      {
         $this->Player->set($this->request->data);
         if ($this->Player->validates())
         {
            $this->autoRender = false;
         }
         else
         {
            foreach ($this->Player->validationErrors as $field => $error)
            {
               $errors[Inflector::camelize('Player_' . $field)] = $error;
            }
            return new CakeResponse(array('body' => json_encode($errors)));
         }
      }
   }

   public function validate_field()
   {
      $this->layout = 'ajax';
      if ($this->request->is('ajax'))
      {
         $name =  substr(str_replace('data[Player][', '', $this->request->data['name']), 0, -1);
         $this->request->data['Player'][$name] = $this->request->data['value'];
         $this->Player->set($this->request->data);
         if ($this->Player->validates()) {
             // it validated logic
             $this->autoRender = false;
         } else {
             // didn't validate logic
             $errors = $this->Player->validationErrors;
             return new CakeResponse(array('body' => $errors[$name][0]));
         }
      }
   }

   public function clothing()
   {
      /*
      $shirts = array(
      	'YM' => 'Youth Medium',
      	'YL' => 'Youth Large',
      	'YXL' => 'Youth X-Large',
      	'AS' => 'Adult Small',
      	'AM' => 'Adult Medium',
      	'AL' => 'Adult Large',
      	'AXL' => 'Adult X-Large',
      	'AXXL' => 'Adult XX-Large',
      	'NL' => 'Need Larger Size',
      );*/
      $shirts = array(
      	'N' => 'Optional, unless Larger size is needed',
      	'AM' => 'Adult Medium',
      	'AL' => 'Adult Large',
      	'AXL' => 'Adult X-Large',
      	'AXXL' => 'Adult XX-Large',
      );
      $pants = array(
      	'YXS' => 'Youth X-Small',
      	'YS' => 'Youth Small',
      	'YM' => 'Youth Medium',
      	'YL' => 'Youth Large',
      	'YXL' => 'Youth X-Large',
      	'AS' => 'Adult Small',
      	'AM' => 'Adult Medium',
      	'AL' => 'Adult Large',
      	'AXL' => 'Adult X-Large',
      );
      return compact('shirts', 'pants');
   }

   /**
    * Returns a list of teams for a league
    *
    * @param integer $league_id
    * @return array
    */
   function _teams($league_id)
   {
         $teams = array(
         // PeeWee
         4=> array(
		"A's" => "A's - Dan Tobler",
		"Angels" => "Angels - John Carter",
		"Astros" => "Astros - Mike Stone",
		"Cardinals" => "Cardinals - Anthony Kay",
		"Diamond Backs" => "Dbacks - Chris Mears",
		"Dodgers" => "Dodgers - Scott Mortensen",
		"Giants" => "Giants - Brent Dillon",
		"Indians" => "Indians - Shannon Lamoreaux",
		"Mariners" => "Mariners - Rick Medina",
		"Marlins" => "Marlins - Jackson Peck",
		"Phillies" => "Phillies - Ken Larsen",
		"Pirates" => "Pirates - Tom Lewis",
		"Red Sox" => "Red Sox - Rick Meyers",
		"Reds" => "Reds - Scott Boydston",
		"Rockies" => "Rockies - Jeremy Potter",
		"Tigers" => "Tigers - Mitch Curtis",
		"Twins" => "Twins - Mark Phister",
		"Yankees" => "Yankees - Don Mortensen",
		),
         // Minor
         // Angels, Reds, Twins, Giants, Indians, Pirates
         // Dodgers, D-Backs, Yankees, Cardinals, Royals, Astros
         5=> array(
		"Angels" => "Angels - Jeff Morrey",
		"Astros" => "Astros - Brian Holmstrom",
		"Cards" => "Cards - Skip Kassing",
		"D-backs" => "D-backs - Shaun Dustin",
		"Dodgers" => "Dodgers - Jeff Nokes",
		"Indians" => "Indians - Mark Brown",
		"Pirates" => "Pirates - Shawn Grant",
		"Reds" => "Reds - Sean Townsend",
		"Twins" => "Twins - Duane Andrews",
		"Yankees" => "Yankees - Jim Mackie",
		),
         // Major
         6=> array(
		"CARDINALS" => "Cards - Kyle Price",
		"GIANTS" => "Giants - Derik Judd",
		"MARINERS" => "Mariners - Shane Watt",
		"METS" => "Mets - Trent Springer",
		"PHILLIES" => "Phillies - Ken Hart",
		"RAYS" => "Rays - Samuel Craghead",
		"REDS" => "Reds - Jason Lee",
		"ROCKIES" => "Rockies - Kris Tolley",
		"WHITE SOX" => "White Sox - Ed Day",
		"YANKEES" => "Yankees - Dennis Pennington",
		),
         7=> array(
		"Chris King" => "Chris King",
		"Greg Lambert" => "Greg Lambert",
		"Jim Garn" => "Jim Garn",
		"Scott Bequette" => "Scott Bequette",
		"Sean Holt" => "Sean Holt",
		),
         8=> array(
		"RB1" => "RB1 - Dave Kemp",
		"RB2" => "RB2 - Derek Bolton",
		"RB3" => "RB3 - Jeff Little",
		"RB4" => "RB4 - Randy Miles",
		"RB5" => "RB5 - Robert Prpich",
		"RB6" => "RB6 - Tad Campbell",
		"RB7" => "RB7 - Terry Harper",
		"RB8" => "RB8 - Terry McBride",
		)
         );
/* 2010
      $teams = array(
         // PeeWee
         4=> array(
            "Rockies"=> "1. Rockies - Jeremy Potter",
            "Marlins"=> "2. Marlins - Terry McBride",
            "Pirates"=> "3. Pirates - Mike Okerlund",
            "Twins"=> "4. Twins - Kyle Nelson",
            "Yankees"=> "5. Yankees - Don Mortensen",
            "Dodgers"=> "6. Dodgers - Corey Lewis",
            "A's"=> "7. A's - Kevin Affleck",
            "Giants"=> "8. Giants - Cory Proulx",
            "Mariners"=> "9. Mariners - Bryan Jeppsen",
            "Diamond Backs"=> "10. Diamond Backs - Bart Street",
            "Indians"=> "11. Indians - Scott Ball",
            "Cardinals"=> "12. Cardinals - James Robinson",
            "Phillies"=> "13. Phillies - Dusty Poulson",
            "Angels"=> "14. Angels - Ray Wilkes",
            "Reds"=> "15. Reds - Ryan McClellan",
            "Red Sox"=> "16. Red Sox - Matt Dixon",
            "Astros"=> "17. Astros - Mike Stone",
            "Tigers"=> "18. Tigers - Mitch Curtis",
            ),
         // Minor
         // Angels, Reds, Twins, Giants, Indians, Pirates
         // Dodgers, D-Backs, Yankees, Cardinals, Royals, Astros
         5=> array(
            'Cardinals' => '1. Cardinals - Brent Oldroyd',
            'Twins' => '2. Twins - Trent Dansie',
            'Giants' => '3. Giants - Richard Goodrich',
            'Dodgers' => '4. Dodgers - Scott Linford',
            'Pirates' => '5. Pirates - Shawn Vernon',
            'D-Backs' => '6. D-Backs - Denny Barlow',
            'Royals' => '7. Royals - Ken Hart',
            'Yankees' => '8. Yankees - Mark Graham',
            'Angels' => '9. Angels - Ed Day',
            'Indians' => '10. Indians - Shawn Bergon',
            'Reds' => '11. Reds - Gary Young',
            'Astros' => '12. Astros - Paul Beck',
            ),
         // Major
         6=> array(
            "White Sox"=> "1. White Sox - Jim Garn",
            "Cardinals"=> "2. Cardinals - Kyle Price",
            "Phillies"=> "3. Phillies - Chris King",
            "Giants"=> "4. Giants - Todd Nelson",
            "Yankees"=> "5. Yankees - Dennis Pennington",
            "Orioles"=> "6. Orioles - Nick Trujillo",
            "Reds"=> "7. Reds - Jason Lee",
            "Rockies"=> "8. Rockies - Kris Tolley",
            "Mariners"=> "9. Mariners - Sean Holt",
            "Mets"=> "10. Mets - Mike Musser",
            ),
         7=> array(
            "Chris Smith"=> "1. Chris Smith",
            "Robert Prpich"=> "2. Robert Prpich",
            "Brad Van Skyhawk"=> "3. Brad Van Skyhawk",
            "Kathy Schroeder"=> "4. Kathy Schroeder",
            "Derek Bolton"=> "5. Derek Bolton",
            ),
         8=> array(
            "Randy Miles" => "1. Randy Miles",
            "Jeff Little" => "2. Jeff Little",
            "Dave Kemp" => "3. Dave Kemp",
            "Jeff Quinn" => "4. Jeff Quinn",
            "Kelly Dumont" => "5. Kelly Dumont",
            "Lynn Moore" => "6. Lynn Moore",
            "Terry Harper" => "7. Terry Harper",
            "Tad Campbell" => "8. Tad Campbell",
            )
         ); */
      if (isset($teams[$league_id]))
      {
         //ksort($teams[$league_id]);
         return $teams[$league_id];
      }

      $teams = $this->Player->query("SELECT Player.last_team FROM players Player WHERE Player.league_id='$league_id' AND last_team<>'' ORDER BY last_team");
      $set = Set::extract($teams, '{n}.Player.last_team');
      return array_combine($set, $set);
   }

}

?>
