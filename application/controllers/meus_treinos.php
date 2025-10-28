<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Meus_treinos extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('MeusTreino_mod');
        session_start();
        
    }

	public function index_get()
	{

		$this->load->view('aluno/meus_treinos');
	}


	// seleciona os ciclos dos treinos do usuario logado
	public function getCiclosTreinos_get()
	{
		$ciclos = $this->MeusTreino_mod->getCiclosTreinos($_SESSION["iduser"]);

		foreach ($ciclos as $key => $value) 
		{
			$ciclos[$key]->dataInicioTreino = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$ciclos[$key]->dataTerminoTreino = implode("/",array_reverse(explode("-",$value->data_termino)));
		}

		print(json_encode($ciclos));
	}


	// seleciona os exercicios dos treinos do usuario logado e do ciclo selecionado
	public function getExerciciosTreinos_post()
	{
		$postdata    = file_get_contents("php://input");
		$cicloTreino = json_decode($postdata);

		
		$idaluno_ciclo  = $cicloTreino->idaluno_ciclo;
		$idaluno_treino = $cicloTreino->idaluno_treino;

		$exerciciosTreinos = $this->MeusTreino_mod->getExerciciosTreinos($_SESSION["iduser"], $idaluno_ciclo, $idaluno_treino);

		print(json_encode($exerciciosTreinos));
	}

	// seleciona os treinos do usuario logado e do ciclo selecionado
	public function getTreinos_post()
	{
		$postdata       = file_get_contents("php://input");
		$idaluno_ciclo  = json_decode($postdata);

		$treinos = $this->MeusTreino_mod->getTreinos($_SESSION["iduser"], $idaluno_ciclo);

		print(json_encode($treinos));
	}

	// lista todos os exercicios do ciclo e do treino selecionado
	public function listaExerciciosTreinoAluno_post()
	{
		$postdata     = file_get_contents("php://input");
		$cicloTreino  = json_decode($postdata);

		$exercicioTreino = $this->MeusTreino_mod->listaExerciciosTreinoAluno($cicloTreino);
			
		$this->response($exercicioTreino);
	}

	// faz o auto complete do buscar ciclo de treino do aluno
	public function autoMeusCiclos_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$buscar  = $request->buscarMeusCiclos;
						
		// chama o metodo que irá pegar os ciclos do aluno passando o id do aluno logado e a string
		// que o usuário digitou no input		
		$res = $this->MeusTreino_mod->autoMeusCiclos($_SESSION["iduser"], $buscar);

		print(json_encode($res));
	}

	// pesquisa o ciclo de treino quando clica no botão buscar e filtra a grid de ciclos
	public function pesquisarMeusCiclos_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$idaluno_ciclo = $request->buscar->idaluno_ciclo;

		$ciclo->dataInicio  = implode("-",array_reverse(explode("/",$request->dataInicio)));

		$ciclo->dataTermino  = implode("-",array_reverse(explode("/",$request->dataTermino)));
		
		$ciclos = $this->MeusTreino_mod->pesquisarMeusCiclos($_SESSION["iduser"], $idaluno_ciclo, $ciclo);

		foreach ($ciclos as $key => $value) 
		{
			$ciclos[$key]->dataInicioTreino = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$ciclos[$key]->dataTerminoTreino = implode("/",array_reverse(explode("-",$value->data_termino)));
		}
			
		$this->response($ciclos); 
		
	}

}	