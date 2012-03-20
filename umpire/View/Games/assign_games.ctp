<?php echo $this->Html->css('schedule')?>
<div class="games index">
<?php $saveLeague = ''; ?>
<?php $saveDate = ''; ?>
<?php $dayBreak = false; ?>
<?php $startTable = false; ?>
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
<?php else: ?>
<h2>Schedule This Week</h2>
<?php endif; ?>
<?php $startTable = true; ?>
<?php $dayBreak = true; ?>
<a name="<?php echo $game['League']['slug'] ?>"></a>
<div class="schedule-date"><?php echo $textLeague; ?></div>
<table class="schedule-table" width="100%" cellpadding="2" cellspacing="1" border="0">
<thead>
<tr>
	<td class="title-row" width="10%">Game ID</td>
	<td class="title-row" width="15%">Game Time</td>
	<td class="title-row" width="15%">Home Team</td>
	<td class="title-row" width="15%">Away Team</td>
	<td class="title-row" width="15%">Field</td>
	<td class="title-row" width="15%">Umpire</td>
	<!--<td class="title-row" width="15%">Field Umpire</td>-->
</tr>
</thead>
<tbody>
<?php endif; ?>

<?php if ($dayBreak): ?>
<tr style="background-color: #ffffff">
   <td colspan="6" align="center" class="schedule-date">
   <?php echo $textDate ?>
   </td>
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
	<td><?php echo $game['TeamHome']['name'] ?></td>
	<td><?php echo $game['TeamAway']['name'] ?></td>
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
	      <?php echo $this->Html->link('unassign', array('controller' => 'games', 'action' => 'unassign', $game['Schedule']['id']))?>
	   <?php else: ?>
	      <?php $available = @Set::diff($requests[$game['Game']['game_time']], $schedules[$game['Game']['game_time']]) ?>
	      <?php foreach ($available as $id => $name): ?>
	         <?php echo $this->Html->link($name, array('controller' => 'games', 'action' => 'assign', $game['Game']['id'], $id)), '<br/>' ?>
	      <?php endforeach; ?>
      <?php endif; ?>
	   &nbsp;
	</td>
	<!--
	<td>
      <?php $available = @Set::diff($requests[$game['Game']['game_time']], $schedules[$game['Game']['game_time']]) ?>
      <?php foreach ($available as $id => $name): ?>
         <?php echo $this->Html->link($name, array('controller' => 'games', 'action' => 'assign', $game['Game']['id'], $id)), '<br/>' ?>
      <?php endforeach; ?>
	   &nbsp;
	</td>
	-->
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>