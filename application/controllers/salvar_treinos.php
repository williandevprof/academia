<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Salvar_treinos extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Salvar_Treinos_mod');
        session_start();
        
    }

	public function index_get()
	{
		$this->load->view('aluno/salvar_treinos');
	}

	// seleciona o ciclo de treino ativo para o aluno poder salvar
	// o treino que irá realizar
	public function getCicloAtivo_get()
	{
		$ciclo = $this->Salvar_Treinos_mod->getCicloAtivo($_SESSION["iduser"]);

		foreach ($ciclo as $key => $value) 
		{
			$ciclo[$key]->dataInicioTreino = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$ciclo[$key]->dataTerminoTreino = implode("/",array_reverse(explode("-",$value->data_termino)));
		}


		$this->response($ciclo);
	}

	public function getTreinoAtivo_get()
	{
		$treinos = $this->Salvar_Treinos_mod->getTreinoAtivo($_SESSION["iduser"]);

		$this->response($treinos);
	}

	public function getExerciciosTreinoAtivo_post()
	{
		$postdata       = file_get_contents("php://input");
		$idaluno_treino = json_decode($postdata);

		$exerciciosTreinosAtivo = $this->Salvar_Treinos_mod->getExerciciosTreinoAtivo($_SESSION["iduser"], $idaluno_treino);

		$this->response($exerciciosTreinosAtivo);
	}


	public function selecionarTreino_post()
	{
		$postdata       = file_get_contents("php://input");
		$idaluno_treino = json_decode($postdata);

		$treino = $this->Salvar_Treinos_mod->selecionarTreino($idaluno_treino);

		print(json_encode($treino));
	}

	// salva os treinos realizados pelo aluno
	public function salvarTreinoSelecionado_post()
	{
		$postdata        = file_get_contents("php://input");
		$treinoRealizado = json_decode($postdata);

		$objRetorno = new StdClass;

		
		if ($treinoRealizado->dataRealizacaoTreino == "")
		{
			$objRetorno->mensagem = "O campo data e de preenchimento obrigatorio";
			print(json_encode($objRetorno)); 
	        die();
		}

		$treinoRealizado->dataRealizacaoTreino  = implode("-",array_reverse(explode("/",$treinoRealizado->dataRealizacaoTreino)));

		$data = array(
			'idaluno_treino'  => $treinoRealizado->idaluno_treino,
			'data_treino'     => $treinoRealizado->dataRealizacaoTreino
		);

		$objRetorno->idtreino_realizado = $this->Salvar_Treinos_mod->salvarTreinoSelecionado($data);

		print(json_encode($objRetorno));
	}

	// salva os exercicios realizados pelo aluno
	public function salvarExercicioRealizado_post()
	{
		$postdata           = file_get_contents("php://input");
		$exercicioRealizado = json_decode($postdata);

		
		$data = array(
			'idtreino_realizado'  => $exercicioRealizado->idtreino_realizado,
			'idaluno_exercicio'   => $exercicioRealizado->idaluno_exercicio
			
		);
		
		$this->Salvar_Treinos_mod->salvarExercicioRealizado($data);

	}	
}	