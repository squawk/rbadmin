<?php 
pr($teams); ?>
<option value="0">Tryout or Not Assigned</option>
<?php foreach ($teams as $id => $team): ?>
<option value="<?php echo $id; ?>"><?php echo $team; ?></option>
<?php endforeach; ?>
