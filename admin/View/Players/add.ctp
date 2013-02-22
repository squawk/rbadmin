<?php extract($this->requestAction(array('controller' => 'players', 'action' => 'clothing'))); ?>
<?php echo $this->Html->css('jquery.autocomplete', null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.autocomplete','jquery.bgiframe','players-add','players'), array('inline' => false)) ?>
<div class="players form">
	<fieldset>
		<legend>Last Year Player Search</legend>
		<?php echo $this->Form->input('name', array('label' => 'Enter part of the first or last name to copy a record from last year.')); ?>
		<div id="player-message"></div>
	</fieldset>
<?php echo $this->Form->create('Player');?>
	<fieldset>
 		<legend>Add New Player</legend>
	<?php
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('birthdate', array('label' => 'Birthdate (e.g. 3/4/97)', 'type' => 'text'));
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('zip');
		echo $this->Form->input('dads_name', array('label' => 'Father Name'));
		echo $this->Form->input('moms_name', array('label' => 'Mother Name'));
		echo $this->Form->input('day_phone', array('label' => 'Day Phone (e.g. 801-555-1212)'));
		echo $this->Form->input('evening_phone', array('label' => 'Evening Phone (e.g. 801-555-1212)'));
		echo $this->Form->input('cell_phone', array('label' => 'Cell Phone (e.g. 801-555-1212)'));
		echo $this->Form->input('email');
		echo $this->Form->input('jersey_name');
		echo $this->Form->input('shirt_size', array('options' => $shirts));
		echo $this->Form->input('pant_size', array('options' => $pants, 'empty' => '- Select Size -'));
		echo $this->Form->input('league_id', array('empty' => '- Select League -'));
		echo $this->Form->input('team_id', array('empty' => 'Tryout or Not Assigned'));
	?>
   <fieldset>
      <legend>Family</legend>
   <?php
   	echo $this->Form->input('brother_pick');
   	echo $this->Form->input('coaches_pick');
   ?>
   </fieldset>
	<fieldset>
	   <legend>Parent Helps</legend>
	<?php
		echo $this->Form->input('assistant_coach');
		echo $this->Form->input('snack_bar');
		echo $this->Form->input('team_mom');
		echo $this->Form->input('umpire');
		echo $this->Form->input('score_keeping');
	?>
	</fieldset>
	<fieldset>
	   <legend>Player Verifications</legend>
	<?php
		echo $this->Form->input('birth_certificate');
		echo $this->Form->input('address_verify');
	?>
	</fieldset>
	<?php
		echo $this->Form->input('note', array('label' => 'Notes'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
