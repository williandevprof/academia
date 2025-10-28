<?php 
	// gera a avaliação física em pdf 

	define('FPDF_FONTPATH', 'font/'); 
	require('fpdf/fpdf.php');  
	
	$pdf = new FPDF('P', 'cm', 'A4'); 
	$pdf->Open(); 
	$pdf->AddPage(); 

	$pdf->SetFont('Arial', '', 12);


	foreach ($avaliacao as $avaliacao)
	{

		$pdf->SetFont('Arial', '', 14);

		// metodos para pegar a idade do aluno
		$date = new DateTime($avaliacao->dataNascimento);
 		$now = new DateTime();
 		$interval = $now->diff($date);

 		
		$avaliacao->data_avaliacao = implode("/",array_reverse(explode("-",$avaliacao->data_avaliacao)));
		 

		$pdf->Cell(18,1, 'Nome: '.$avaliacao->nome.'               Idade: '.$interval->y, 0,1,'L');

		$pdf->Cell(18,1, 'Data da Avaliação: '.$avaliacao->data_avaliacao, 0,1,'L');

		$pdf->Cell(18,1, '', 0,1,'L');$pdf->Cell(18,1, '', 0,1,'L');

		$pdf->SetFont('Arial', 'B', 16);

		$pdf->Cell(18,1, 'Dados da Avaliação Física', 0,1,'C');

		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell(9,1, 'Peso(Kg)',   1,0,'L'); 
		$pdf->Cell(9,1, 'Altura(m)',  1,1,'L');
		
		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell(9,1, $avaliacao->peso,   1,0,'L'); 
		$pdf->Cell(9,1, $avaliacao->altura, 1,1,'L');

		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell(5,1, 'IMC',                   1,0,'L');
		$pdf->Cell(5,1, 'Percentual de Gordura', 1,0,'L');
		$pdf->Cell(4,1, 'Massa Magra(Kg)',       1,0,'L');
		$pdf->Cell(4,1, 'Massa Gorda(Kg)',       1,1,'L');
		
		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell(5,1, $avaliacao->imc,                1,0,'L');
		$pdf->Cell(5,1, $avaliacao->percentual_gordura, 1,0,'L');
		$pdf->Cell(4,1, $avaliacao->massa_magra,        1,0,'L');
		$pdf->Cell(4,1, $avaliacao->massa_gorda,        1,1,'L');

		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell(5,1, 'Triceps',      1,0,'L');
		$pdf->Cell(5,1, 'Subescapular', 1,0,'L');
		$pdf->Cell(4,1, 'Supralliaca',  1,0,'L');
		$pdf->Cell(4,1, 'Abdomen',      1,1,'L');

		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell(5,1, $avaliacao->triceps,      1,0,'L');
		$pdf->Cell(5,1, $avaliacao->subescapular, 1,0,'L');
		$pdf->Cell(4,1, $avaliacao->supralliaca,  1,0,'L');
		$pdf->Cell(4,1, $avaliacao->abdomen,      1,1,'L');

		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell(5,1, 'Braço Direito',     1,0,'L');
		$pdf->Cell(5,1, 'Braço Esquerdo',    1,0,'L');
		$pdf->Cell(4,1, 'Ant Braço Direito', 1,0,'L');
		$pdf->Cell(4,1, 'Ant Braço Esquerdo',1,1,'L');

		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell(5,1, $avaliacao->braco_direito,      1,0,'L');
		$pdf->Cell(5,1, $avaliacao->braco_esquerdo,     1,0,'L');
		$pdf->Cell(4,1, $avaliacao->antibraco_direito,  1,0,'L');
		$pdf->Cell(4,1, $avaliacao->antibraco_esquerdo, 1,1,'L');

		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell(5,1, 'Coxa Direita',  1,0,'L');
		$pdf->Cell(5,1, 'Coxa Esquerda', 1,0,'L');
		$pdf->Cell(4,1, 'Perna Direita', 1,0,'L');
		$pdf->Cell(4,1, 'Perna Esquerda',1,1,'L');

		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell(5,1, $avaliacao->coxa_direita,   1,0,'L');
		$pdf->Cell(5,1, $avaliacao->coxa_esquerda,  1,0,'L');
		$pdf->Cell(4,1, $avaliacao->perna_direita,  1,0,'L');
		$pdf->Cell(4,1, $avaliacao->perna_esquerda, 1,1,'L');

		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell(4,1, 'Quadril', 1,0,'L');
		$pdf->Cell(4,1, 'Cintura', 1,0,'L');
		$pdf->Cell(4,1, 'Pescoço', 1,0,'L');
		$pdf->Cell(3,1, 'Radio',   1,0,'L');
		$pdf->Cell(3,1, 'Femur',   1,1,'L');

		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell(4,1, $avaliacao->quadril, 1,0,'L');
		$pdf->Cell(4,1, $avaliacao->cintura, 1,0,'L');
		$pdf->Cell(4,1, $avaliacao->pescoco, 1,0,'L');
		$pdf->Cell(3,1, $avaliacao->radio,   1,0,'L');
		$pdf->Cell(3,1, $avaliacao->femur,   1,1,'L');
		
	}	

	$pdf->Cell(18,1, '', 0,1,'L'); 

	
	ob_start (); 
	$pdf->Output();