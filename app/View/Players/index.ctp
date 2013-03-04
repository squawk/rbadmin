<?php echo $this->Html->script(array('jquery.autocomplete','jquery.bgiframe','players-index','players'), array('inline' => false)) ?>
<div class="players index">
	<h2><?php __('Players');?></h2>
   <?php if (!empty($players)): ?>
	<?php echo $this->Form->create('Player', array('url' => '/players/index')); ?>
   <?php echo $this->Form->input('name', array('label' => 'Player Filter (enter any part of name to filter results)')) ?>
   <noscript><?php echo $this->Form->submit('Search') ?></noscript>
   <div style="display: none" id="indicator">
      <?php echo $this->Html->image('loading_animation_liferay.gif', array('alt'=> 'Indicator')) ?>
   </div>
   <?php echo $this->Form->end(); ?>
   <?php endif; ?>
   <div id="view">
   <?php echo $this->element('player_table'); ?>
   </div>
</div>
