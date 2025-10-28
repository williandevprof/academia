<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Regiao_trabalhada extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Regiao_Trabalhada_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('exercicio/regiao_trabalhada');
	}

	public function listaRegioesTrabalhadas_get()
	{
		$regioesTrabalhadas = $this->Regiao_Trabalhada_mod->getRegioesTrabalhadas();
			
		$this->response($regioesTrabalhadas);
	}

	public function addRegiao_trabalhada_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$today = date("Y-m-d");
	    
		$data = array(
			'regiaoTrabalhada' => $request->regiaoTrabalhada,
			'idcadastrador'    => $_SESSION["iduser"],
			'dataCadastro'     => $today
		);
		
		if ($request->regiaoTrabalhada == "")
		{
			$mensagem = "O campo regiao e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}
			
		// veririfica se tem id para alterar ou cadastrar
		if ($request->idregiaoTrabalhada)
		{
			$this->Regiao_Trabalhada_mod->updateRegiaoTabalhada($request->idregiaoTrabalhada, $data);
		}
		else
		{
			$idRegiaoTrabalhada = $this->Regiao_Trabalhada_mod->addRegiaoTrabalhada($data);
		}
	}

	public function getRegiaoEditar_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$regiaoTrabalhada = $this->Regiao_Trabalhada_mod->getRegiaoEditar($request);
			
		$this->response($regiaoTrabalhada);

	}	

	public function pesquisarRegiaoTrabalhada_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$regiaoTrabalhada->idregiaoTrabalhada  = $request->buscarRegiaoTrabalhada->idregiaoTrabalhada;
		
		$res = $this->Regiao_Trabalhada_mod->pesquisarRegiaoTrabalhada($regiaoTrabalhada);
			
		$this->response($res); 
		
	}

	public function autoRegiao_post()
	{
			
		$postdata      = file_get_contents("php://input");
		$request       = json_decode($postdata);
		
		$buscarRegiaoTrabalhada  = $request->buscarRegiaoTrabalhada;
		$res = $this->Regiao_Trabalhada_mod->autoRegiao($buscarRegiaoTrabalhada);

		print(json_encode($res));
	}	
}	