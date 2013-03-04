<div class="games index">
	<h2><?php echo __('Games');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('league_id');?></th>
			<th><?php echo $this->Paginator->sort('home_team');?></th>
			<th><?php echo $this->Paginator->sort('away_team');?></th>
			<th><?php echo $this->Paginator->sort('field_id');?></th>
			<th><?php echo $this->Paginator->sort('game_type');?></th>
			<th><?php echo $this->Paginator->sort('game_time');?></th>
			<th><?php echo $this->Paginator->sort('cancelled');?></th>
			<th><?php echo $this->Paginator->sort('makeup');?></th>
			<th><?php echo $this->Paginator->sort('playoff');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($games as $game): ?>
	<tr>
		<td><?php echo h($game['Game']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($game['League']['name'], array('controller' => 'leagues', 'action' => 'view', $game['League']['id'])); ?>
		</td>
		<td><?php 
		   $league_id = $game['League']['id'];
		   $home = $game['Game']['home_team'];
		   $away = $game['Game']['away_team'];
		   
		   echo empty($teams[$league_id][$home]) ? h($home) : h($teams[$league_id][$home]);
		   ?>
		   &nbsp;
		</td>
		<td><?php echo empty($teams[$league_id][$away]) ? h($away) : h($teams[$league_id][$away]); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($game['Field']['name'], array('controller' => 'fields', 'action' => 'view', $game['Field']['id'])); ?>
		</td>
		<td><?php echo h($game['Game']['game_type']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['game_time']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['cancelled']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['makeup']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['playoff']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['created']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $game['Game']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $game['Game']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $game['Game']['id']), null, __('Are you sure you want to delete # %s?', $game['Game']['id'])); ?>
		</td>
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
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Game'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fields'), array('controller' => 'fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field'), array('controller' => 'fields', 'action' => 'add')); ?> </li>
	</ul>
</div>
