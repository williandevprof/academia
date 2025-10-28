<?php
defined('BASEPATH') OR exit('No direct script access allowed');

session_start();

class Nutricao_pdf extends CI_Controller{

	public function index()
	{
		$this->load->model("Nutricao_mod");
		 		
		$postdata   = file_get_contents("php://input");
		$plano  = json_decode($postdata);

		
		$_SESSION['planos']['plano_nutricao'] = $this->Nutricao_mod->detalharPlano_Nutricao($plano);

		$_SESSION['planos']['plano_nutricao_dados'] = $this->Nutricao_mod->detalharNutricao_Dados($plano);

	}

	public function imprimirNutricao()
	{
		$this->load->view('nutricao/nutricao_pdf', $_SESSION['planos']);
	}
	
}



