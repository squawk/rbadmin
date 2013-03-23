<div class="games index">
   <h2>My Schedule</h2>
<?php if (empty($games)): ?>
   <p>You are not schedules this week.</p>
   <p>Remember the entire schedule is on the home page.</p>
<?php else: ?>
	<?php echo $this->element('schedule', compact('games', 'umpires', 'title')); ?>
<?php endif; ?>
</div>
