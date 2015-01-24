<?php if (empty($games)): ?>
<h2>Assign Games</h2>
<p>No games found!</p>
<?php else: ?>
<div class="games">
<?php
$schedule = $this->params['action'] == 'schedule';
$saveLeague = '';
$saveDate = '';
$dayBreak = false;
$startTable = false;
?>
<?php foreach ($games as $game): ?>
	<?php
	   $textDate = date('l, F jS', $this->Time->fromString($game['Game']['game_time']));
	   if ($saveDate != $textDate)
	   {
	      $dayBreak = true;
	      $saveDate = $textDate;
	   }
	?>
	<?php $textLeague = $game['League']['name']; ?>
	<?php if ($saveLeague != $textLeague): ?>
	<?php $saveLeague = $textLeague; ?>
	<?php if ($startTable): ?>
	</tbody>
	</table>
	</div>
	<?php else: ?>
		<?php if ($week): ?>
			<h2>Upcoming Schedule</h2>
		<?php else: ?>
			<h2>Schedule This Week</h2>
   		<?php endif; ?>

		<div class="pagination">
   			<ul>
   				<?php if ($week): ?>
				<li><?php echo $this->Html->link('<< Previous Week', array('controller' => 'games', 'action' => 'assign_games', $week - 1)); ?></li>
				<?php endif; ?>
				<li><?php echo $this->Html->link('Next Week >>', array('controller' => 'games', 'action' => 'assign_games', $week + 1)); ?></li>
			</ul>
		</div>
	<?php endif; ?>
	<?php $startTable = true; ?>
	<?php $dayBreak = true; ?>
	<a name="<?php echo $game['League']['slug'] ?>"></a>
	<div class="well">
	<h3><?php echo $textLeague; ?></h3>
	<table class="table table-condensed table-hover" id="header_teams" width="100%">
		<thead>
		<tr>
			<th width="10%">Game ID</th>
			<th width="15%">Game Time</th>
			<th width="15%">Home Team</th>
			<th width="15%">Away Team</th>
			<th width="15%">Field</th>
			<th width="15%">Umpire</th>
			<th width="15%">All Umpires</th>
		</tr>
		</thead>
		<tbody>
	<?php endif; ?>

	<?php if ($dayBreak): ?>
		<tr style="background-color: #ffffff">
		   <th colspan="7" align="center">
		   	<h4><?php echo $textDate ?></h4>
		   </th>
		</tr>
	<?php $dayBreak = false; ?>
	<?php endif; ?>

	<?php if ($game['Game']['makeup']): ?>
		<tr class="makeup">
	<?php elseif ($game['Game']['cancelled']): ?>
		<tr class="cancelled">
	<?php else: ?>
		<tr>
	<?php endif; ?>
	   <td><?php echo $game['Game']['id']?></td>
		<td>
		<?php if ($game['Game']['makeup']) echo '<strong>' ?>
		<?php echo $this->Time->format('g:i a', $game['Game']['game_time']); ?>
		<?php if ($game['Game']['makeup']) echo '</strong>' ?>
		</td>
		<td>
			<?php if (empty($game['TeamHome']['slug'])): ?>
				<?php echo $game['Game']['home_team'] ?>
			<?php else: ?>
				<div class="teams <?php echo $game['TeamHome']['slug'] ?>"><?php echo $game['TeamHome']['name'] ?></div>
			<?php endif; ?>
		</td>
		<td>
			<?php if (empty($game['TeamAway']['slug'])): ?>
				<?php echo $game['Game']['away_team'] ?>
			<?php else: ?>
				<div class="teams <?php echo $game['TeamAway']['slug'] ?>"><?php echo $game['TeamAway']['name'] ?></div>
			<?php endif; ?>
		</td>
		<td>
		<?php if ($game['Game']['cancelled']): ?>
	      CANCELED
	   <?php else: ?>
	      <?php echo $game['Field']['name'] ?>
	      <?php if (!empty($game['Game']['game_type'])) echo sprintf(' (%s)', $game['Game']['game_type']); ?>
		   <?php if ($game['Game']['makeup']) echo ' <strong>(MAKE-UP)</strong>' ?>
	   <?php endif; ?>
		</td>
		<td>
		   <?php if (isset($game['Schedule']['umpire_id'])): ?>
		      <strong><?php echo $umpires[$game['Schedule']['umpire_id']]; ?></strong>
		      <br><?php echo $this->Html->link('<i class="icon-remove-sign icon-white"></i> Unassign', array('controller' => 'games', 'action' => 'unassign', $game['Schedule']['id']), array('escape' => false, 'class' => 'btn btn-danger btn-mini'))?>
		   <?php else: ?>
		      <?php $available = @Set::diff($requests[$game['Game']['game_time']], $schedules[$game['Game']['game_time']]) ?>
		      <?php foreach ($available as $id => $name): ?>
		         <?php echo $this->Html->link($name, array('controller' => 'games', 'action' => 'assign', $game['Game']['id'], $id)), '<br/>' ?>
		      <?php endforeach; ?>
	      <?php endif; ?>
		   &nbsp;
		</td>
		<td>
		   <?php if (!isset($game['Schedule']['umpire_id'])): ?>
		      <?php foreach ($umpires as $id => $name): ?>
		      <?php if (!in_array($id, $available)): ?>
	   	    	  <?php echo $this->Html->link($name, array('controller' => 'games', 'action' => 'assign', $game['Game']['id'], $id)), '<br/>' ?>
	   	  		<?php endif; ?>
	      	<?php endforeach; ?>
	      <?php endif; ?>
		   &nbsp;
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<?php endif; ?>