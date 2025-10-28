<?php
defined('BASEPATH') OR exit('No direct script access allowed');

session_start();

class Avaliacao_fisica_pdf extends CI_Controller{

	public function index()
	{
		$this->load->model('Avaliacao_fisica_mod');
		
		$postdata   = file_get_contents("php://input");
		$avaliacao  = json_decode($postdata);

		
		$_SESSION['avaliacoes']['avaliacao'] = $this->Avaliacao_fisica_mod->detalharAvaliacao($avaliacao);
				
	}

	public function imprimirAvaliacao()
	{
		$this->load->view('avaliacao/avaliacao_fisica_pdf', $_SESSION['avaliacoes']);
	}
	
}



