<?php extract($this->requestAction(array('controller' => 'players', 'action' => 'clothing'))); ?>
<?php echo $this->Html->script(array('players'), array('inline' => false)) ?>
<div class="players form">
<?php echo $this->Form->create('Player');?>
	<fieldset>
 		<legend>Edit Player</legend>
 		<?php if (!empty($this->data['Player']['txn_id'])): ?><p><strong style="color:blue">Paid with Paypal: txn_id=<?php echo $this->data['Player']['txn_id'] ?></strong></p><?php endif; ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('allstar_tryout');
		echo $this->Form->submit('Submit');
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
		echo $this->Form->input('school_boundary');
      echo $this->Form->input('jersey_name');
      echo $this->Form->input('shirt_size', array('options' => $shirts));
      echo $this->Form->input('pant_size', array('options' => $pants));
		echo $this->Form->input('league_id', array('empty' => '- Select League -'));
   	echo $this->Form->input('team_id', array('empty' => 'Tryout or Not Assigned'));
   	echo $this->Form->input('last_team');
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
