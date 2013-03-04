<?php
//Configure::write('debug', 0);
if (isset($players[0]['League']['name']))
{
   global $leagueName;
   $leagueName = $players[0]['League']['name'];
   $this->pageTitle = $leagueName . 'AcceleratedTryoutList.pdf';
}
else
{
   $this->pageTitle = 'AcceleratedTryoutList.pdf';
}

// Use to pass to functions
$GLOBALS['pdfObj'] = $this->Pdf->pdf;
$pdf = $this->Pdf->pdf;

$pdf->SetHeader('myHeader');
$pdf->SetFooter('myFooter');

$pdf->SetFillColor('white');
$pdf->AddPage('L');

$tryoutNumber = 1;
foreach ($players as $p)
{
   $line = '';
   $line[] = $tryoutNumber++;
   $line[] = strtoupper($p['Player']['last_name']) . "\n" . ucwords(strtolower($p['Player']['first_name'])) . "\n" . '(' . $p['Team']['name'] . ')';
   $line[] = $p['Player']['age'] . "\n" . $p['Player']['dob'];
   $line[] = str_replace("\r", "\n", $p['Player']['phone']);
   $line[] = '';
   $line[] = '';
   $line[] = '';
   $line[] = '';
   $line[] = '';
   $line[] = '';
   $line[] = '';
   $line[] = '';

   $pdf->Row($line);
}

// Add about 20 empty
for ($i = 0; $i < 20; $i++)
{
   $line = array_fill(0, 12, " \n ");
   $line[0] = $tryoutNumber++;
   $pdf->Row($line);
}

echo $this->Pdf->pdf->Output();

function myHeader()
{
   $pdf = $GLOBALS['pdfObj'];
   $pdf->SetFillColor('white');
   $pdf->SetFont('Arial', 'B', 12);
   $pdf->Write(5, $GLOBALS['leagueName'] . ' Accelerated Tryout List');
   $pdf->Ln($pdf->FontSize * 1.5);

   $pdf->SetFont('Arial', '', 9);
   $pdf->SetWidths(array(8, 35, 25, 25, 10, 17, 17, 17, 17, 17, 17, 55));
   $aligns = array_fill(0, 11, 'C');
   $pdf->SetAligns($aligns);
   $pdf->Row(array('#', 'Name', 'Age/DOB', 'Phone', 'Pos', 'Agility', 'Infield', 'Outfield', 'Throwing', 'Batting', 'Running', 'Comments'));
   $aligns[1] = 'L';
   $aligns[7] = 'L';
   $pdf->SetAligns($aligns);
}

function myFooter()
{
   $pdf = $GLOBALS['pdfObj'];
   $pdf->SetY(-15);
   $pdf->SetFont('Arial','I',8);
   $pdf->Cell(0,10,'Page '.$pdf->PageNo(),0,0,'C');
}
?>
