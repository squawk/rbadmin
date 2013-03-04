<strong><?php echo $team_name; ?></strong>
<table>
   <tr>
      <th>#</th>
      <th>Name</th>
      <th>DOB</th>
      <th>Comments</th>
   </tr>

   <?php $num = 1; ?>
   <?php foreach ($players as $p): ?>
   <?php if ($num % 2): ?>
   <tr>
   <?php else: ?>
   <tr class="altrow">
   <?php endif; ?>
      <td><?php echo $num++; ?> </td>
      <td><?php echo $p['Player']['name'], ' (', $p['Player']['age'], ')'; ?></td>
      <td><?php echo $p['Player']['dob']; ?> </td>
      <td><?php echo $p['Player']['note']; ?></td>
   </tr>
   <?php endforeach; ?>
   
</table>
