<?php echo $this->Form->create('Umpire'); ?>
<fieldset>
	<legend>Login</legend>
<?php 
echo $this->Form->input('username');
echo $this->Form->input('password');
?>
</fieldset>
<?php echo $this->Form->end('Login'); ?>

<br>
<p><?php echo $this->Html->link('Register for an Account', array('controller' => 'umpires', 'action' => 'register')); ?></p>

<?php echo $this->element('all_schedule')?>