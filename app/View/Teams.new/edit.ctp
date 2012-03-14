<div class="teams form">
<?php echo $this->Form->create('Team');?>
	<fieldset>
		<legend><?php echo __('Edit Team'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('team_id');
		echo $this->Form->input('league_id');
		echo $this->Form->input('name');
		echo $this->Form->input('coach');
		echo $this->Form->input('coach_phone');
		echo $this->Form->input('assistant_coach');
		echo $this->Form->input('assistant_coach_2');
		echo $this->Form->input('wins');
		echo $this->Form->input('loses');
		echo $this->Form->input('ties');
		echo $this->Form->input('tiebreaker');
		echo $this->Form->input('overall_wins');
		echo $this->Form->input('overall_loses');
		echo $this->Form->input('overall_ties');
		echo $this->Form->input('cook_date');
		echo $this->Form->input('cook_time');
		echo $this->Form->input('cook_date2');
		echo $this->Form->input('cook_time2');
		echo $this->Form->input('picture_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Team.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Team.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Players'), array('controller' => 'players', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Player'), array('controller' => 'players', 'action' => 'add')); ?> </li>
	</ul>
</div>
