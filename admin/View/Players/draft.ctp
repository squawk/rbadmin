<style>
button.player {
   float: left;
   width: 230px;
   border: solid 1px black;
   padding: 5px;
   margin: 2px;
   font-size: 14px;
   background-color: #B5A6CE;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
}
button.hat {
   background-color: #ccc;
}
div#teams {
   padding-bottom: 15px;
}
a.team-status {
   float: left;
   padding: 2px;
}
#team-list {
   padding: 5px;
}
div#message {
   font-weight: bold;
   color: green;
   padding: 5px;
   overflow: scroll;
   height: 40px;
   border: 1px dotted gray;
}
</style>

<script type="text/javascript">
	var leagueId = <?php echo $league_id ?>;
	var teams = new Array();
	<?php foreach ($teams as $id => $name): ?>
	teams[<?php echo $id ?>] = "<?php echo $name ?>";
	<?php endforeach; ?>
</script>
<?php echo $this->Html->script('draft', array('inline' => false)); ?>

<?php if (isset($players)): ?>

<div id="teams">
   <strong>Team: </strong>
   <?php echo $this->Form->select('team', $teams); ?>
   <span id="indicator" style="display:none">
      <?php echo $this->Html->image('loading_animation_liferay.gif') ?>
   </span>
</div>
<div id="message"></div>
<div id="players">
<div id="team-list">
   <?php echo $this->element('team_status'); ?>
</div>
   <?php foreach ($players as $p): ?>
      <button class="player <?php if ($p['Player']['hat_pick']) echo 'hat' ?>" type="submit" rel="<?php echo $p['Player']['id'] ?>" id="p<?php echo $p['Player']['id'] ?>">
      <?php echo $p['Player']['tryout_number'], '.', strtoupper($p['Player']['last_name']), ', ', $p['Player']['first_name'], ' (', $p['Player']['age'], ')'; ?>
      </button>
   <?php endforeach; ?> 
</div>

<?php else: ?>

<div class="players form">
<?php echo $this->Form->create('Player', array('action'=> 'draft'));?>
   <fieldset>
      <legend>Team Draft</legend> 
      <?php echo $this->Form->input('league_id'); ?>
   </fieldset>
<?php echo $this->Form->end('Submit');?>
</div>

<?php endif; ?> 
