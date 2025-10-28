<?php 
	// gera o contrato em pdf 

	define('FPDF_FONTPATH', 'font/'); 
	require('fpdf/fpdf.php');  
	
	$pdf = new FPDF('P', 'cm', 'A4'); 
	$pdf->Open(); 
	$pdf->AddPage(); 

	// seleciona a empresa para montar o contrato
	$conexao = mysqli_connect('127.0.0.1', 'root', '', 'academia');

	$sql = mysqli_query($conexao, "SELECT * FROM empresa");
           
    $empresa = mysqli_fetch_object($sql);

	foreach ($contratoAluno as $contrato)
	{

		$pdf->SetFont('Arial', 'U', 14);

		$pdf->Cell(18,1, 'Contratação de Plano '.$contrato->nome, 0,1,'C');

		
		$pdf->Cell(18,1, '', 0,1,'C');

		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell(18,1, '( CONTRATANTE ) Nome do Cliente: '.$contrato->pessoa, 0,1,'L');

		$dataNascimento = implode("/",array_reverse(explode("-",$contrato->dataNascimento)));

		$pdf->Cell(18,1, 'Data de Nascimento '.$dataNascimento, 0,1,'L');

		$pdf->Cell(18,1, 'Endereço: '.$contrato->rua.'                                                      Número: '.$contrato->numero, 0,1,'L');

		$pdf->Cell(18,1, 'Bairro: '.$contrato->bairro.'                                                                                Cep: '.$contrato->cep, 0,1,'L');

		$pdf->Cell(18,1, 'Cidade: '.$contrato->cidade.'                                                                                    Estado: '.$contrato->estado, 0,1,'L');

		$pdf->Cell(18,1, 'Telefone: '.$contrato->telefone.'                                                                      Email: '.$contrato->email, 0,1,'L');

		$pdf->Cell(18,1, 'Estado Civil: '.$contrato->estadoCivil, 0,1,'L');

		$pdf->Cell(18,1, '', 0,1,'L');

		$pdf->Cell(18,1, '( CONTRATADA ) '.$empresa->empresa, 0,1,'L');

		$pdf->Cell(18,1, 'Com sede em '.$empresa->cidade.',  '.$empresa->estado, 0,1,'L');

		$pdf->Cell(18,1, 'Na Rua '.$empresa->rua.',  n° '.$empresa->numero, 0,1,'L');

		$pdf->Cell(18,1, 'Bairro '.$empresa->bairro.', Cep '.$empresa->cep, 0,1,'L');

		$pdf->Cell(18,1, 'Inscrita no CNPJ sob o n° '.$empresa->cnpj, 0,1,'L');

		$pdf->Cell(18,1, 'e no cadastro estadual sob o n° '.$empresa->inscricao_estadual, 0,1,'L');

		$pdf->Cell(18,1, '', 0,1,'L');

		$pdf->Cell(18,1, 'TIPO DE PLANO: '.$contrato->tipoPlano, 0,1,'L');

		$pdf->Cell(18,1, 'PRAZO DO PLANO: '.$contrato->prazoPlano, 0,1,'L');

		$pdf->Cell(18,1, 'FORMA DE PAGAMENTO: '.$contrato->formaPagamento, 0,1,'L');

		$pdf->Cell(18,1, 'VALOR DAS PARCELAS: '.$contrato->valorParcela. 
			'    NUMERO DE PARCELAS '. $contrato->numeroParcelas. 
			'    VALOR TOTAL '. $contrato->valorTotal, 0,1,'L');

		$pdf->Cell(18,1, '', 0,1,'L');

		$pdf->SetFont('Arial', '', 12);

		$pdf->MultiCell(20, 0.5, $contrato->texto, 0, 'J', 0);

		$pdf->Cell(18,1, '', 0,1,'L');

		$hoje = date('d/m/y');

		$pdf->Cell(18,1, $empresa->cidade.' Data: '.$hoje, 0,1,'L');

		$pdf->Cell(18,1, '', 0,1,'L');

		$pdf->Cell(18,1, 'Nome:______________________________ Assinatura:_________________ ', 0,1,'L');
	}	

	ob_start (); 
	$pdf->Output();	