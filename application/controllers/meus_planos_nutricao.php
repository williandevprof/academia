<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Meus_planos_nutricao extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Meus_planos_nutricao_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('nutricao/meus_planos_nutricao');
	}

	public function getPlanos_nutricao_get()
	{
		$planos_nutricao = $this->Meus_planos_nutricao_mod->getPlanos_nutricao($_SESSION["iduser"]);

		foreach ($planos_nutricao as $key => $value) 
		{
			$planos_nutricao[$key]->data_inicio = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$planos_nutricao[$key]->data_termino = implode("/",array_reverse(explode("-",$value->data_termino)));
		}
			
		$this->response($planos_nutricao);
	}

	// pesquisa planos de nutrição de acordo com o que usuário digitar
	public function pesquisarNutricao_post()
	{
		$postdata    =  file_get_contents("php://input");
		$objNutricao = json_decode($postdata);

		$nutricao = new stdClass();

		// metodo para converter a data do formato brasileiro para o do mysql
		$nutricao->data_inicio  = implode("-",array_reverse(explode("/",$objNutricao->data_inicio)));

		$nutricao->data_termino  = implode("-",array_reverse(explode("/",$objNutricao->data_termino)));

				
		$planos_nutricao =  $this->Meus_planos_nutricao_mod->pesquisarNutricao($nutricao, $_SESSION["iduser"]);

		foreach ($planos_nutricao as $key => $value) 
		{
			$planos_nutricao[$key]->data_inicio = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$planos_nutricao[$key]->data_termino = implode("/",array_reverse(explode("-",$value->data_termino)));
		}

		print(json_encode($planos_nutricao));
	}
}	