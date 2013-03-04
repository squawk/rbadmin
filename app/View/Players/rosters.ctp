<?php if (isset($players)): ?>
<?php $teams = array_keys($players); ?>
<div class="players index">
<p>This is the list of players grouped by team.</p>
<p>
<?php echo $this->Html->link('Download PDF', array('action'=> 'rosters', 'pdf', $this->params['data']['Player']['league_id'])); ?>

<?php echo $this->Html->link('Download Last Name List', array('action'=> 'rosters', 'lastname', $this->params['data']['Player']['league_id'])); ?>
</p>

<?php foreach ($teams as $team): ?>
<?php if (empty($team)): ?>
<h2>No Assigned Team</h2>
<?php else: ?>
<h2><?php echo $team ?></h2>
<?php endif; ?>

<table>
   <tr>
      <th>Action</th>
      <th>#</th>
      <th>Name</th>
      <th>Age/DOB</th>
      <th>Contact Info</th>
      <th>Comments</th>
      <th>Tryout</th>
   </tr>

   <?php $num = 1; ?>
   <?php foreach ($players[$team] as $p): ?>
   <?php if ($num % 2): ?>
   <tr>
   <?php else: ?>
   <tr class="altrow">
   <?php endif; ?>
      <td class="actions" nowrap>
         <?php //echo $this->Html->link('QEdit', array('action' => 'qedit', $p['Player']['id']), array('class' => 'edit-window'))?>
      	<?php echo $this->Html->link(__('Edit', true), array('action'=>'edit', $p['Player']['id'])); ?>
		   <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $p['Player']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $p['Player']['name'])); ?>
      </td>
      <td><?php echo $num++; ?> </td>
      <td nowrap><?php echo $p['Player']['name']; ?></td>
      <td nowrap><?php echo $p['Player']['age'], '<br/>', $p['Player']['dob']; ?> </td>
      <td><?php echo nl2br($p['Player']['phone']); ?> </td>
      <td><?php echo $p['Player']['note']; ?></td>
      <td><?php if ($p['Player']['team_id'] == 0) echo 'X'; ?></td>
   </tr>
   <?php endforeach; ?>
   
</table>

<?php endforeach; ?>
</div>

<?php else: ?>
<div class="players form">
<?php echo $this->Form->create('Player', array('action'=> 'rosters'));?>
	<fieldset>
 		<legend>Team Rosters -- Please select league</legend> 
	<?php
		echo $this->Form->input('league_id');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<?php endif; ?> 
