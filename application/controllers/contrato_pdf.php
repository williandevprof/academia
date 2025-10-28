<?php
defined('BASEPATH') OR exit('No direct script access allowed');

session_start();

class Contrato_pdf extends CI_Controller{

	public function index()
	{
		$this->load->model('Contrato_mod');
		
		$postdata  = file_get_contents("php://input");
		$contrato  = json_decode($postdata);

		
		$_SESSION['contratos']['contrato'] = $this->Contrato_mod->getContrato($contrato);
				
	}

	public function imprimirContrato()
	{
		$this->load->view('contrato/contrato_pdf', $_SESSION['contratos']);
	}
	
}