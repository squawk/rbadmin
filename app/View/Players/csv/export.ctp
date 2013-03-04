Name,Birth Date,Age,Adress,City,Zip,Division,Team,Jersey Name,Pant Size,Shirt Size
<?php
if (isset($players))
{
   foreach ($players as $p)
   {
      echo sprintf('"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"' . "\n",
         $p['Player']['name'],
         $p['Player']['dob'],
         $p['Player']['age'],
         $p['Player']['address'],
         $p['Player']['city'],
         $p['Player']['zip'],
         empty($p['League']['name']) ? 'NOT ASSIGNED' : $p['League']['name'],
         empty($p['Team']['name']) ? 'NOT ASSIGNED' : $p['Team']['name'],
         $p['Player']['jersey_name'],
         in_array($p['Player']['league_id'], array(1,2,3,4,5,6)) ? $p['Player']['pant_size'] : '',
         $p['Player']['shirt_size'] == 'N' ? '' : $p['Player']['shirt_size']
         );
   }
}
