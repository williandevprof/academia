<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Valores_planos extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Valores_planos_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('contrato/valores_planos');
	}

	public function listarValores_plano_get()
	{
		$valores_plano = $this->Valores_planos_mod->listarValores_plano();

		print(json_encode($valores_plano));
	}

	public function salvarValor_plano_post()
	{
		$postdata    = file_get_contents("php://input");
		$valor_plano = json_decode($postdata);

		$today = date("Y-m-d");

		$data = array(
			'idmodalidade' => $valor_plano->modalidade,
			'idprazoPlano' => $valor_plano->prazoPlano,
			'idtipoPlano'  => $valor_plano->tipoPlano,
			'valor'        => $valor_plano->valor,
			'idcadastrador'=> $_SESSION["iduser"],
			'dataCadastro' => $today
		);

		if ($valor_plano->idvalores_plano)
		{
			// update	
		}
		else
		{
			
			$this->Valores_planos_mod->salvarValor_plano($data);
			
		}	
		
	}
}	