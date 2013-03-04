<?php if (!empty($players)): ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th class="actions">Actions</th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('birthdate');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('league_id');?></th>
			<th><?php echo $this->Paginator->sort('team_id', 'Current Team');?></th>
			<th><?php echo $this->Paginator->sort('last_team');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($players as $player):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		if ($player['Player']['birthdate'] == '1969-12-31')
		{
		 $player['Player']['birthdate'] = null;
		}
	?>
	<tr<?php echo $class;?>>
		<td class="actions">
		   <?php echo $this->Html->link('QEdit', array('action' => 'qedit', $player['Player']['id']), array('class' => 'edit-window'))?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $player['Player']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $player['Player']['id']), null, __('Are you sure you want to delete %s?', $player['Player']['name'])); ?>
		</td>
		<td><?php echo $player['Player']['last_name']; ?>&nbsp;</td>
		<td><?php echo $player['Player']['first_name']; ?>&nbsp;</td>
		<td><?php echo $this->Time->format('M j, Y', $player['Player']['birthdate'], '<strong>Missing Birthdate</strong>'); ?>&nbsp;</td>
		<td><?php echo $player['Player']['email']; ?>&nbsp;</td>
		<td><?php echo $player['League']['name']; ?>&nbsp;</td>
		<td><?php echo $player['Team']['name']; ?>&nbsp;</td>
		<td><?php echo $player['Player']['last_team']; ?>&nbsp;</td>
		<td><?php echo $this->Time->timeAgoInWords($player['Player']['created']); ?>&nbsp;</td>
		<td><?php echo $this->Time->timeAgoInWords($player['Player']['modified']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
<?php else: ?>
No Players Found
<?php endif; ?>
