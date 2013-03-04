<div class="teams view">
<h2><?php  echo __('Team');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($team['Team']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team Id'); ?></dt>
		<dd>
			<?php echo h($team['Team']['team_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('League'); ?></dt>
		<dd>
			<?php echo $this->Html->link($team['League']['name'], array('controller' => 'leagues', 'action' => 'view', $team['League']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($team['Team']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Coach'); ?></dt>
		<dd>
			<?php echo h($team['Team']['coach']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Coach Phone'); ?></dt>
		<dd>
			<?php echo h($team['Team']['coach_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Assistant Coach'); ?></dt>
		<dd>
			<?php echo h($team['Team']['assistant_coach']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Assistant Coach 2'); ?></dt>
		<dd>
			<?php echo h($team['Team']['assistant_coach_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wins'); ?></dt>
		<dd>
			<?php echo h($team['Team']['wins']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Loses'); ?></dt>
		<dd>
			<?php echo h($team['Team']['loses']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ties'); ?></dt>
		<dd>
			<?php echo h($team['Team']['ties']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tiebreaker'); ?></dt>
		<dd>
			<?php echo h($team['Team']['tiebreaker']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Overall Wins'); ?></dt>
		<dd>
			<?php echo h($team['Team']['overall_wins']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Overall Loses'); ?></dt>
		<dd>
			<?php echo h($team['Team']['overall_loses']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Overall Ties'); ?></dt>
		<dd>
			<?php echo h($team['Team']['overall_ties']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cook Date'); ?></dt>
		<dd>
			<?php echo h($team['Team']['cook_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cook Time'); ?></dt>
		<dd>
			<?php echo h($team['Team']['cook_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cook Date2'); ?></dt>
		<dd>
			<?php echo h($team['Team']['cook_date2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cook Time2'); ?></dt>
		<dd>
			<?php echo h($team['Team']['cook_time2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Picture Date'); ?></dt>
		<dd>
			<?php echo h($team['Team']['picture_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($team['Team']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($team['Team']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Team'), array('action' => 'edit', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Team'), array('action' => 'delete', $team['Team']['id']), null, __('Are you sure you want to delete # %s?', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Players'), array('controller' => 'players', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Player'), array('controller' => 'players', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Players');?></h3>
	<?php if (!empty($team['Player'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Txn Id'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Birthdate'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Day Phone'); ?></th>
		<th><?php echo __('Evening Phone'); ?></th>
		<th><?php echo __('Cell Phone'); ?></th>
		<th><?php echo __('Moms Name'); ?></th>
		<th><?php echo __('Dads Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('School Boundary'); ?></th>
		<th><?php echo __('Jersey Name'); ?></th>
		<th><?php echo __('Shirt Size'); ?></th>
		<th><?php echo __('Pant Size'); ?></th>
		<th><?php echo __('Invalid Email'); ?></th>
		<th><?php echo __('Invalid Domain'); ?></th>
		<th><?php echo __('Optout Email'); ?></th>
		<th><?php echo __('League Id'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('Last Team'); ?></th>
		<th><?php echo __('Assistant Coach'); ?></th>
		<th><?php echo __('Snack Bar'); ?></th>
		<th><?php echo __('Team Mom'); ?></th>
		<th><?php echo __('Umpire'); ?></th>
		<th><?php echo __('Score Keeping'); ?></th>
		<th><?php echo __('Brother Pick'); ?></th>
		<th><?php echo __('Coaches Pick'); ?></th>
		<th><?php echo __('Birth Certificate'); ?></th>
		<th><?php echo __('Address Verify'); ?></th>
		<th><?php echo __('Tryout'); ?></th>
		<th><?php echo __('Tryout Number'); ?></th>
		<th><?php echo __('Allstar Tryout'); ?></th>
		<th><?php echo __('Allstar Tryout Number'); ?></th>
		<th><?php echo __('Hat Pick'); ?></th>
		<th><?php echo __('Picked'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($team['Player'] as $player): ?>
		<tr>
			<td><?php echo $player['id'];?></td>
			<td><?php echo $player['txn_id'];?></td>
			<td><?php echo $player['first_name'];?></td>
			<td><?php echo $player['last_name'];?></td>
			<td><?php echo $player['birthdate'];?></td>
			<td><?php echo $player['address'];?></td>
			<td><?php echo $player['city'];?></td>
			<td><?php echo $player['state'];?></td>
			<td><?php echo $player['zip'];?></td>
			<td><?php echo $player['day_phone'];?></td>
			<td><?php echo $player['evening_phone'];?></td>
			<td><?php echo $player['cell_phone'];?></td>
			<td><?php echo $player['moms_name'];?></td>
			<td><?php echo $player['dads_name'];?></td>
			<td><?php echo $player['email'];?></td>
			<td><?php echo $player['school_boundary'];?></td>
			<td><?php echo $player['jersey_name'];?></td>
			<td><?php echo $player['shirt_size'];?></td>
			<td><?php echo $player['pant_size'];?></td>
			<td><?php echo $player['invalid_email'];?></td>
			<td><?php echo $player['invalid_domain'];?></td>
			<td><?php echo $player['optout_email'];?></td>
			<td><?php echo $player['league_id'];?></td>
			<td><?php echo $player['team_id'];?></td>
			<td><?php echo $player['last_team'];?></td>
			<td><?php echo $player['assistant_coach'];?></td>
			<td><?php echo $player['snack_bar'];?></td>
			<td><?php echo $player['team_mom'];?></td>
			<td><?php echo $player['umpire'];?></td>
			<td><?php echo $player['score_keeping'];?></td>
			<td><?php echo $player['brother_pick'];?></td>
			<td><?php echo $player['coaches_pick'];?></td>
			<td><?php echo $player['birth_certificate'];?></td>
			<td><?php echo $player['address_verify'];?></td>
			<td><?php echo $player['tryout'];?></td>
			<td><?php echo $player['tryout_number'];?></td>
			<td><?php echo $player['allstar_tryout'];?></td>
			<td><?php echo $player['allstar_tryout_number'];?></td>
			<td><?php echo $player['hat_pick'];?></td>
			<td><?php echo $player['picked'];?></td>
			<td><?php echo $player['note'];?></td>
			<td><?php echo $player['created'];?></td>
			<td><?php echo $player['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'players', 'action' => 'view', $player['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'players', 'action' => 'edit', $player['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'players', 'action' => 'delete', $player['id']), null, __('Are you sure you want to delete # %s?', $player['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Player'), array('controller' => 'players', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
