<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Treino extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Treino_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('treino/treino');
	}

	

	public function listarCiclo_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$ciclo = $this->Treino_mod->getCiclo($request->idciclo);
			
		$this->response($ciclo);
	}

	// metodo que seleciona os treinos para listar quando clica na grid de ciclos 
	public function listaTreino_post()
	{
		$postdata = file_get_contents("php://input");
		$idciclo  = json_decode($postdata);

		$treinos = $this->Treino_mod->listaTreino($idciclo);
			
		$this->response($treinos);
	}

	
	// lista os ciclos
	public function listaCiclos_get()
	{
		$ciclos = $this->Treino_mod->getCiclos();
			
		$this->response($ciclos);
	}

	// lista os exercicios adicionados no treino selecionado
	public function listaExerciciosTreino_post()
	{
		$postdata     = file_get_contents("php://input");
		$cicloTreino  = json_decode($postdata);

		$exercicioTreino = $this->Treino_mod->listaExerciciosTreino($cicloTreino);
			
		$this->response($exercicioTreino);
	}

	// lista os exercicios combinados
	public function listaExerciciosCombinados_post()
	{
		$postdata     = file_get_contents("php://input");
		$cicloTreino  = json_decode($postdata);

		$exercicioTreinoCombinado = $this->Treino_mod->listaExerciciosCombinados($cicloTreino);
			
		$this->response($exercicioTreinoCombinado);
	}

	
		
	// salva o ciclo de treino e o treino no banco
	public function salvarCicloTreino_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

	
		if ($request->ciclo == "")
		{
			$mensagem = "O campo ciclo nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}
		else if($request->nivel == "")
		{
			$mensagem = "O campo nivel nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}else if($request->modeloCiclo == "")
		{
			$mensagem = "O campo modelo de ciclo nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		$today = date("Y-m-d");
			    
		$data = array(
			'idciclo'         => $request->idciclo,
			'ciclo'			  => $request->ciclo,	
			'nivel'           => $request->nivel,
			'genero'          => $request->genero,
			'metaPrincipal'   => $request->metaPrincipal,
			'modeloCiclo'     => $request->modeloCiclo,
			'idcadastrador'   => $_SESSION["iduser"],
			'dataCadastro'    => $today
 		);
	

		// veririfica se tem id para alterar ou cadastrar
		if ($request->idciclo)
		{
			$this->Treino_mod->updateCiclo($request->idciclo, $data);
			// encerro a execução pois os treinos não devem ser alterados apenas o ciclo
			die();
		}
		else
		{
			$idciclo = $this->Treino_mod->addCiclo($data);
			
		}

		
		// verifica o modelo de ciclo de treino para inserir nas tabelas
		// de treino e ciclo_treino
		if (($request->modeloCiclo == "AB") ||
			($request->modeloCiclo == "ABC") ||
			($request->modeloCiclo == "ABCD") ||
			($request->modeloCiclo == "ABCDE"))
		{

			$data = array(
				'treino'  => "A"
			);

			$idtreino = $this->Treino_mod->addTreino($data);

			$data = array(
				'ciclo_idciclo'   => $idciclo,
				'treino_idtreino' => $idtreino	
	 		);

	 		$idciclo_treino = $this->Treino_mod->addCiclo_treino($data);

			$data = array(
				'treino'  => "B"
			);
	 		
			$idtreino = $this->Treino_mod->addTreino($data);

			$data = array(
				'ciclo_idciclo'   => $idciclo,
				'treino_idtreino' => $idtreino	
	 		);

	 		$idciclo_treino = $this->Treino_mod->addCiclo_treino($data);

		}
		
		if (($request->modeloCiclo == "ABC")||
			($request->modeloCiclo == "ABCD") ||
			($request->modeloCiclo == "ABCDE"))
		{

			
	 		$data = array(
				'treino'  => "C"
			);
	 		
			$idtreino = $this->Treino_mod->addTreino($data);

			$data = array(
				'ciclo_idciclo'   => $idciclo,
				'treino_idtreino' => $idtreino	
	 		);

	 		$idciclo_treino = $this->Treino_mod->addCiclo_treino($data);

		}

		if (($request->modeloCiclo == "ABCD")||
			($request->modeloCiclo == "ABCDE"))
		{

			$data = array(
				'treino'  => "D"
			);
	 		
			$idtreino = $this->Treino_mod->addTreino($data);

			$data = array(
				'ciclo_idciclo'   => $idciclo,
				'treino_idtreino' => $idtreino	
	 		);

	 		$idciclo_treino = $this->Treino_mod->addCiclo_treino($data);

		}

		if ($request->modeloCiclo == "ABCDE")
		{

	 		$data = array(
				'treino'  => "E"
			);
	 		
			$idtreino = $this->Treino_mod->addTreino($data);

			$data = array(
				'ciclo_idciclo'   => $idciclo,
				'treino_idtreino' => $idtreino	
	 		);

	 		$idciclo_treino = $this->Treino_mod->addCiclo_treino($data);

		}
	}

	
	// adiciona os exercicios na grid do treino selecionado
	public function addExercicioTreino_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$today = date("Y-m-d");
		
		$data = array(
			'exercicio_idexercicio'  => $request->idexercicio,
			'treino_idtreino'	     => $request->idTreino,
			'idcadastrador'          => $_SESSION["iduser"],
			'dataCadastro'           => $today
 		);

		
		// adiciona na tabela que faz a ligação do treino com o exercicio
		$this->Treino_mod->addExercicioTreino($data);
	}


	public function salvarTreinoCombinado_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		// monta o array para adicionar o exercicio clicado na tabela de exercicio
		$data = array(
			'idexercicio_treino' => $request->idexercicio_treino,
			'idexercicio'	     => $request->idexercicio
 		);
		
		// adiciona na tabela exercicio_combinado
		$this->Treino_mod->addExercicioCombinado($data);

	}


	public function getCicloEditar_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$res = $this->Treino_mod->getCicloEditar($request);
			
		$this->response($res);

	}	

	public function getExercicioEditar_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$res = $this->Exercicio_mod->getExercicioEditar($request);
			
		$this->response($res);

	}	

	public function getTreinoEditar_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$res = $this->Treino_mod->getTreinoEditar($request);
			
		$this->response($res);

	}	
	
	// pesquisa o exercicio quando clica no botão buscar e filtra a grid de exercicios
	public function pesquisarExercicio_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$exercicio->idexercicio        = $request->buscarExercicio->idexercicio;
		$exercicio->idregiaoTrabalhada = $request->buscarExercicioRegiao->idregiaoTrabalhada;
		
		$res = $this->Exercicio_mod->pesquisarExercicio($exercicio);
			
		$this->response($res); 
		
	}

	// pesquisa o ciclo de treino quando clica no botão buscar e filtra a grid de ciclos
	public function pesquisarCiclo_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$ciclo = $request->ciclo;
		
		$res = $this->Treino_mod->pesquisarCiclo($ciclo);
			
		$this->response($res); 
		
	}

	
	// faz o auto compleete do buscar ciclo de treino
	public function autoCiclo_post()
	{
		$postdata      = file_get_contents("php://input");
		$buscarCiclo   = json_decode($postdata);
				
		$res = $this->Treino_mod->autoCiclo($buscarCiclo);

		print(json_encode($res));
	}

	// metodo para excluir o exercicio do treino
	public function exluirExercicioTreino_post()
	{
		$postdata = file_get_contents("php://input");
		$idexercicio_treino  = json_decode($postdata);

		$this->Treino_mod->exluirExercicioTreino($idexercicio_treino);
	}
	
}	