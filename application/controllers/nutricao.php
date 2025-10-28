<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Nutricao extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model("Nutricao_mod");
        session_start();
    }

	public function index_get()
	{
		$this->load->view('nutricao/nutricao');
	}

	// seleciona as refeições para preencher o campo de refeição do formulario
	public function getRefeicoes_get()
	{
		$refeicoes = $this->Nutricao_mod->getRefeicoes();

		$this->response($refeicoes);
	}

	// adiciona o plano de nutrição, as refeições e os alimentos
	// no banco de dados 
	public function addPlano_nutricao_post()
	{
		$postdata        = file_get_contents("php://input");
		$nutricao_aluno  = json_decode($postdata);

		$idaluno = $nutricao_aluno->idaluno;
		$nutricao = $nutricao_aluno->nutricao;

		$mensagem = 0;

		if ($nutricao->plano == "")
		{
			$mensagem = "O campo plano de nutricao e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		if ($nutricao->refeicao == "")
		{
			$mensagem = "O campo refeicao e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		if ($nutricao->horario == "")
		{
			$mensagem = "O campo horario e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		if ($nutricao->alimento == "")
		{
			$mensagem = "O campo alimento e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		if ($nutricao->medida == "")
		{
			$mensagem = "O campo medida e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		
		// verifica se já existe o plano de nutrição  
		// para não cadastrar de novo e se não estão tentando alterar
		if (($_SESSION["idplano_nutricao"] == null) || ($_SESSION["idplano_nutricao"] == NULL) && ($nutricao->idplano_nutricao == ""))
		{
			$today = date("Y-m-d");

			$data_inicio  = implode("-",array_reverse(explode("/",$nutricao->data_inicio)));

			$data_termino  = implode("-",array_reverse(explode("/",$nutricao->data_termino)));

			
			$data = array(
				'idaluno'       => $idaluno,
				'plano'         => $nutricao->plano,
				'idcadastrador' => $_SESSION["iduser"],
				'dataCadastro'  => $today,
				'data_inicio'   => $data_inicio,
				'data_termino'  => $data_termino,
				'ativo'  		=> 0

			);

			// chama o metodo para adicionar na tabela plano_nutricao
			$_SESSION["idplano_nutricao"] =  $this->Nutricao_mod->addPlano_nutricao($data);
		}
		else
		// se já exitir a sessão ou seja pelo meno um item foi adicionado e idplano_nutricao for diferente de vazio siginifica que estão tentando alterar	
		if (($_SESSION["idplano_nutricao"] != null) || ($_SESSION["idplano_nutricao"] != NULL) && ($nutricao->idplano_nutricao != ""))
		{

			$today = date("Y-m-d");

			$data_inicio  = implode("-",array_reverse(explode("/",$nutricao->data_inicio)));

			$data_termino  = implode("-",array_reverse(explode("/",$nutricao->data_termino)));

			$data = array(
				'idaluno'       => $idaluno,
				'plano'         => $nutricao->plano,
				'idcadastrador' => $_SESSION["iduser"],
				'dataCadastro'  => $today,
				'data_inicio'   => $data_inicio,
				'data_termino'  => $data_termino,
				'ativo'  		=> $nutricao->ativo

			);

			// chama o metodo para alterar a tabela plano_nutricao
			$this->Nutricao_mod->updatePlano_nutricao($data, $nutricao->idplano_nutricao);
		}	


		// vai no banco de dados e busca por plano de nutrição e refeção igual, para depois verificarmos se o horário é o mesmo
		$res =  $this->Nutricao_mod->verificaHorario_refeicao($_SESSION["idplano_nutricao"], $nutricao->refeicao);

		$verificaHorarioRefeicao = true;	

		// entra aqui se houver plano de nutrição e refeição igual
		// as já cadastradas
		if ($res != false)
		{
			// converte para o mesmo tipo de dados time
			$horaBanco = strtotime($res[0]->horario);
			$horaFormulario = strtotime($nutricao->horario);
			
			// verifica se o horario da refeição é diferente 
			// da mesma refeição já cadastrada
			if ($horaBanco != $horaFormulario) 
			{
				$verificaHorarioRefeicao = false;

				$mensagem = "O horario da refeicao desse alimento, deve ser o mesmo do horario da mesma refeicao dos alimentos ja cadastrados";
			}
		}

		// verifica se a refeição passou pela validação de horário
		if ($verificaHorarioRefeicao)
		{
			
			// array da tabela refeicao_plano_nutricao
			$data = array(
				'idplano_nutricao' => $_SESSION["idplano_nutricao"],
				'idrefeicao'       => $nutricao->refeicao,
				'horario'          => $nutricao->horario
			);
			
			if ($nutricao->idrefeicao_plano_nutricao == "")
			{
				// chama o metodo para adicionar na tabela refeicao_plano_nutricao
				$idrefeicao_plano_nutricao =  $this->Nutricao_mod->addRefeicao_plano_nutricao($data);
			}
			else if ($nutricao->idrefeicao_plano_nutricao != "")
			{
				// chama o metodo para alterar a tabela refeicao_plano_nutricao
				$this->Nutricao_mod->updateRefeicao_plano_nutricao($data, $nutricao->idrefeicao_plano_nutricao);
			}
				
			// erro
			if ($nutricao->idrefeicao_plano_nutricao == "")
			{
				// array da tabela alimento
				$data = array(
					'idrefeicao_plano_nutricao' => $idrefeicao_plano_nutricao,
					'alimento'                  => $nutricao->alimento,
					'medida'                    => $nutricao->medida
				);

				// chama o metodo para adicionar na tabela alimento
				$idalimento =  $this->Nutricao_mod->addAlimento($data);
			}
			else if ($nutricao->idrefeicao_plano_nutricao != "")
			{	
			
				// array da tabela alimento
				$data = array(
					'idrefeicao_plano_nutricao' => $nutricao->idrefeicao_plano_nutricao,
					'alimento'                  => $nutricao->alimento,
					'medida'                    => $nutricao->medida
				);

				// chama o metodo para alterar a tabela alimento
				 $this->Nutricao_mod->updateAlimento($data, $nutricao->idrefeicao_plano_nutricao);
			}	

		}
		
		print(json_encode($mensagem));	
		
	}

	// destroi a sessão quando o usuário clica em voltar para a lista de alunos
	public function destroi_sessao_plano_nutricao_get()
	{
		unset($_SESSION["idplano_nutricao"]);
	}

	// atualiza a grid que mostra o plano de nutrição
	public function getPlano_nutricao_post()
	{
		$postdata        = file_get_contents("php://input");
		$nutricao_aluno  = json_decode($postdata);

		$idaluno = $nutricao_aluno->idaluno;
		$nutricao = $nutricao_aluno->nutricao;

		$plano_nutricao =  $this->Nutricao_mod->getPlano_nutricao($idaluno, $_SESSION["idplano_nutricao"]);

		print(json_encode($plano_nutricao));
	}	


	// pesquisa planos de nutrição de acordo com o que usuário digitar
	public function pesquisarNutricao_post()
	{
		$postdata    =  file_get_contents("php://input");
		$objNutricao = json_decode($postdata);

		$nutricao = new stdClass();

		// metodo para converter a data do formato brasileiro para o do mysql
		$nutricao->data_inicio  = implode("-",array_reverse(explode("/",$objNutricao->nutricao->data_inicio)));

		$nutricao->data_termino  = implode("-",array_reverse(explode("/",$objNutricao->nutricao->data_termino)));

		$idaluno = $objNutricao->aluno->idaluno;
		
		$planos_nutricao =  $this->Nutricao_mod->pesquisarNutricao($nutricao, $idaluno);

		foreach ($planos_nutricao as $key => $value) 
		{
			$planos_nutricao[$key]->data_inicio = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$planos_nutricao[$key]->data_termino = implode("/",array_reverse(explode("-",$value->data_termino)));
		}

		print(json_encode($planos_nutricao));
	}
	
	// deleta um alimento da grid, quando o usuário está adicionando
   // um novo plano de nutrição
	public function deleteAlimento_post()
	{
		$postdata = file_get_contents("php://input");
		$plano    = json_decode($postdata);

		$this->Nutricao_mod->deleteAlimento($plano);
		
	}	


	// lista os planos de nutrição do aluno selecionado
	public function getPlanosAluno_post()
	{
		$postdata = file_get_contents("php://input");
		$aluno    = json_decode($postdata);

		$idaluno = $aluno->idaluno;
		

		$planos_nutricao = $this->Nutricao_mod->getPlanosAluno($idaluno);

		foreach ($planos_nutricao as $key => $value) 
		{
			$planos_nutricao[$key]->data_inicio = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$planos_nutricao[$key]->data_termino = implode("/",array_reverse(explode("-",$value->data_termino)));
		}

		print(json_encode($planos_nutricao));
	}	

	
}