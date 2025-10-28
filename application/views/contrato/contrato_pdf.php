<?php 
	// gera o contrato em pdf 

	define('FPDF_FONTPATH', 'font/'); 
	require('fpdf/fpdf.php');  
	
	$pdf = new FPDF('P', 'cm', 'A4'); 
	$pdf->Open(); 
	$pdf->AddPage(); 

	$pdf->SetFont('Arial', '', 12);

	foreach ($contrato as $contrato)
	{

		$pdf->SetFont('Arial', 'U', 14);

		$pdf->Cell(18,1, 'Contratação de Plano '.$contrato->nome, 0,1,'C');

		$pdf->Cell(18,1, '', 0,1,'C');

		$pdf->SetFont('Arial', '', 12);

		$pdf->MultiCell(20, 0.5, $contrato->texto, 0, 'J', 0);
	}	

	ob_start (); 
	$pdf->Output();	