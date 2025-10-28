<?php
defined('BASEPATH') OR exit('No direct script access allowed');

session_start();

class Parq_pdf extends CI_Controller{

	public function index()
	{
		$this->load->model('Parq_mod');

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$idpessoa = $request->idpessoa;

		$_SESSION['parq']['texto'] = $this->Parq_mod->montarParq();

		$_SESSION['parq']['perguntas'] = $this->Parq_mod->perguntas($idpessoa);
		
	}

	public function imprimirParq()
	{
		$this->load->view('pessoa/parq_pdf', $_SESSION['parq']);
	}
	
}



