<?php 
	// gera o par q em pdf 

	define('FPDF_FONTPATH', 'font/'); 
	require('fpdf/fpdf.php');  
	
	$pdf = new FPDF('P', 'cm', 'A4'); 
	$pdf->Open(); 
	$pdf->AddPage(); 

	$pdf->SetFont('Arial', '', 12);


	foreach ($texto as $texto)
	{

		$pdf->SetFont('Arial', 'U', 14);

		$pdf->Cell(18,1, $texto->titulo, 0,1,'C');

		$pdf->SetFont('Arial', '', 12);
		
		// primeiro parametro largura, segundo espaçamento entre as linhas
		$pdf->MultiCell(20, 0.5, $texto->textoParq, 0, 'J', 0);

		$pdf->Cell(18,1, '', 0,1,'L'); 		

		$pdf->Cell(18,1, 'Sim   Não', 0,1,'L'); 
		
		foreach ($perguntas as  $perguntas) 
		{
			
			if ($perguntas->resposta == 1) 
			{
				$pdf->Cell(18,1, '( X )   (   ) '.$perguntas->pergunta,0,1,'L');
			}
			else
			{
				$pdf->Cell(18,1, '(   )   ( X ) '.$perguntas->pergunta,0,1,'L');
			}
		}
	}	

	$pdf->Cell(18,1, '', 0,1,'L'); 

	$pdf->Cell(18,1, 'Nome:____________________________ Assinatura:_______________ Data:__ /__ / ____', 0,1,'L');

	ob_start (); 
	$pdf->Output();