<div class="teams view">
<h2><?php  __('Team');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Team Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['team_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('League'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($team['League']['name'], array('controller' => 'leagues', 'action' => 'view', $team['League']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Coach'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['coach']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Coach Phone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['coach_phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Assistant Coach'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['assistant_coach']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Assistant Coach 2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['assistant_coach_2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Wins'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['wins']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Loses'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['loses']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ties'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['ties']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tiebreaker'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['tiebreaker']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Overall Wins'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['overall_wins']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Overall Loses'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['overall_loses']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Overall Ties'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['overall_ties']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cook Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['cook_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cook Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['cook_time']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cook Date2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['cook_date2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cook Time2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['cook_time2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Picture Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['picture_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Team', true), array('action' => 'edit', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Team', true), array('action' => 'delete', $team['Team']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues', true), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League', true), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Players', true), array('controller' => 'players', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Player', true), array('controller' => 'players', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Players');?></h3>
	<?php if (!empty($team['Player'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Team Id'); ?></th>
		<th><?php __('First Name'); ?></th>
		<th><?php __('Last Name'); ?></th>
		<th><?php __('Birthdate'); ?></th>
		<th><?php __('Address'); ?></th>
		<th><?php __('City'); ?></th>
		<th><?php __('Zip'); ?></th>
		<th><?php __('Day Phone'); ?></th>
		<th><?php __('Evening Phone'); ?></th>
		<th><?php __('Cell Phone'); ?></th>
		<th><?php __('Moms Name'); ?></th>
		<th><?php __('Dads Name'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('School Boundary'); ?></th>
		<th><?php __('Jersey Name'); ?></th>
		<th><?php __('Shirt Size'); ?></th>
		<th><?php __('Pant Size'); ?></th>
		<th><?php __('Invalid Email'); ?></th>
		<th><?php __('Invalid Domain'); ?></th>
		<th><?php __('Optout Email'); ?></th>
		<th><?php __('League Id'); ?></th>
		<th><?php __('Last Team'); ?></th>
		<th><?php __('Assistant Coach'); ?></th>
		<th><?php __('Snack Bar'); ?></th>
		<th><?php __('Team Mom'); ?></th>
		<th><?php __('Umpire'); ?></th>
		<th><?php __('Score Keeping'); ?></th>
		<th><?php __('Birth Certificate'); ?></th>
		<th><?php __('Address Verify'); ?></th>
		<th><?php __('Tryout'); ?></th>
		<th><?php __('Tryout Number'); ?></th>
		<th><?php __('Allstar Tryout'); ?></th>
		<th><?php __('Allstar Tryout Number'); ?></th>
		<th><?php __('Hat Pick'); ?></th>
		<th><?php __('Picked'); ?></th>
		<th><?php __('Note'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($team['Player'] as $player):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $player['id'];?></td>
			<td><?php echo $player['team_id'];?></td>
			<td><?php echo $player['first_name'];?></td>
			<td><?php echo $player['last_name'];?></td>
			<td><?php echo $player['birthdate'];?></td>
			<td><?php echo $player['address'];?></td>
			<td><?php echo $player['city'];?></td>
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
			<td><?php echo $player['last_team'];?></td>
			<td><?php echo $player['assistant_coach'];?></td>
			<td><?php echo $player['snack_bar'];?></td>
			<td><?php echo $player['team_mom'];?></td>
			<td><?php echo $player['umpire'];?></td>
			<td><?php echo $player['score_keeping'];?></td>
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
				<?php echo $this->Html->link(__('View', true), array('controller' => 'players', 'action' => 'view', $player['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'players', 'action' => 'edit', $player['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'players', 'action' => 'delete', $player['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $player['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Player', true), array('controller' => 'players', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
