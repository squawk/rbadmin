<?php
if (isset($players[0]['League']['name']))
{
   $this->pageTitle = $players[0]['League']['name'] . 'AllstarTryoutList.csv';
}
else
{
   $this->pageTitle = 'AllstarTryoutList.csv';
}
?>
"#","Name","DOB","Contact Info","Agility","Fielding","Throwing","Batting","Running","Comments"
<?php 
$num = 1;
foreach ($players as $p)
{
   echo $num++, ',"', $p['Player']['name'], '","', $p['Player']['dob'], '","', $p['Player']['phone'], '",,,,,,,', "\n";
}
?>
