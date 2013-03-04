<?php echo $this->Html->script(array('jquery.dimensions', 'jquery.cluetip', 'jquery.bgiframe', 'team-status'), array('inline' => false)) ?>
<?php echo $this->Html->css('jquery.cluetip', null, array('inline' => false));?>
<?php foreach ($team_status as $team): ?>
   <a class="teams-status" rel="<?php echo $this->Html->url(array('admin'=> true, 'action'=> 'teamlist', $league_id, $team['Team']['id'])); ?>" href="<?php echo $this->Html->url(array('admin'=> true, 'action'=> 'teamlist', $league_id, $team['Team']['id'])); ?>">
      <?php echo $team['Team']['name']; ?>:<strong><?php echo $team[0]['count']; ?></strong>
   </a>
   &nbsp;
<?php endforeach; ?>  
<script type="text/javascript">
</script>
