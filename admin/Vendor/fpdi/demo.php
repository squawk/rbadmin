<?php
error_reporting (E_ALL);

define('FPDF_FONTPATH','../fpdf/font/');
require('fpdi.php');

$pdf= new fpdi();
$pdf->SetFont('Times', '', 14);
$pdf->SetTextColor(255,0,0);

$level = 'ic';
$level = 'mop';
$level = 'mobfg';

$pagecount = $pdf->setSourceFile("Core.$level.pdf");

$pdf->addPage();
$pdf->useTemplate($pdf->ImportPage(10));
/*

// Candidate
$pdf->SetXY(44, 86);
$pdf->Write(5, 'Brad Van Skyhawk');

// Interviewer
$pdf->SetXY(134, 86);
$pdf->Write(5, 'Christopher Bjorling');

// Position
$pdf->SetXY(40, 98.3);
$pdf->Write(5, 'President');

// Date
$pdf->SetXY(120, 98.3);
$pdf->Write(5, date('M d, Y'));

$pdf->addPage();
$pdf->useTemplate($pdf->ImportPage(2));

$pdf->addPage();
$pdf->useTemplate($pdf->ImportPage(3));

$pdf->addPage();
$pdf->useTemplate($pdf->ImportPage(13));

$pdf->addPage();
$pdf->useTemplate($pdf->ImportPage(14));

$pdf->addPage();
$pdf->useTemplate($pdf->ImportPage(15));
*/

$comp = strtolower(str_replace(array('-','/',' '), array('','',''), 'DEVELOPS PEOPLE'));

$pdf->Output("C:/web/htdocs/bms_interview/pdf_templates/$comp.$level.en.pdf","F");
$pdf->closeParsers();

echo $level . ':';
echo date('r');

?>