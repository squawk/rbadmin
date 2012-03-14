<?php if (isset($players)): ?>
<div class="index players">
<h2><?php echo $players[0]['League']['name']; ?></h2>
<p>This is the list of players trying out. Click one of the links below to 
download the report as a PDF Document or Excel Spreadsheet.</p>
<p>
<?php echo $this->Html->link('Add Tryout Number', array('action'=> 'tryout', 'number', $league_id), null, 'This will reset all of the tryout numbers. Continue?'); ?>

<?php echo $this->Html->link('Download PDF', array('action'=> 'tryout', 'pdf', $league_id)); ?>

<?php echo $this->Html->link('Download Excel', array('action'=> 'tryout', 'csv', $league_id)); ?>
</p>
<table>
   <tr>
      <th>Actions</th>
      <th>#</th>
      <th>Name</th>
      <th>Age/DOB</th>
      <th>Contact Info</th>
      <th>Last Team</th>
      <th>Comments</th>
   </tr>

   <?php $num = 0; ?>
   <?php foreach ($players as $p): ?>
   <?php if ($num++ %2): ?>
   <tr>
   <?php else: ?>
   <tr class="altrow">
   <?php endif; ?>
      <td class="actions" nowrap>
      	<?php echo $this->Html->link(__('Edit', true), array('action'=>'edit', $p['Player']['id'])); ?>
      </td>
      <td><?php echo $p['Player']['tryout_number']; ?> </td>
      <td><?php echo $p['Player']['name']; ?></td>
      <td><?php echo $p['Player']['age'], '<br/>', $p['Player']['dob']; ?> </td>
      <td><?php echo nl2br($p['Player']['phone']); ?> </td>
      <td><?php echo $p['Player']['last_team']; ?></td>
      <td><?php echo $p['Player']['note']; ?></td>
   </tr>
   <?php endforeach; ?>
</table>
</div>
<?php else: ?>
<div class="players form">
<?php echo $this->Form->create('Player', array('action'=> 'tryout'));?>
	<fieldset>
 		<legend>Tryout List -- Please select list</legend> 
	<?php
		echo $this->Form->input('league_id');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<?php endif; ?> 
