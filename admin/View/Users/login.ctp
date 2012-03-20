<?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'login', 'encoding' => false)); ?>
<fieldset>
	<legend>Login</legend>
<?php 
echo $this->Form->input('username');
echo $this->Form->input('password');
?>
</fieldset>
<?php echo $this->Form->end('Login'); ?>