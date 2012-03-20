<div class="gaems form">
<?php echo $this->Form->create('Game', array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Add Schedule'); ?></legend>
	<?php
	   echo $this->Form->input('league_id', array('empty' => '- Select League -'));
		echo $this->Form->input('filename', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
