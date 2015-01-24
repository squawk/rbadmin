<?php
   echo $this->Html->css('jquery.tooltip.css');
   echo $this->Html->script('jquery.tooltip.pack.js');
?>
<div class="games index">

<script type="text/javascript">
jQuery(function($) {
	$('#calendar a').tooltip({showURL:false});
});
</script>
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
//		3 => '/games/request/march',
	   4 => '/games/request/april',
	   5 => '/games/request/may',
	   6 => '/games/request/june'
	   );
?>

<?php echo $this->Form->create('Game', array('url' => $url[$month])); ?>


<h3><?php echo date('F Y', mktime(0, 0, 0, $month, 1, $currentYear)) ?></h3>

<div class="pagination">
   <ul>
      <?php foreach (array_keys($url) as $key): ?>
         <?php $month_name = date('F', mktime(0, 0, 0, $key, 1, 2013)) ?>
         <?php if ($month == $key): ?>
            <li class="active"><span><?php echo $month_name ?></span></li>
         <?php else: ?>
            <li><?php echo $this->Html->link($month_name, array('controller' => 'games', 'action' => 'request', strtolower($month_name))) ?></li>
         <?php endif; ?>
      <?php endforeach; ?>
   </ul>
</div>

   <p>Click on the days and times that you are available to work. You have until
   Friday of each week to make your requests for the next weeks schedule, then click
   the <strong>Submit Requests</strong> button. If you do not click the <strong>Submit Requests</strong>
   you requests will not be saved.</p>
   <p>&nbsp;</p>

   <table id="calendar" class="table table-condensed table->bordered">
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
   <button type="submit" class="btn btn-primary"><i class="icon-thumbs-up icon-white"></i> Submit Requests</button>
   </form>
</div>
