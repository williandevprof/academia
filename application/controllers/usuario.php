<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Usuario extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Usuario_mod');
        session_start();
        
    }

	public function index_get()
	{
		$this->load->view('usuario/usuario');
	}

	// metodo que pega os alunos para listar
	public function getUsuarios_get()
	{
		$usuarios = $this->Usuario_mod->getUsuarios();

		$this->response($usuarios);
	}

	// metodo que seleciona as permissões no banco de dados
	public function getPermissoes_post()
	{
		$postdata  = file_get_contents("php://input");
		$idusuario = json_decode($postdata);

		$permissoes = $this->Usuario_mod->getPermissoes($idusuario);

		$this->response($permissoes);
	}

	
	// autocomplete do campo de busca de permissoes
	public function autoPermissao_post()
	{
		$postdata      = file_get_contents("php://input");
		$request       = json_decode($postdata);
		
		$permissao   = $request->permissao;

		$permissoes = $this->Usuario_mod->autoPermissao($permissao);

		print(json_encode($permissoes));
	}

	public function pesquisarPermissao_post()
	{
		$postdata      = file_get_contents("php://input");
		$request       = json_decode($postdata);
		
		$idpermissao   = $request->permissao->idpermissao;

		$permissao = $this->Usuario_mod->pesquisarPermissao($idpermissao);

		print(json_encode($permissao));
	}


	// metodo que cadastra ou altera as permissões do usuário
	public function cadastrar_alterar_permissao_post()
	{
		$postdata      = file_get_contents("php://input");
		$permissaoObj  = json_decode($postdata);

		$idpermissao = (int)$permissaoObj->idpermissao;
		$idusuario   = (int)$permissaoObj->idusuario; 
		$nome        = $permissaoObj->nome; 



		// irá verificar se já existe alguma permissão do usuário cadastrado no sistema, se não existir nenhuma ele deverá cadastrar todas as permissões mesmo que false, para não dar problemas de listar apenas uma permissão ou nem todas as permissões no caso do usuário não clicar em todas na primeira vez que dar alguma permissão a usuário novo
		$verificaUsuarioPermissaoExiste  = $this->Usuario_mod->verificaUsuarioPermissaoExiste($idusuario);


		// verifica se não existe nenhuma permissão do usuário na tabela usuario_permissao, caso não exista inseri tudo falso
		if ($verificaUsuarioPermissaoExiste == false)
		{

			// metodo para pegar a quantidade de linhas que tem na tabela permissão
			$linhas = $this->Usuario_mod->getLinhasPermissao();

			for ($i=1; $i <= $linhas; $i++)
			{ 
				$data = array(
					'idusuario'   => $idusuario,
					'idpermissao' => $i,
					'visualizar'  => 0,
					'cadastrar'   => 0,
					'alterar'     => 0,
					'excluir'     => 0

				);

				// insere as permissões falsas 
				$this->Usuario_mod->insertPermissõesUsuario($data);
			}
			
		}


		// pega o indice do objeto para poder fazer a comparação
		$indice = key($permissaoObj->nome);
		

		// verifica qual tipo de permissão estão inserindo ou alterando entre visualizar, cadastrar, alterar e excluir
		if ($indice == "visualizar")
		{
			
			// verifica se alteraram para verdadeiro ou falso
			if ($nome->visualizar == true)
			{
				$data = array(
					'idusuario'   => $idusuario,
					'idpermissao' => $idpermissao,
					'visualizar'  => 1

				);
			}
			else if ($nome->visualizar == false)
			{
				$data = array(
					'idusuario'   => $idusuario,
					'idpermissao' => $idpermissao,
					'visualizar'  => 0

				);
			}
						
		}
		else if ($indice == "cadastrar")
		{
			
			// verifica se alteraram para verdadeiro ou falso
			if ($nome->cadastrar == true)
			{
				$data = array(
					'idusuario'   => $idusuario,
					'idpermissao' => $idpermissao,
					'cadastrar'   => 1

				);
			}
			else if ($nome->cadastrar == false)
			{
				$data = array(
					'idusuario'   => $idusuario,
					'idpermissao' => $idpermissao,
					'cadastrar'   => 0

				);
			}
						
		}
		else if ($indice == "alterar")
		{
			
			// verifica se alteraram para verdadeiro ou falso
			if ($nome->alterar == true)
			{
				$data = array(
					'idusuario'   => $idusuario,
					'idpermissao' => $idpermissao,
					'alterar'     => 1

				);
			}
			else if ($nome->alterar == false)
			{
				$data = array(
					'idusuario'   => $idusuario,
					'idpermissao' => $idpermissao,
					'alterar'     => 0

				);
			}

		}
		else if ($indice == "excluir")
		{
			
			// verifica se alteraram para verdadeiro ou falso
			if ($nome->excluir == true)
			{
				$data = array(
					'idusuario'   => $idusuario,
					'idpermissao' => $idpermissao,
					'excluir'     => 1

				);
			}
			else if ($nome->excluir == false)
			{
				$data = array(
					'idusuario'   => $idusuario,
					'idpermissao' => $idpermissao,
					'excluir'     => 0

				);
			}
						
		}
		
		// altera a permissão já existente no banco de dados de acordo com o click do usuário nos check box
		$this->Usuario_mod->updatePermissao($idusuario, $idpermissao, $data);
			
	}
	
}	