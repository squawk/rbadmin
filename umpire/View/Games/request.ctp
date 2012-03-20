<?php
   echo $this->Html->css('jquery.tooltip.css');

   echo $this->Html->script('jquery.bgiframe.pack.js');
   echo $this->Html->script('jquery.dimension.pack.js');
   echo $this->Html->script('jquery.tooltip.pack.js');
?>
<div class="games index">

<script type="text/javascript">
jQuery(function($) {
	$('#calendar a').tooltip({showURL:false});
});
</script>
<style>
#calendar td {
   border:1px solid #ddd;
}
tr.calendar-header td {
   background-color: #660099;
	color: #ffffff;
	text-align: center;
}
td.today {
   background-color: #ffc !important;
   font-size: 0.9em;
}
td.noday {
   background-color: #aaa !important;
}
tr.calendar-days td.normal {
   width: 140px;
   height: 100px;
   background-color: #fff;
   font-size: 0.9em;
}
tr.calendar-days td.sunday {
   width: 80px;
   height: 100px;
   background-color: #fff;
   font-size: 0.9em;
}
div.calendar-number {
   font-size: 1em;
   font-weight: bold;
   float: right;
   padding: 0.2em 0.5em;
   border: 1px solid #000;
   margin-top: -5px;
   margin-right: -5px;
   background-color: #eee;
}
#month-name {
   font-size: 2em;
   font-weight: bold;
   text-align: center;
   width: inherit;
   padding-bottom: 10px;
}
</style>
<?php
	$currentMonth = date('n');
	$currentYear = date('Y');
	$today = date('j');
	$week = 0;

	// Build an array of calendar days
	for ($day = 1; $day <= 31; $day++)
	{
		// Don't continue if past end of month 
	  if (checkdate($month, $day, $year) == false)
	  {
	    break;
	  }
	
		// Place the date in the week and day array
	  $dayNum = date('w', mktime(0, 0, 0, $month, $day, $year));
	  if ($dayNum == 0 and $day > 1)
	  {
	     $week++;
	  }
	  $days[$week][$dayNum] = $day;
	}
	
	// build the url
	$url = array(
		3 => '/games/request/march',
	   4 => '/games/request/april',
	   5 => '/games/request/may',
	   6 => '/games/request/june'
	   );
?>

<?php echo $this->Form->create('Game', array('url' => $url[$month])); ?>
<fieldset>

<?php if ($month == 3): ?>
	<legend>March Requests</legend>
   <?php echo $this->Html->link('April >', '/games/request/april') ?>
<?php elseif ($month == 4): ?>
   <legend>April Requests</legend>
   <?php echo $this->Html->link('< March', '/games/request/march') ?>
   <?php echo $this->Html->link('May >', '/games/request/may') ?>
<?php elseif ($month == 5): ?>            
   <legend>May Requests</legend>
   <?php echo $this->Html->link('< April', '/games/request/april') ?>
   <?php echo $this->Html->link('June >', '/games/request/june') ?>
<?php elseif ($month == 6): ?>            
   <legend>June Requests</legend>
   <?php echo $this->Html->link('< May', '/games/request/may') ?>
<?php endif; ?>

   <p>&nbsp;</p>
   <p>Click on the days and times that you are available to work. You have until 
   Friday of each week to make your requests for the next weeks schedule, then click 
   the <strong>Submit Requests</strong> button. If you do not click the <strong>Submit Requests</strong> 
   you requests will not be saved.</p>
   <p>&nbsp;</p>

   <table id="calendar" cellspacing="1" cellpadding="2" bgcolor="#000" style="font-family: verdana; font-size: 8pt; color: rgb(0, 0, 102);">
      <tbody>
         <tr align="center" class="calendar-header">
            <td>Sunday</td>
            <td>Monday</td>
            <td>Tuesday</td>
            <td>Wednesday</td>
            <td>Thursday</td>
            <td>Friday</td>
            <td>Saturday</td>
         </tr>

<?php for ($w = 0; $w <= $week; $w++): ?>
   <tr valign="top" class="calendar-days">
   <?php for ($d = 0; $d < 7; $d++): ?>
      <?php if (isset($days[$w][$d])): ?>
      <?php 
         $now = $days[$w][$d];

         $times = '';
         if (isset($games[$now]))
         {
            foreach ($games[$now] as $game)
            {
               $key = str_replace(array(':', ' '), array('x', ''), $month . '_' . $now . '_'  . $year . '-' . $game);
               $times .= $this->Form->input($key, array('type' => 'checkbox', 'label' => $game));
            }
         }
      ?>

         <?php if ($today == $now and $month == $currentMonth and $year == $currentYear): ?>
            <td class="today">
         <?php elseif ($d == 0): ?>
            <td class="sunday">
         <?php else: ?>
            <td class="normal">
         <?php endif; ?>

         <div class="calendar-number"><?php echo $now ?></div><?php echo $times ?></td>
      <?php else: ?>
         <td class="noday">&nbsp;</td>
      <?php endif; ?>
   <?php endfor; ?>
   </tr>
<?php endfor; ?>

      </tbody>
   </table>
   </fieldset>
   <?php echo $this->Form->end('Submit Requests'); ?>
</div>