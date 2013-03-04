<div class="teams index">
	<h2><?php echo __('Teams');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th class="actions"><?php echo __('Actions');?></th>
		<th><?php echo $this->Paginator->sort('team_id');?></th>
		<th><?php echo $this->Paginator->sort('league_id');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('coach');?></th>
		<th><?php echo $this->Paginator->sort('coach_phone');?></th>
		<th><?php echo $this->Paginator->sort('wins');?></th>
		<th><?php echo $this->Paginator->sort('loses');?></th>
		<th><?php echo $this->Paginator->sort('ties');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('modified');?></th>
	</tr>
	<?php
	foreach ($teams as $team): ?>
	<tr>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $team['Team']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $team['Team']['id']), null, __('Are you sure you want to delete # %s?', $team['Team']['id'])); ?>
		</td>
		<td><?php echo h($team['Team']['team_id']); ?>&nbsp;</td>
		<td><?php echo h($team['League']['name']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['name']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['coach']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['coach_phone']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['wins']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['loses']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['ties']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['created']); ?>&nbsp;</td>
		<td><?php echo h($team['Team']['modified']); ?>&nbsp;</td>
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
	
</div>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Team', true), array('controller' => 'teams', 'action' => 'add'));?> </li>
		</ul>
	</div>
