<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Login extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Login_mod');
        
    }

	public function index_get()
	{
		$this->load->view('login');
	}

	
	public function logar_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		// recupera os usuários do banco
		$users = $this->Login_mod->getUsers();

		$lastKey = end(array_keys($users));

		$verificaLogin = 0;

		for ($i=0; $i <= $lastKey; $i++) 
		{ 
			if (($request->usuario == $users[$i]->usuario)
				&& ($request->senha == $users[$i]->senha))
			{
				session_start();
				// guarda na sessão o id do usuário logado
				$_SESSION["iduser"] = $users[$i]->idusuario;

				$verificaLogin = 1;
				break;
			}
		}
		
		print($verificaLogin);
	}	
}	