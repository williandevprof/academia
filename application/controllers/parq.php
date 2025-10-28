<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Parq extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Parq_mod');
    }

	public function index_get()
	{
		$this->load->view('pessoa/parq');
	}

	public function getParq_get()
	{
		$parq = $this->Parq_mod->montarParq();

		$this->response($parq);
	}

	public function addPergunta_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$perguntas = $request->perguntas;

		$parq = $request->parq;
		
				
		if ($parq->idparq) 
	    {
	    	// array para a tabela parq	
	    	$data = array(
				'titulo'    => "PAR Q E VOCÊ",
				'textoParq' => $parq->textoParq
			);
	    	
			// altera a tabela parq que contém o texto
			$this->Parq_mod->updateTextoParq($data);

	    }	
			

		// pega as chaves e depois a ultima posição do array
		$keys = array_keys($perguntas);
		$last_key = end($keys);
		
		// faz o laço para inserir todas as perguntas
		for ($i=0; $i <= $last_key; $i++) 
		{
			
			// array para a tabela perguntas_parq
			$data = array(
				'idparq'    => 1,
				'pergunta'  => $perguntas[$i]->pergunta
			);

			if ($perguntas[$i]->idperguntaParq) 
			{
				$idPergunta = $this->Parq_mod->updatePergunta($perguntas[$i]->idperguntaParq, $data);

			}		
			else
			{
				$idPergunta = $this->Parq_mod->addPergunta($data);
			}
		}
	}	

	public function excluirPergunta_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$idPergunta = $this->Parq_mod->deletePergunta($request);

		$this->response($request);
	}	
}	
