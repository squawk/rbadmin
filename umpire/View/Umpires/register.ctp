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
$contacts = array('email' => 'Email', 'text' => 'Text Message', 'cell' => 'Cell Phone', 'home' => 'Home Phone');
/**
 * help block
 'after'=>'<span class="help-block">(10 numbers only)</span></div>'
 */
?>
<div class="span6 offset2 well">
<?php echo $this->Form->create('Umpire', array(
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));?>
	<h3>Register</h3>
	<p>Please enter the information below to register.</p>
	<?php
		echo $this->Form->input('username', array('required', 'placeholder' => 'Enter a username'));
		echo $this->Form->input('password', array('required', 'placeholder' => 'Enter a password'));
		echo $this->Form->input('password_confirmation', array('type' => 'password', 'required', 'placeholder' => 'Confirm password'));
		echo $this->Form->input('name', array('required', 'placeholder' => 'Enter your name'));
		echo $this->Form->input('age', array('placeholder' => 'Enter your age'));
		echo $this->Form->input('email', array('type' => 'email', 'placeholder' => 'Enter your email'));
		echo $this->Form->input('cell_phone', array('type' => 'tel', 'pattern' => '[0-9]{3}-[0-9]{3}-[0-9]{4}', 'placeholder' => 'Cell Phone (999-999-9999)', 'label' => array('text' => 'Cell (999-999-9999)', 'class' => 'control-label')));
		echo $this->Form->input('cell_phone_provider', array('type' => 'select', 'empty' => '- Please Select -', 'options' => $providers));
		echo $this->Form->input('home_phone', array('type' => 'tel', 'placeholder' => 'Home Phone (999-999-9999)', 'label' => array('text' => 'Home (999-999-9999)', 'class' => 'control-label')));
		echo $this->Form->input('preferred_contact_method', array('type' => 'select', 'empty' => '- Please Select -', 'options' => $contacts));
	?>
	<button type="submit" class="btn btn-primary"><i class="icon-user icon-white"></i> Register</button>
</form>
</div>
<div class="clearfix"></div>
