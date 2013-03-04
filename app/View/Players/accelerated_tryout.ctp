<?php if (isset($players)): ?>
<div class="index players">
<h2>Accelerated Tryout -- <?php echo $players[0]['League']['name']; ?></h2>
<p>This is the list of players trying out for all stars. Click one of the links below to
download the report as a PDF Document or Excel Spreadsheet.</p>
<p>
<?php echo $this->Html->link('Add Tryout Number', array('action'=> 'accelerated_tryout', 'number', $league_id), null, 'This will reset all of the all star tryout numbers. Continue?'); ?>

<?php echo $this->Html->link('Download PDF', array('action'=> 'accelerated_tryout', 'pdf', $league_id)); ?>

<?php echo $this->Html->link('Download Excel', array('action'=> 'accelerated_tryout', 'csv', $league_id)); ?>
</p>
<table>
   <tr>
      <th>Actions</th>
      <th>#</th>
      <th>Name</th>
      <th>Age/DOB</th>
      <th>Contact Info</th>
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
      <td><?php echo $p['Player']['accelerated_tryout_number']; ?> </td>
      <td><?php echo $p['Player']['name']; ?><br><?php echo $p['Team']['name'] ?></td>
      <td><?php echo $p['Player']['age'], '<br/>', $p['Player']['dob']; ?> </td>
      <td><?php echo nl2br($p['Player']['phone']); ?> </td>
   </tr>
   <?php endforeach; ?>
</table>
</div>
<?php else: ?>
<div class="players form">
<?php echo $this->Form->create('Player', array('action'=> 'accelerated_tryout'));?>
	<fieldset>
 		<legend>Accelerated Tryout List -- Please select list</legend>
	<?php
		echo $this->Form->input('league_id');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<?php endif; ?>
