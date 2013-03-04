<?php
App::uses('AppModel', 'Model');
CakePlugin::load('MeioUpload');
/**
 * Schedule Model
 *
 */
class Schedule extends AppModel
{
	public $actsAs = array(
		'MeioUpload.MeioUpload' => array('filename' => array('allowedMime' => array('text/plain'), 'allowedExt' => array('txt')))
	);
}
