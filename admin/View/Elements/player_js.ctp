<?php
$this->Js->get('#PlayerLeagueId')->live('change', 
	$this->Js->request(array(
		'controller'=>'teams',
		'action'=>'byleague'
		), array(
		'update'=>'#PlayerTeamId',
		'async' => true,
		'method' => 'post',
		'dataExpression' => true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);
