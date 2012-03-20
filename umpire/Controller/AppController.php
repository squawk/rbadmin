<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Session', 'Html', 'Form', 'Time', 'Js');
   public $components = array('Session', 'RequestHandler', 
	    'Auth' => array(
	        'loginAction' => array(
	            'controller' => 'umpires',
	            'action' => 'login',
	        ),
        'loginRedirect' => array(
            'controller' => 'pages',
            'action' => 'home',
        ),
	
			  'authenticate' => array(	
					'Form' => array('userModel' => 'Umpire'),
			  ),
	    )
	);
   
   function beforeFilter()
   {
      if ($this->Auth->user('id'))
      {
         $this->set('user_id', $this->Auth->user('id'));
         $this->set('username', $this->Auth->user('username'));
         $this->set('login_name', $this->Auth->user('name'));
      }
	}
	
}
