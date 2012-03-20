<?php $games = $this->requestAction('games/schedule'); ?>
<?php $schedule = $this->params['action'] == 'schedule'; ?>
<?php echo $this->Html->css('schedule')?>
<div class="games">
<?php //pr($games)?>
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
<h2>Full Schedule For This Week</h2>
<?php endif; ?>
<?php $startTable = true; ?>
<?php $dayBreak = true; ?>
<a name="<?php echo $game['League']['slug'] ?>"></a>
<div class="schedule-date"><?php echo $textLeague; ?></div>
<table class="schedule-table" width="100%" cellpadding="2" cellspacing="1" border="0">
<thead>
<tr>
	<td class="title-row" width="5%">Game ID</td>
	<td class="title-row" width="10%">Game Time</td>
	<td class="title-row" width="20%">Home Team</td>
	<td class="title-row" width="20%">Away Team</td>
	<td class="title-row" width="20%">Field</td>
	<td class="title-row" width="25%">Umpire</td>
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
	   <?php if (isset($game['Schedule']['User'])): ?>
	      <strong><?php echo $game['Schedule']['User']['name']; ?></strong>
              <?php if ($schedule): ?>
              <?php if ($game['Schedule']['User']['cell_phone']) echo '<br/>C:', $game['Schedule']['User']['cell_phone']; ?>
              <?php if ($game['Schedule']['User']['home_phone']) echo '<br/>H:', $game['Schedule']['User']['home_phone']; ?>
              <?php endif; ?>
      <?php endif; ?>
	   &nbsp;
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
