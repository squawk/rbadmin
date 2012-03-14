<?php extract($this->requestAction(array('controller' => 'players', 'action' => 'clothing'))); ?>
<div class="players">
<?php echo $this->Form->create('Player', array('id' => 'pop-edit'));?>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('allstar_tryout');
		//echo $this->Form->submit('Submit');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('birthdate', array('label' => 'Birthdate (e.g. 3/4/97)', 'type' => 'text'));
		echo $this->Form->input('school_boundary');
      echo $this->Form->input('jersey_name');
      echo $this->Form->input('shirt_size', array('options' => $shirts));
      echo $this->Form->input('pant_size', array('options' => $pants));
		echo $this->Form->input('league_id', array('empty' => '- Select League -'));
   	echo $this->Form->input('team_id', array('empty' => 'Tryout or Not Assigned'));
   	echo $this->Form->input('last_team');
   ?>
   <?php if (0):?>
   <fieldset>
      <legend>Family</legend>
   <?php
   	echo $this->Form->input('brother_pick');
   	echo $this->Form->input('coaches_pick');
   ?>
   </fieldset>
	<?php
		echo $this->Form->input('note', array('label' => 'Notes'));
	?>
	<?php endif; ?>
<?php echo $this->Js->submit('Save')?>
<?php echo $this->Form->end();?>
</div>
