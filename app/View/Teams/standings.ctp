<div class="teams form">
<?php echo $this->Form->create('Team');?>
<?php if (isset($teams)): ?>
	<fieldset>
 		<legend>Team Standings -- <?php echo $league['League']['name'] ?></legend>
 		<table>
 		   <tr>
 		      <th>Team</th>
 		      <th>Coach</th>
 		      <th>Wins</th>
 		      <th>Loses</th>
 		      <th>Ties</th>
 		   </tr>
 		<?php foreach ($teams as $team): ?>
 		   <tr>
 		      <td>
 		         <?php echo $team['Team']['name']?>
    		      <?php $id = $team['Team']['id']?>
    		      <?php echo $this->Form->hidden("Team.$id.id", array('value' => $id))?>
    		      
 		      </td>
 		      <td><?php echo $team['Team']['coach']?></td>
 		      <td><?php echo $this->Form->input("Team.$id.wins", array('value' => $team['Team']['wins'], 'label' => false, 'style' => 'width: 70px;'))?></td>
 		      <td><?php echo $this->Form->input("Team.$id.loses", array('value' => $team['Team']['loses'], 'label' => false, 'style' => 'width: 70px;'))?></td>
 		      <td><?php echo $this->Form->input("Team.$id.ties", array('value' => $team['Team']['ties'], 'label' => false, 'style' => 'width: 70px;'))?></td>
 		   </tr>
 		<?php endforeach; ?>
 	</table>
   </fieldset>
<?php else: ?>
	<fieldset>
 		<legend>Team Standings -- Please select league</legend> 
 		
 		<?php foreach ($leagues as $id => $name): ?>
 		   <p><?php echo $this->Html->link($name, array('action' => 'standings', $id))?></p>
 		<?php endforeach; ?>
	</fieldset>
<?php endif; ?> 
<?php echo $this->Form->end('Submit');?>
</div>
