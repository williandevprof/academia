<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Tipo_exercicio extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Tipo_Exercicio_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('exercicio/tipo_exercicio');
	}

	public function listaTipo_exercicios_get()
	{
		$tiposExercicios = $this->Tipo_Exercicio_mod->getTiposExercicios();
			
		$this->response($tiposExercicios);
	}

	public function addTipo_exercicio_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);
	    
	    $today = date("Y-m-d");

		$data = array(
			'tipoExercicio' => $request->tipoExercicio,
			'idcadastrador' => $_SESSION["iduser"],
			'dataCadastro'  => $today
		);


		if ($request->tipoExercicio == "")
		{
			$mensagem = "O campo tipo de exercicio e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}
			
		// veririfica se tem id para alterar ou cadastrar
		if ($request->idtipoExercicio)
		{
			$this->Tipo_Exercicio_mod->updateTipoExercicio($request->idtipoExercicio, $data);
		}
		else
		{
			$idTipoExercicio = $this->Tipo_Exercicio_mod->addTipoExercicio($data);
		}
	}

	public function getTipoEditar_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$tipoExercicio = $this->Tipo_Exercicio_mod->getAparelhoEditar($request);
			
		$this->response($tipoExercicio);

	}	

	public function pesquisarTipoExercicio_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$tipoExercicio->idtipoExercicio  = $request->buscarTipoExercicio->idtipoExercicio;
		
		$res = $this->Tipo_Exercicio_mod->pesquisarTipoExercicio($tipoExercicio);
			
		$this->response($res); 
		
	}

	public function autoTipo_post()
	{
			
		$postdata      = file_get_contents("php://input");
		$request       = json_decode($postdata);
		
		$buscarTipoExercicio  = $request->buscarTipoExercicio;
		$res = $this->Tipo_Exercicio_mod->autoTipo($buscarTipoExercicio);

		print(json_encode($res));
	}	
}	