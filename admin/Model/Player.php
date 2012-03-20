<?php
class Player extends AppModel {
	var $name = 'Player';
	var $displayField = 'last_name';
	var $validate = array(
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the players first name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the players last name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'birthdate' => array(
			'date' => array(
				'rule' => array('date', 'mdy'),
				'message' => 'Please enter the players birth date',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter an address',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a city',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'zip' => array(
			'postal' => array(
				'rule' => array('postal'),
				'message' => 'Please enter a zip code',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'day_phone' => array(
			'phone' => array(
				'rule' => array('phone'),
				'message' => 'Please enter a day phone',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'moms_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the mothers name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'dads_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the fathers name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter an email address',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'school_boundary' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the school boundary',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'jersey_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the name to be on the Jersey',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'shirt_size' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the shirt size',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pant_size' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the pant size',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'league_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the league',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array('League', 'Team');

	function beforeSave()
	{
      if (isset($this->data['Player']['birthdate']))
      {
         $time = strtotime($this->data['Player']['birthdate']);
         unset($this->data['Player']['birthdate']);
         if ($time)
         {
            $this->data['Player']['birthdate'] = date('Y-m-d', $time);
         }
      }
      return true;
   }

   function afterFind($results)
   {
      foreach ($results as $key => $val)
      {
         if (isset($results[$key]['Player']['id']))
         {
            $results[$key]['Player']['full_name'] = $val['Player']['first_name'] . ' ' . $val['Player']['last_name'];
            $results[$key]['Player']['name'] = $val['Player']['last_name'] . ', ' . $val['Player']['first_name'];
            $phones = array();
            if (!empty($val['Player']['evening_phone']))
            {
               $phones[] = $val['Player']['evening_phone'];
            }
            if (!empty($val['Player']['day_phone']) and !in_array($val['Player']['day_phone'], $phones))
            {
               $phones[] = $val['Player']['day_phone'];
            }
            if (!empty($val['Player']['cell_phone']) and !in_array($val['Player']['cell_phone'], $phones))
            {
               $phones[] = $val['Player']['cell_phone'];
            }
            $results[$key]['Player']['phone'] = join("\r", $phones);
            $results[$key]['Player']['dob'] = 'No Date';
//            $results[$key]['Player']['birthdate'] = $results[$key]['Player']['birthdate'] == '0000-00-00' ? null : $results[$key]['Player']['birthdate'];
            $date = strtotime($val['Player']['birthdate']);
            if ($date !== false)
            {
               $results[$key]['Player']['dob'] = date('M d, Y', $date);
            }
            $results[$key]['Player']['age'] = $this->datediff('yyyy', $val['Player']['birthdate'], 'April 30, ' . date('Y'));
         }
      }
      return $results;
   }

   function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
      /*
      $interval can be:
      yyyy - Number of full years
      q - Number of full quarters
      m - Number of full months
      y - Difference between day numbers
      (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
      d - Number of full days
      w - Number of full weekdays
      ww - Number of full weeks
      h - Number of full hours
      n - Number of full minutes
      s - Number of full seconds (default)
      */

      if (!$using_timestamps) {
         $datefrom = strtotime($datefrom, 0);
         $dateto = strtotime($dateto, 0);
      }
      $difference = $dateto - $datefrom; // Difference in seconds

      switch($interval) {

          case 'yyyy': // Number of full years

          $years_difference = floor($difference / 31536000);
         if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
            $years_difference--;
         }
         if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
            $years_difference++;
          }
         $datediff = $years_difference;
         break;

         case "q": // Number of full quarters

         $quarters_difference = floor($difference / 8035200);
         while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
         }
         $quarters_difference--;
         $datediff = $quarters_difference;
         break;

         case "m": // Number of full months

         $months_difference = floor($difference / 2678400);
         while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
         }
         $months_difference--;
         $datediff = $months_difference;
         break;
     
         case 'y': // Difference between day numbers
     
         $datediff = date("z", $dateto) - date("z", $datefrom);
         break;
     
         case "d": // Number of full days
     
         $datediff = floor($difference / 86400);
         break;
     
         case "w": // Number of full weekdays
     
         $days_difference = floor($difference / 86400);
         $weeks_difference = floor($days_difference / 7); // Complete weeks
         $first_day = date("w", $datefrom);
         $days_remainder = floor($days_difference % 7);
         $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
         if ($odd_days > 7) { // Sunday
            $days_remainder--;
         }
         if ($odd_days > 6) { // Saturday
            $days_remainder--;
         }
         $datediff = ($weeks_difference * 5) + $days_remainder;
         break;
     
         case "ww": // Number of full weeks
     
         $datediff = floor($difference / 604800);
         break;
     
         case "h": // Number of full hours
     
         $datediff = floor($difference / 3600);
         break;
     
         case "n": // Number of full minutes
     
         $datediff = floor($difference / 60);
         break;
     
         default: // Number of full seconds (default)
     
         $datediff = $difference;
         break;
      }
     
      return $datediff;

   }

}