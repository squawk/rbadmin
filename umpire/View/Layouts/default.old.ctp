<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Riverton Baseball Umpires');
?>
<!doctype html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Imprima');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/pepper-grinder/jquery-ui.css');
	?>
	<script type="text/javascript">
	var home_url = '<?php echo $this->webroot ?>';
	</script>
	
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
</head>
<body>
	<div id="container">
		<header>
			<h1><?php echo $this->Html->link($cakeDescription, '/'); ?>
			<?php if (isset($username)) echo '- Welcome, ', $username, ' ', $this->Html->link('[Logout]', array('controller' => 'users', 'action' => 'logout')); ?></h1>
		</header>
		
		<div id="content" role="main">

			<?php 
			echo $this->Session->flash(); 
			echo $this->Session->flash('auth');
			?>

			<?php echo $content_for_layout; ?>
			
			<?php if (isset($user_id)): ?>
			<div class="actions">
			<h3>Menu</h3>
			<ul>
			   <?php if (AuthComponent::user('role') == 'admin'): ?>
   		      <li><?php echo $this->Html->link('Assign Games', array('controller' => 'games', 'action' => 'assign_games'));?></li>
			   <?php endif; ?>
   		      <li><?php echo $this->Html->link('My Profile', array('controller' => 'umpires', 'action' => 'profile'));?></li>
		         <li><?php echo $this->Html->link('Game Request', array('controller' => 'games', 'action' => 'request'));?></li>
      		   <li><?php echo $this->Html->link('My Schedule', array('controller' => 'games', 'action' => 'myschedule'));?></li>
		         <li><?php echo $this->Html->link('Change Password', array('controller' => 'umpires', 'action' => 'change_password'));?></li>
		         <li><?php echo $this->Html->link('Logout', array('controller' => 'umpires', 'action' => 'logout'));?></li>
			</ul>
			</div>
			<?php endif; ?>
			

		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<?php
	   echo $this->Html->script(array('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js', 'scripts'));
	   echo $scripts_for_layout;
	   echo $this->Js->writeBuffer(array('cache' => true));
	?>
</body>
</html>