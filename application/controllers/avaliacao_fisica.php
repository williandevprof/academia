<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Avaliacao_fisica extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Avaliacao_fisica_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('avaliacao/avaliacao_fisica');
	}

	// salva a avaliação física no banco de dados
	public function salvarAvaliacao_post()
	{
		$postdata         = file_get_contents("php://input");
		$avaliacao_fisica = json_decode($postdata);


		$idaluno   = $avaliacao_fisica->idaluno;
		$avaliacao = $avaliacao_fisica->avaliacao;

		$mensagem = 0;

		
		if ($avaliacao->data_avaliacao == "")
		{
			$mensagem = "O campo data da avaliacao nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}else if ($avaliacao->peso == "")
		{
			$mensagem = "O campo peso nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}if ($avaliacao->altura == "")
		{
			$mensagem = "O campo altura nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}if ($avaliacao->imc == "")
		{
			$mensagem = "O campo imc nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}if ($avaliacao->percentual_gordura == "")
		{
			$mensagem = "O campo percentual de gordura nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}if ($avaliacao->massa_magra == "")
		{
			$mensagem = "O campo massa magra nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}if ($avaliacao->massa_gorda == "")
		{
			$mensagem = "O campo massa gorda nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		$data_avaliacao  = implode("-",array_reverse(explode("/",$avaliacao->data_avaliacao)));

		$today = date("Y-m-d");  

		$data = array(
			'idaluno'             => $idaluno,
			'data_avaliacao'      => $data_avaliacao,	
			'peso'                => $avaliacao->peso,
			'altura'              => $avaliacao->altura,
			'triceps'             => $avaliacao->triceps,
			'subescapular'        => $avaliacao->subescapular,
			'supralliaca'         => $avaliacao->supralliaca,
			'abdomen'             => $avaliacao->abdomen,
			'braco_esquerdo'      => $avaliacao->braco_esquerdo,
			'braco_direito'	      => $avaliacao->braco_direito,
			'antibraco_esquerdo'  => $avaliacao->antibraco_esquerdo,
			'antibraco_direito'	  => $avaliacao->antibraco_direito,
			'quadril'	  		  => $avaliacao->quadril,
			'cintura'	  		  => $avaliacao->cintura,
			'pescoco'	  		  => $avaliacao->pescoco,
			'coxa_esquerda'	      => $avaliacao->coxa_esquerda,
			'coxa_direita'	      => $avaliacao->coxa_direita,
			'perna_esquerda'	  => $avaliacao->perna_esquerda,
			'perna_direita'	      => $avaliacao->perna_direita,
			'radio'	  			  => $avaliacao->radio,
			'femur'	  	  	      => $avaliacao->femur,
			'imc'	  			  => $avaliacao->imc,
			'percentual_gordura'  => $avaliacao->percentual_gordura,
			'massa_magra'	  	  => $avaliacao->massa_magra,
			'massa_gorda'	  	  => $avaliacao->massa_gorda,
			'idcadastrador'       => $_SESSION["iduser"],
			'dataCadastro'        => $today	    
 		);

		
		// veririfica se tem id para alterar ou cadastrar
		if ($avaliacao->idavaliacao_fisica)
		{
			$this->Avaliacao_fisica_mod->updateAvaliacao($avaliacao->idavaliacao_fisica, $data);

			print(json_encode($mensagem));
		}
		else
		{
			
			$this->Avaliacao_fisica_mod->salvarAvaliacao($data);
			print(json_encode($mensagem));
		}
	}


	public function listaAvaliacao_post()
	{
		$postdata = file_get_contents("php://input");
		$aluno    = json_decode($postdata);

		$idaluno   = $aluno->idaluno;

		$avaliacoes = $this->Avaliacao_fisica_mod->listaAvaliacao($idaluno);

		foreach ($avaliacoes as $key => $value) 
		{
			$avaliacoes[$key]->data_avaliacao = implode("/",array_reverse(explode("-",$value->data_avaliacao)));
		}
		
		print(json_encode($avaliacoes));

	}	

	public function pesquisarAvaliacao_post()
	{
		$postdata  = file_get_contents("php://input");
		$objAvaliacao = json_decode($postdata);

		$avaliacao = new stdClass();
		
		// metodo para converter a data do formato brasileiro para o do mysql
		$avaliacao->data_avaliacao1  = implode("-",array_reverse(explode("/",$objAvaliacao->avaliacao->data_avaliacao1)));

		$avaliacao->data_avaliacao2  = implode("-",array_reverse(explode("/",$objAvaliacao->avaliacao->data_avaliacao2)));

		$idaluno = $objAvaliacao->aluno->idaluno;

		$avaliacoes = $this->Avaliacao_fisica_mod->pesquisarAvaliacao($avaliacao, $idaluno);

		foreach ($avaliacoes as $key => $value) 
		{
			$avaliacoes[$key]->data_avaliacao = implode("/",array_reverse(explode("-",$value->data_avaliacao)));
		}
		
		print(json_encode($avaliacoes));

	}	
		
}	
