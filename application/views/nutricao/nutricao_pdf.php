<?php 
	// gera a avaliação física em pdf 

	define('FPDF_FONTPATH', 'font/'); 
	require('fpdf/fpdf.php');  
	
	$pdf = new FPDF('P', 'cm', 'A4'); 
	$pdf->Open(); 
	$pdf->AddPage(); 

	$pdf->SetFont('Arial', '', 12);


	foreach ($plano_nutricao as $plano)
	{

		$pdf->SetFont('Arial', '', 14);

		// metodos para pegar a idade do aluno
		$date = new DateTime($plano->dataNascimento);
 		$now = new DateTime();
 		$interval = $now->diff($date);

 		
		$plano->data_inicio = implode("/",array_reverse(explode("-",$plano->data_inicio)));

		$plano->data_termino = implode("/",array_reverse(explode("-",$plano->data_termino)));
		 

		$pdf->Cell(18,1, 'Nome: '.$plano->nome.'               Idade: '.$interval->y, 0,1,'L');

		$pdf->Cell(18,1, 'Data de Inicio: '.$plano->data_inicio.'                  Data de Termino: '.$plano->data_termino, 0,1,'L');

		$pdf->Cell(18,1, '', 0,1,'L');$pdf->Cell(18,1, '', 0,1,'L');

		$pdf->SetFont('Arial', 'U', 14);

		$pdf->Cell(18,1, $plano->plano, 0,1,'C');

		$pdf->Cell(18,1, '', 0,1,'L');

		$pdf->SetFont('Arial', '', 14);

		
		$pdf->Cell(5,1, 'Refeição', 1,0,'L'); 
		$pdf->Cell(3,1, 'Horário',  1,0,'L');
		$pdf->Cell(5,1, 'Alimento', 1,0,'L');
		$pdf->Cell(5,1, 'Med/Qtde', 1,1,'L');

		foreach ($plano_nutricao_dados as $dados)
		{
			
			$pdf->Cell(5,1, $dados->refeicao, 1,0,'L'); 
			$pdf->Cell(3,1, $dados->horario,  1,0,'L');
			$pdf->Cell(5,1, $dados->alimento, 1,0,'L');
			$pdf->Cell(5,1, $dados->medida,   1,1,'L');
								
		}
		
		$pdf->Cell(18,1, '', 0,1,'L');
		
	}	

	$pdf->Cell(18,1, '', 0,1,'L'); 

	
	ob_start (); 
	$pdf->Output();