<div class="games view">
<h2><?php  echo __('Game');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($game['Game']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('League'); ?></dt>
		<dd>
			<?php echo $this->Html->link($game['League']['name'], array('controller' => 'leagues', 'action' => 'view', $game['League']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Home Team'); ?></dt>
		<dd>
			<?php echo h($game['Game']['home_team']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Away Team'); ?></dt>
		<dd>
			<?php echo h($game['Game']['away_team']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Field'); ?></dt>
		<dd>
			<?php echo $this->Html->link($game['Field']['name'], array('controller' => 'fields', 'action' => 'view', $game['Field']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Machine Pitch'); ?></dt>
		<dd>
			<?php echo h($game['Game']['machine_pitch']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Game Time'); ?></dt>
		<dd>
			<?php echo h($game['Game']['game_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cancelled'); ?></dt>
		<dd>
			<?php echo h($game['Game']['cancelled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Makeup'); ?></dt>
		<dd>
			<?php echo h($game['Game']['makeup']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Playoff'); ?></dt>
		<dd>
			<?php echo h($game['Game']['playoff']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($game['Game']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($game['Game']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Game'), array('action' => 'edit', $game['Game']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Game'), array('action' => 'delete', $game['Game']['id']), null, __('Are you sure you want to delete # %s?', $game['Game']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Games'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Game'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fields'), array('controller' => 'fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field'), array('controller' => 'fields', 'action' => 'add')); ?> </li>
	</ul>
</div>
