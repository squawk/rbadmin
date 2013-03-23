<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>

		<title>Umpires · <?php echo $title_for_layout; ?></title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-responsive.min');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('styles');
		echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/pepper-grinder/jquery-ui.css');
		?>

	    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    	<!--[if lt IE 9]>
    	  <?php echo $this->Html->script('lib/html5shiv') ?>
    	<![endif]-->
    </head>

<body data-spy="scroll" data-target=".navbar">
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
    <![endif]-->

    <?php echo $this->element('header') ?>

    <div class="container" role="main" id="main">

      <?php echo $this->Session->flash(), $this->Session->flash('auth'); ?>
      <?php echo $this->fetch('content'); ?>

      <hr>

      <footer>
        <p>&copy; The Van Skyhawk Group, LLC, 2010-2013</p>
      </footer>

    </div> <!-- /container -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo $this->params->webroot ?>js/lib/jquery.min.js"><\/script>')</script>
    <?php echo $this->Html->script(
      array(
        '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js',
        'bootstrap.min.js',
        'scripts.js',
        ));
        ?>

      <?php echo $this->fetch('script') ?>

</body>
</html>
