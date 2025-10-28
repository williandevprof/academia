<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Aparelho extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Aparelho_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('exercicio/aparelho');
	}

	public function listaAparelhos_get()
	{
		$aparelhos = $this->Aparelho_mod->getAparelhos();
			
		$this->response($aparelhos);
	}

	public function addAparelho_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$today = date("Y-m-d");
	    
		$data = array(
			'aparelho'      => $request->aparelho,
			'numero'        => $request->numero,
			'idcadastrador' => $_SESSION["iduser"],
			'dataCadastro'  => $today
		);

		if ($request->aparelho == "")
		{
			$mensagem = "O campo aparelho e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		if ($request->numero == "")
		{
			$mensagem = "O campo numero e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}	
			
		// veririfica se tem id para alterar ou cadastrar
		if ($request->idaparelho)
		{
			$this->Aparelho_mod->updateAparelho($request->idaparelho, $data);
		}
		else
		{
			$idAparelho = $this->Aparelho_mod->addAparelho($data);
		}
	}

	public function getAparelhoEditar_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$aparelho = $this->Aparelho_mod->getAparelhoEditar($request);
			
		$this->response($aparelho);

	}	

	public function pesquisarAparelho_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$aparelho->idaparelho = $request->buscarAparelho->idaparelho;
		$aparelho->numero = $request->buscarAparelhoNumero;
		
		$res = $this->Aparelho_mod->pesquisarAparelho($aparelho);
			
		$this->response($res); 
		
	}

	public function autoAparelho_post()
	{
			
		$postdata      = file_get_contents("php://input");
		$request       = json_decode($postdata);
		
		$buscarAparelho  = $request->buscarAparelho;
		$res = $this->Aparelho_mod->autoAparelho($buscarAparelho);

		print(json_encode($res));
	}	
}	