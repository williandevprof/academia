<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Minhas_avaliacoes extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Minhas_avaliacoes_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('avaliacao/minhas_avaliacoes');
	}

	public function getAvaliacoes_get()
	{
		$avaliacoes = $this->Minhas_avaliacoes_mod->getAvaliacoes($_SESSION["iduser"]);

		foreach ($avaliacoes as $key => $value) 
		{
			$avaliacoes[$key]->data_avaliacao = implode("/",array_reverse(explode("-",$value->data_avaliacao)));
		}
			
		$this->response($avaliacoes);
	}

	public function pesquisarAvaliacao_post()
	{
		$postdata  = file_get_contents("php://input");
		$avaliacao = json_decode($postdata);

				
		// metodo para converter a data do formato brasileiro para o do mysql
		$avaliacao->data_avaliacao1  = implode("-",array_reverse(explode("/",$avaliacao->data_avaliacao1)));

		$avaliacao->data_avaliacao2  = implode("-",array_reverse(explode("/",$avaliacao->data_avaliacao2)));

		
		$avaliacoes = $this->Minhas_avaliacoes_mod->pesquisarAvaliacao($avaliacao, $_SESSION["iduser"]);

		foreach ($avaliacoes as $key => $value) 
		{
			$avaliacoes[$key]->data_avaliacao = implode("/",array_reverse(explode("-",$value->data_avaliacao)));
		}
		
		print(json_encode($avaliacoes));

	}	
}	