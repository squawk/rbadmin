<?php 
//Configure::write('debug', 0);

$teamColors = array(
"A's" => '#003831',
'Angels' => '#ba0021',
'Astros' => '#95322C',
'Blue Jays' => '#003399',
'Cardinals' => '#C41E3A',
'Cubs' => '#0e3386',
'Diamondbacks' => '#a71930',
'D-Backs' => '#a71930',
'Dodgers' => '#083c68',
'Indians' => '#023465',
'Giants' => '#000000',
'Mariners' => '#0C2C56',
'Marlins' => '#249EA3',
'Mets' => '#F47937',
'Orioles' => '#df4601',
'Phillies' => '#E81828',
'Pirates' => '#746022',
'Red Sox' => '#0d2b56',
'Reds' => '#900003',
'Rockies' => '#333366',
'Royals' => '#000572',
'Tigers' => '#000000',
'Twins' => '#072764',
'White Sox' => '#000000',
'Yankees' => '#1C2841',
);

// Use to pass to functions
$GLOBALS['pdfObj'] = $this->Pdf->pdf;

// Document name
$league = $league['League']['name'];
$this->pageTitle = $league . 'Roster.pdf';

// Get team names
$teams = array_keys($players);

foreach ($teams as $team)
{
   // Skip unassigned players
   if (empty($team))
   {
      continue;
   }

   $this->Pdf->pdf->AddPage('L');

   $this->Pdf->pdf->SetFont('Arial', 'BI', 20);
   $this->Pdf->pdf->Cell(0, 10, ' RIVERTON BASEBALL ' . date('Y'), 0, 1, 'L');
   $this->Pdf->pdf->Ln(7);

   // TODO: Set team color
   $this->Pdf->pdf->SetFillColor('purple');
   $this->Pdf->pdf->SetTextColor('white');
   if (isset($teamColors[$team]))
   {
      $this->Pdf->pdf->SetTextColor('white');
      $this->Pdf->pdf->SetFillColor($teamColors[$team]);
   }

   $this->Pdf->pdf->SetFont('Arial', 'B', 16);
   $this->Pdf->pdf->Cell(0, 10, ' ' . $team . ' Roster - ' . $league, 0, 1, 'L', 1);
   $this->Pdf->pdf->Ln(12);

   $this->Pdf->pdf->SetTextColor('black');

   // TODO: Coach Information
   $this->Pdf->pdf->SetFont('', 'B', 14);
   $this->Pdf->pdf->Write(5, 'Head Coach: ');
   $this->Pdf->pdf->SetFont('', '');
   /*
   $this->Pdf->pdf->Write(5, '-'. "\n");
   $this->Pdf->pdf->SetFont('', 'B');
   $this->Pdf->pdf->Write(5, 'Phone Number: ');
   $this->Pdf->pdf->SetFont('', '');
   $this->Pdf->pdf->Write(5, '-' . "-\n");
   $this->Pdf->pdf->SetFont('', 'B');
   $this->Pdf->pdf->Write(5, 'Email: ');
   $this->Pdf->pdf->SetFont('', '');
   */
   $this->Pdf->pdf->Write(5, '-' . "\n\n");

   // Player information
   $this->Pdf->pdf->SetFillColor('linen');
   $this->Pdf->pdf->SetFont('Arial', '', 11);
   $this->Pdf->pdf->SetWidths(array(8, 35, 10, 16, 40, 30, 43, 24, 24, 24, 10));
   $aligns = array_fill(0, 10, 'C');
   $this->Pdf->pdf->SetAligns($aligns);
   $this->Pdf->pdf->Row(array('#', 'Player Name', 'Age', "Birth\nDate", 'Address', 'Parents', 'Email Address', 'Day Phone', 'Evening Phone', 'Cell Phone', 'Help'));

   $this->Pdf->pdf->SetFillColor('white');
   $this->Pdf->pdf->SetFont('Arial', '', 9);
   $aligns[1] = 'L';
   $aligns[3] = 'L';
   $aligns[4] = 'L';
   $aligns[5] = 'L';
   $this->Pdf->pdf->SetAligns($aligns);

   $i = 0;
   foreach ($players[$team] as $p)
   {
      $line = '';
      $line[] = $i++ + 1;
      if (!empty($p['Player']['last_name']))
      {
         $line[] = strtoupper($p['Player']['last_name']) . ', '  . $p['Player']['first_name'];
      }
      else
      {
         $line[] = '';
      }
      $line[] = $p['Player']['age'];
      $line[] = date('m/d/y', strtotime($p['Player']['birthdate']));
      $line[] = $p['Player']['address'];
      $line[] = $p['Player']['moms_name'] . (($p['Player']['moms_name'] and $p['Player']['dads_name']) ? ' / ' : '') . $p['Player']['dads_name'];
      $line[] = $p['Player']['email'];
      $line[] = str_replace('/', "\n", $p['Player']['day_phone']);
      $line[] = str_replace('/', "\n", $p['Player']['evening_phone']);
      $line[] = str_replace('/', "\n", $p['Player']['cell_phone']);

      // Helper information
      $volunteer = '';
      if ($p['Player']['assistant_coach'])
      {
         $volunteer[] = 'A';
      }
      if ($p['Player']['team_mom'])
      {
         $volunteer[] = 'M';
      }
      if ($p['Player']['score_keeping'])
      {
         $volunteer[] = 'K';
      }
      if ($p['Player']['snack_bar'])
      {
         $volunteer[] = 'S';
      }
      $line[] = @implode(', ', $volunteer);
      $this->Pdf->pdf->Row($line);
   }

   $this->Pdf->pdf->SetFont('', 'B');
   $this->Pdf->pdf->Write(5, "\nHelper Key\n");
   $this->Pdf->pdf->SetFont('','');
   $this->Pdf->pdf->Write(4, "A - Willing to be Assistant Coach, ");
   $this->Pdf->pdf->Write(4, "M - Willing to be Team Mom, ");
   $this->Pdf->pdf->Write(4, "K - Willing to Keep Score, ");
   $this->Pdf->pdf->Write(4, "S - Willing to help in the Snack Shack ");
}

echo $this->Pdf->pdf->Output();
