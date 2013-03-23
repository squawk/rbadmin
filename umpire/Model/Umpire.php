<?php
class Umpire extends AppModel
{
	public $displayField = 'name';

	public $hasMany = array('Request', 'Schedule');

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
				'message' => 'This username has already been taken.'
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
		),
		'cell_phone' => array(
			'Valid phone' => array(
				'rule' => array('phone', null, 'us'),
				'allowEmpty' => true,
				'message' => 'Please use 999-999-999 for your phone number'
			)
		),
		'home_phone' => array(
			'Valid phone' => array(
				'rule' => array('phone', null, 'us'),
				'allowEmpty' => true,
				'message' => 'Please use 999-999-999 for your phone number'
			)
		),
	);

	/**
	 * Password validation
	 */
	public function matchPasswords($data)
	{
		if ($data['password'] == $this->data['Umpire']['password_confirmation'])
		{
			return true;
		}
		$this->invalidate('password_confirmation', 'Your passwords do not match');

		return false;
	}

	/**
	 * Encrypt password before saving
	 *
	 * @param $options
	 */
	public function beforeSave($options = array())
	{
		if (isset($this->data['Umpire']['password']))
		{
			$this->data['Umpire']['password'] = AuthComponent::password($this->data['Umpire']['password']);
		}

		return true;
	}

}
