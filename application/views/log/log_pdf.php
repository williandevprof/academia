<?php 
	// gera o par q em pdf 

	define('FPDF_FONTPATH', 'font/'); 
	require('fpdf/fpdf.php');  
	
	$pdf = new FPDF('P', 'cm', 'A4'); 
	$pdf->Open(); 
	$pdf->AddPage(); 

	$pdf->SetFont('Arial', '', 12);

	$pdf->SetFont('Arial', 'U', 14);

	$pdf->Cell(18,1, "Alterações no Sistema", 0,1,'C');
	
	$i = 1;

	foreach ($log as $log)
	{
		$pdf->SetFont('Arial', '', 12);

		$log->data = implode("/",array_reverse(explode("-",$log->data)));
		
		$pdf->Cell(18,0.5, $i." - O usuário ".$log->nome." no horário ".$log->hora." do dia ".$log->data, 0,1,'L');	

		$pdf->MultiCell(20, 0.5, $log->descricao, 0, 'J', 0);
		
		$pdf->Cell(18,0.5, " ", 0,1, 'L');
				
		$i++;	
	}	

	$pdf->Cell(18,1, '', 0,1,'L'); 

	
	ob_start (); 
	$pdf->Output();