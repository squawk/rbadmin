<?php
$providers = array(
   'message.alltel.com' => 'Alltel', 
   'txt.att.net' => 'AT&T', 
   'myboostmobile.com' => 'Boost Mobile', 
   'messaging.nextel.com' => 'Nextel (now Sprint Nextel)', 
   'messaging.sprintpcs.com' => 'Sprint PCS (now Sprint Nextel)', 
   'tmomail.net' => 'T-Mobile', 
   'email.uscc.net' => 'US Cellular', 
   'vtext.com' => 'Verizon', 
   'vmobl.com' => 'Virgin Mobile USA');
?>
<div class="users form">
<?php echo $this->Form->create('Umpire');?>
	<fieldset>
 		<legend>My Profile</legend>
 		<p>Please enter any missing information.</p>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('age');
		echo $this->Form->input('email');
		echo $this->Form->input('cell_phone');
		echo $this->Form->input('cell_phone_provider', array('type' => 'select', 'empty' => '- Please Select -', 'options' => $providers));
		echo $this->Form->input('home_phone');
		echo $this->Form->input('preferred_contact_method', array('type' => 'select', 'empty' => '- Please Select -', 'options' => array('email' => 'Email', 'text' => 'Text Message', 'cell' => 'Cell Phone', 'home' => 'Home Phone')));
	?>
	</fieldset>
<?php echo $this->Form->end('Save Profile');?>
</div>
