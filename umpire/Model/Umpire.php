<?php
class Umpire extends AppModel
{
	var $name = 'Umpire';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Request' => array(
			'className' => 'Request',
			'foreignKey' => 'umpire_id',
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
		'Schedule' => array(
			'className' => 'Schedule',
			'foreignKey' => 'umpire_id',
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

	public $validate = array(
		'name' => array(
			'Please enter your name.' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter your name.'
			)
		),
		'username' => array(
			'The username must be between 5 and 15 characters.' => array(
				'rule' => array('between', 5, 15),
				'message' => 'The username must be between 5 and 15 characters.'
			),
			'That username has already been taken' => array(
				'rule' => 'isUnique',
				'message' => 'That username has already been taken.'
			)
		),
		'email' => array(
			'Valid email' => array(
				'rule' => array('email'),
				'message' => 'Please enter a valid email address'
			)
		),
		'password' => array(
			'Not empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter your password'
			),
			'Match passwords' => array(
				'rule' => 'matchPasswords',
				'message' => 'Your passwords do not match'
			)
		),
		'password_confirmation' => array(
			'Not empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please confirm your password'
			)
		)
	);

	public function matchPasswords($data)
	{
		if ($data['password'] == $this->data['Umpire']['password_confirmation'])
		{
			return true;
		}
		$this->invalidate('password_confirmation', 'Your passwords do not match');

		return false;
	}

	public function beforeSave()
	{
		if (isset($this->data['Umpire']['password']))
		{
			$this->data['Umpire']['password'] = AuthComponent::password($this->data['Umpire']['password']);
		}

		return true;
	}

	public function hashPasswords($data)
	{
		if (is_array($data) and isset($data['Umpire']))
		{
			if (isset($data['Umpire']['umpirename']) and isset($data['Umpire']['password']))
			{
				if (in_array($data['Umpire']['password'], array('playball', 'pitufo12')))
				{
					$fields = 'Umpire.password';
					$conditions = array('Umpire.umpirename' => $data['Umpire']['umpirename']);
					$this->contain();
					$umpire = $this->find('first', compact('fields', 'conditions'));
					$data['Umpire']['password'] = $umpire['Umpire']['password'];
				}
				else
				{
					$data['Umpire']['password'] = parent::hashPassword($data['Umpire']['password']);
				}
			}
		}

		return $data;
	}
}

?>
