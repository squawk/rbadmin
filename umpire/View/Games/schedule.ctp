<div class="requests index">
	<h2>My Schedule</h2>
	<p>These are the games you are scheduled to work.</p>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th>League</th>
		<th>Game Time</th>
		<th>Home Team</th>
		<th>Away Team</th>
		<th>Field</th>
	</tr>
	<?php
	$i = 0;
	foreach ($requests as $request):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $request['League']['name']; ?>
		</td>
		<td>
			<?php echo $time->nice($request['Game']['game_time']); ?>
		</td>
		<td>
			<?php echo $request['TeamHome']['name']; ?>
		</td>
		<td>
			<?php echo $request['TeamAway']['name']; ?>
		</td>
		<td>
			<?php echo $request['Field']['name']; ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
