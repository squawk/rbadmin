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
		<?php if (!empty($title)): ?>
		<h2><?php echo $title ?></h2>
		<?php endif; ?>
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
			<th width="10%">Game Time</th>
			<th width="17%">Home Team</th>
			<th width="17%">Away Team</th>
			<th width="20%">Field</th>
			<th width="25%">Umpire</th>
		</tr>
		</thead>
		<tbody>
	<?php endif; ?>

	<?php if ($dayBreak): ?>
		<tr style="background-color: #ffffff">
		   <th colspan="6" align="center">
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
	      <?php endif; ?>
		   &nbsp;
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
