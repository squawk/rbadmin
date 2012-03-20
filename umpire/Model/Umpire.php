<?php
class Umpire extends AppModel {
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

   function hashPasswords($data)
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
