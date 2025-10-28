<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Header extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        //$this->load->model('MeusTreino_mod');
        //session_start();
        
    }

	public function index_get()
	{

		//$this->load->view('aluno/meus_treinos');
	}


	// destroi a sessão
	public function sair_get()
	{
		session_destroy();
	}
}		