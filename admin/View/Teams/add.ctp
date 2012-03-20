<div class="teams form">
<?php echo $this->Form->create('Team');?>
	<fieldset>
		<legend><?php __('Add Team'); ?></legend>
	<?php
		echo $this->Form->input('team_id', array('label' => 'Team ID', 'type' => 'text'));
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
<?php echo $this->Form->end(__('Submit', true));?>
</div>