<?php 
if ($players)
{
	foreach ($players as $player)
	{
		$p = $player['LastYearPlayer'];
		if ($p['birthdate'] == '0000-00-00')
		{
			$p['birthdate'] = null;
		}
   	echo sprintf("%s %s|%s|%s\n", ucwords(strtolower($p['first_name'])), ucwords(strtolower($p['last_name'])), $this->Time->format('F j, Y', $p['birthdate'], 'Missing'), implode('|', $p));
   }
}
?>