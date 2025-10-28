<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Exercicio extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Exercicio_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('exercicio/exercicio');
	}

	public function listaExercicios_get()
	{
		$exercicios = $this->Exercicio_mod->getExercicios();
			
		$this->response($exercicios);
	}

	public function addExercicio_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);
		
		$exercicio = $request->exercicio;

		if ($exercicio == "")
		{
			$mensagem = "O Campo exercicio nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		// verifica se está cadastrando ou alterando para pegar certo o valor, se é alteração é um objeto comum, se for cadastro é um objeto dentro do outro
		if ($request->idexercicio)
		{
			$tipoExercicio = $request->tipoExercicio;
		}
		else
		{
			$tipoExercicio = $request->tipoExercicio->tipoExercicio;
		}	
		
		$res = $this->Exercicio_mod->verificaTipoExercicio($tipoExercicio);
	
		if (!$res)
		{
			$mensagem = "Tipo de exercicio nao cadastrado no sistema";
			print(json_encode($mensagem));
			die();
		}
			
		if ($request->idexercicio)
		{
			$regiao = $tipoExercicio = $request->regiaoTrabalhada;
		}
		else
		{
			$regiao = $request->regiaoTrabalhada->regiaoTrabalhada;
		}		

		$res = $this->Exercicio_mod->verificaRegiaoTrabalhada($regiao);
		
		if (!$res)
		{
			$mensagem = "Regiao trabalhada nao cadastrada no sistema";
			print(json_encode($mensagem));
			die();
		}	
		
		if ($request->idexercicio)
		{
			$aparelho = $request->aparelho;	
		}
		else
		{
			$aparelho = $request->aparelho->aparelho;	
		}	

		$res = $this->Exercicio_mod->verificaAparelho($aparelho);
		
		if (!$res)
		{
			$mensagem = "Aparelho nao cadastrado no sistema";
			print(json_encode($mensagem));
			die();
		}

			
	    $today = date("Y-m-d");
	    
		// veririfica se tem id para alterar ou cadastrar
		if ($request->idexercicio)
		{

			$data = array(
				'idexercicio'		 => $request->idexercicio,
				'idtipoExercicio'    => $request->idtipoExercicio,
				'idregiaoTrabalhada' => $request->idregiaoTrabalhada,
				'idaparelho'         => $request->idaparelho,
				'exercicio'          => $request->exercicio,
				'idcadastrador'      => $_SESSION["iduser"],
				'dataCadastro'       => $today
			);
			
			$this->Exercicio_mod->updateExercicio($request->idexercicio, $data);
			
		}
		else
		{
			$data = array(
				'idexercicio'		 => $request->idexercicio,
				'idtipoExercicio'    => $request->tipoExercicio->idtipoExercicio,
				'idregiaoTrabalhada' => $request->regiaoTrabalhada->idregiaoTrabalhada,
				'idaparelho'         => $request->aparelho->idaparelho,
				'exercicio'          => $request->exercicio,
				'idcadastrador' => $_SESSION["iduser"],
				'dataCadastro'  => $today
			);

			$this->Exercicio_mod->addExercicio($data);
						
		}
	}

	public function getExercicioEditar_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$res = $this->Exercicio_mod->getExercicioEditar($request);
			
		$this->response($res);

	}	

	public function pesquisarExercicio_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$exercicio->idexercicio        = $request->buscarExercicio->idexercicio;
		$exercicio->idregiaoTrabalhada = $request->buscarExercicioRegiao->idregiaoTrabalhada;
		
		$res = $this->Exercicio_mod->pesquisarExercicio($exercicio);
			
		$this->response($res); 
		
	}

	public function autoExercicio_post()
	{
			
		$postdata      = file_get_contents("php://input");
		$request       = json_decode($postdata);
		
		$buscarExercicio  = $request->buscarExercicio;
		$res = $this->Exercicio_mod->autoExercicio($buscarExercicio);

		print(json_encode($res));
	}	

	public function autoExercicioRegiao_post()
	{
			
		$postdata      = file_get_contents("php://input");
		$request       = json_decode($postdata);
		
		$buscarExercicioRegiao  = $request->buscarExercicioRegiao;
		$res = $this->Exercicio_mod->autoExercicioRegiao($buscarExercicioRegiao);

		print(json_encode($res));
	}	


	

}	