<?php
class TeamsController extends AppController 
{
	var $name = 'Teams';

	function index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->paginate());
	}

	function byleague($id = null) 
	{
      $id = $this->request->data['Player']['league_id'];
      $this->Team->contain();
	$conditions = array('Team.league_id' => $id);
	$teams = $this->Team->find('list', compact('conditions'));
      $this->set(compact('teams'));
      $this->layout = 'ajax';
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid team', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('team', $this->Team->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Team->create();
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.', true));
			}
		}
		$leagues = $this->Team->League->find('list');
		$this->set(compact('leagues'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid team', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The team has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Team->read(null, $id);
		}
		$leagues = $this->Team->League->find('list');
		$this->set(compact('leagues'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Team->delete($id)) {
			$this->Session->setFlash(__('Team deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	public function standings($league_id = null)
	{
		if ($this->request->is('post')) 
		{
		   foreach ($this->request->data['Team'] as $team)
		   {
		      if ($team['id'])
		      {
		         $this->Team->id = $team['id'];
		         $this->Team->save($team);
		      }
		   }
		   $this->Session->setFlash('Standings updated');
		   $league_id = 0;
		}
		
		if ($league_id)
		{
			$this->Team->League->contain();
			$league = $this->Team->League->find('first', array('conditions' => array('id' => $league_id)));
			$this->Team->contain();
			$teams = $this->Team->find('all', array('conditions' => array('league_id' => $league_id)));
			$this->set(compact('league', 'teams'));
		}
		
		$leagues = $this->Team->League->find('list', array('conditions' => array('id > 2')));
		$this->set(compact('leagues'));
		
	}
	
}
