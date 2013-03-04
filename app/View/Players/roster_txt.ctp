<?php $teams = array_keys($players); ?>
<?php if (isset($players)): ?>
<?php foreach ($teams as $team): ?>
<?php foreach ($players[$team] as $p): ?>
<?php echo strtoupper($p['Player']['last_name']), "\n"; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endif; ?>
