<div class="schedules form">
<?php echo $this->Form->create('Schedule', array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Add Schedule'); ?></legend>
	<?php
		echo $this->Form->input('filename', array('type' => 'file'));
		echo $this->Form->input('dir', array('type' => 'hidden'));
		echo $this->Form->input('mimetype', array('type' => 'hidden'));
		echo $this->Form->input('filesize', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
