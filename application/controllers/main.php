<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Main extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Main_mod');
        session_start();
        
    }

	public function index_get()
	{
		$this->load->view('main');
	}

	// metodo que pega os dados do usuário logado
	public function getUsuario_get()
	{
		$usuario = $this->Main_mod->getUsuario($_SESSION["iduser"]);
			
		$this->response($usuario);
	}

	// metodo que irá verificar se tem aluno com ciclo de treino
    // com data expirando hoje
	public function getAlunosCiclos_get()
	{
		$dataAtual = date("Y-m-d");		

		$CicloTreinoDataExpirada = $this->Main_mod->getAlunosCiclos($dataAtual);

		print(json_encode($CicloTreinoDataExpirada));
	}
}