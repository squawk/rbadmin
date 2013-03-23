<?php
	$games = $this->requestAction('games/schedule');
	$umpires = $this->requestAction('umpires/all');
	$title = 'Full Schedule For This Week';
?>
<?php echo $this->element('schedule', compact('games', 'umpires', 'title')); ?>
