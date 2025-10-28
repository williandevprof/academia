<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Treinos_realizados extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Treinos_realizados_mod');
        session_start();
        
    }

	public function index_get()
	{
		$this->load->view('aluno/treinos_realizados');
	}

	// seleciona os ciclos e treinos realizados pelo aluno
	public function getTreinosRealizados_get()
	{
		$ciclo = $this->Treinos_realizados_mod->getTreinosRealizados($_SESSION["iduser"]);

		foreach ($ciclo as $key => $value) 
		{
			$ciclo[$key]->dataInicioTreino = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$ciclo[$key]->dataTerminoTreino = implode("/",array_reverse(explode("-",$value->data_termino)));

			$ciclo[$key]->dataTreino = implode("/",array_reverse(explode("-",$value->data_treino)));
		}


		$this->response($ciclo);
	}

	// autocomplete do campo de busca
	public function autoCiclosRealizados_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$buscar  = $request->buscarCicloRealizado;
						
		$res = $this->Treinos_realizados_mod->autoCiclosRealizados($_SESSION["iduser"], $buscar);

		print(json_encode($res));
	}

	// pesquisa os treinos de acordo com os filtros 
	public function pesquisarTreinosRealizados_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$idaluno_ciclo = $request->buscar->idaluno_ciclo;

		$ciclo->dataInicio  = implode("-",array_reverse(explode("/",$request->dataInicio)));

		$ciclo->dataTermino  = implode("-",array_reverse(explode("/",$request->dataTermino)));

		$ciclo->dataTreinoRealizado  = implode("-",array_reverse(explode("/",$request->dataTreinoRealizado)));
		
		$ciclos = $this->Treinos_realizados_mod->pesquisarTreinosRealizados($_SESSION["iduser"], $idaluno_ciclo, $ciclo);

		foreach ($ciclos as $key => $value) 
		{
			$ciclos[$key]->dataInicioTreino = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$ciclos[$key]->dataTerminoTreino = implode("/",array_reverse(explode("-",$value->data_termino)));

			$ciclos[$key]->dataTreino = implode("/",array_reverse(explode("-",$value->data_treino)));
		}
			
		$this->response($ciclos); 
		
	}

	// mostra detalhes do treino e os exercicios do treino realizado
   // quando o usuário clica em cima do treino na grid
	public function mostraTreinoRealizado_post()
	{
		$postdata = file_get_contents("php://input");
		$idtreino_realizado  = json_decode($postdata);

		$treinoSelecionado = $this->Treinos_realizados_mod->mostraTreinoRealizado($idtreino_realizado);

		foreach ($treinoSelecionado as $key => $value) 
		{
			$treinoSelecionado[$key]->dataTreino = implode("/",array_reverse(explode("-",$value->data_treino)));
		}
							
		$this->response($treinoSelecionado); 
	}

	public function getTreinos_post()
	{
		$postdata = file_get_contents("php://input");
		$idtreino_realizado  = json_decode($postdata);

		$treinos = $this->Treinos_realizados_mod->getTreinos($idtreino_realizado);

		print(json_encode($treinos));
	}

	public function getExerciciosTreinos_post()
	{
		$postdata  = file_get_contents("php://input");
		$idtreino_realizado  = json_decode($postdata);

		$exerciciosTreinos = $this->Treinos_realizados_mod->getExerciciosTreinos($idtreino_realizado);

		print(json_encode($exerciciosTreinos));
	}
}	