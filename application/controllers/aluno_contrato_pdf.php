<?php
defined('BASEPATH') OR exit('No direct script access allowed');

session_start();

class Aluno_contrato_pdf extends CI_Controller{

	public function index()
	{
		$this->load->model('Contrato_mod');
		
		$postdata      = file_get_contents("php://input");
		$contratoAluno = json_decode($postdata);

		
		$_SESSION['contratosAluno']['contratoAluno'] = $this->Contrato_mod->listaContratosAluno($contratoAluno);
				
	}

	public function imprimirContrato()
	{
		$this->load->view('pessoa/aluno_contrato_pdf', $_SESSION['contratosAluno']);
	}
	
}