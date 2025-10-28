<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Aluno extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Aluno_mod');
        session_start();
        
    }

	public function index_get()
	{
		$this->load->view('aluno/aluno');
	}

	// metodo que pega os alunos para listar
	public function getAlunos_get()
	{
		$alunos = $this->Aluno_mod->getAlunos();

		foreach ($alunos as $key => $value) 
		{
			$alunos[$key]->dataNascimentoBrasileiro = implode("/",array_reverse(explode("-",$value->dataNascimento)));
		}
			
		$this->response($alunos);
	}

	// lista todos os exercicios do ciclo e do treino selecionado
	public function listaExerciciosTreinoAluno_post()
	{
		$postdata     = file_get_contents("php://input");
		$cicloTreino  = json_decode($postdata);

		$exercicioTreino = $this->Aluno_mod->listaExerciciosTreinoAluno($cicloTreino);
			
		$this->response($exercicioTreino);
	}


	// mostra o treino detalhado quando o usuário clica na 
    //grid do visualizar ciclos de treinos
	public function listaExerciciosAluno_post()
	{
		$postdata     = file_get_contents("php://input");
		$cicloTreino  = json_decode($postdata);

		$exerciciosTreino = $this->Aluno_mod->listaExerciciosAluno($cicloTreino);
			
		$this->response($exerciciosTreino);
	}

	// altera o status de ativo do ciclo do aluno
	public function mudarCicloAtivo_post()
	{
		$postdata              = file_get_contents("php://input");
		$idaluno_ciclo_idaluno = json_decode($postdata);

		$idaluno_ciclo = $idaluno_ciclo_idaluno->idaluno_ciclo;

		$idaluno = $idaluno_ciclo_idaluno->idaluno;

		$this->Aluno_mod->mudarCicloAtivo($idaluno_ciclo, $idaluno);
	}

	// lista os exercicios combinados do ciclo selecionado
	public function listaExerciciosCombinadosAluno_post()
	{
		$postdata     = file_get_contents("php://input");
		$cicloTreino  = json_decode($postdata);

		$exerciciosTreinoCombinadoAluno = $this->Aluno_mod->listaExerciciosCombinadosAluno($cicloTreino);
			
		$this->response($exerciciosTreinoCombinadoAluno);
	}


	
	// metodo que irá selecionar todos os dados do ciclo de treino
	// e depois adicionar nas tabelas pertinentes ao aluno
	public function addCicloTreinoAluno_post()
	{
		$postdata       = file_get_contents("php://input");
		$idAluno_ciclo  = json_decode($postdata);

		$idAluno = $idAluno_ciclo->idaluno;
		$idCiclo = $idAluno_ciclo->idciclo;

		$mensagem = "";
		
		if ($idAluno_ciclo->cicloTreinoAluno->dataInicio == "")
		{
			$mensagem = "O campo data de inicio e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		if ($idAluno_ciclo->cicloTreinoAluno->dataTermino == "")
		{
			$mensagem = "O campo data de termino e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		$data_inicio  = implode("-",array_reverse(explode("/",$idAluno_ciclo->cicloTreinoAluno->dataInicio)));

		$data_termino  = implode("-",array_reverse(explode("/",$idAluno_ciclo->cicloTreinoAluno->dataTermino)));

		// pega todos os dados do ciclo selecionado com treinos e exercicios
		$cicloTreino = $this->Aluno_mod->getCicloTreino($idCiclo);
		
		$today = date("Y-m-d");

		// monta o array para a tabela aluno_ciclo
		$data = array(
			'idaluno'       => $idAluno,
			'ciclo'         => $cicloTreino[0]->ciclo,
			'nivel'         => $cicloTreino[0]->nivel,
			'genero'        => $cicloTreino[0]->genero,
			'metaPrincipal' => $cicloTreino[0]->metaPrincipal,
			'modeloCiclo'   => $cicloTreino[0]->modeloCiclo,
			'data_inicio'   => $data_inicio,
			'data_termino'  => $data_termino,
			'ativo'			=> 0,
			'idcadastrador' => $_SESSION["iduser"],
			'dataCadastro'  => $today
		);

		// chama o metodo para adicionar na tabela aluno_ciclo
		$idaluno_ciclo = $this->Aluno_mod->addAluno_ciclo($data);

		// variavel que irá controlar para não adicionar treino repetido
		$verificaTreino = "";

		// variável que irá receber a string de exercicios combinados
		$stringExercicioCombinado = "";

		// variavel que irá comparar se o exercicio_idexercicio é igual o $verifica_exercicio_idexercicio para zerar ou concatenar a string  $stringExercicioCombinado e adicionar na tabela aluno_exercicio
		$verifica_exercicio_idexercicio = "";
		
		// pega o indice do ultimo exercicio
		end($cicloTreino);
		$lastKey = key($cicloTreino);
		
		// percore todos os exercicios do ciclo
		foreach ($cicloTreino as $key => $value)
		{
			
			// verifica se a variavel verificaTreino é diferente 
			// do treino que está sendo percorrido
			// para evitar de cadastrar treino repetido
			if ($verificaTreino != $value->treino)
			{
				// monta o array para adicionar na tabela aluno_treino
				$data = array(
					'idaluno_ciclo' => $idaluno_ciclo,
					'treino'        => $value->treino
				);

				// chama o metodo para adicionar na tabela aluno_treino
				$idaluno_treino = $this->Aluno_mod->addAluno_treino($data);
			}
			
			// atribui o treino para a variavel de verificação
			$verificaTreino = $value->treino;

						
			// verifica se o $value->exercicio_idexercicio é igual a $verifica_exercicio_idexercicio. Se for igual ou $verifica_exercicio_idexercicio for vazio e existir exercicio combinado, irá concatena com a string   $stringExercicioCombinado
			if (($verifica_exercicio_idexercicio == $value->exercicio_idexercicio) ||
			   ($verifica_exercicio_idexercicio == "")	&& ($value->idexercicio_combinado))
			{
		
				// pega os nomes dos exercicios combinados desse exercicio
				$exerciciosCombinados = $this->Aluno_mod->getNomeExerciciosCombinados($value->idexercicio_combinado);

				$stringExercicioCombinado .= " + ".$exerciciosCombinados[0]->exercicio;
				
			}
			// verifica se o $value->exercicio_idexercicio é diferente de $verifica_exercicio_idexercicio. Se for será o proximo exercicio
			// logo irá adicionar os dados do ultimo exercicio na tabela aluno_exercicio
			// e zerar a váriavel $stringExercicioCombinado
			else if (($verifica_exercicio_idexercicio != $value->exercicio_idexercicio))
			{
							
				// verifica se tem exercicio combinado para zerar a $stringExercicioCombinado
				// e adicionar o novo exercicio combinado
				if($idexercicio_combinado)
				{
					// verifica se é o ultimo exercicio para pegar o combinado 
					// do exercicio passado para adicionar no penultimo exercicio
					// como é a ultima vez que o laço vai repetir não tem como
					// pegar o combinado depois para adicionar na proxima interação
					// por isso faz o if e pega antes 
					if ($key == $lastKey)
					{
						// pega os nomes dos exercicios combinados desse exercicio
						$exerciciosCombinados = $this->Aluno_mod->getNomeExerciciosCombinados($idexercicio_combinado);

						$stringExercicioCombinado = "";
						$stringExercicioCombinado .= " + ".$exerciciosCombinados[0]->exercicio;

						// monta o array para adicionar na tabela aluno_exercicio pegando
						// os dados do ultimo exercicio
						$data = array(
							'idaluno_treino'   => $idaluno_treino,
							'exercicio'        => $exercicio."".$stringExercicioCombinado,
							'regiaoTrabalhada' => $regiaoTrabalhada,
							'tipoExercicio'    => $tipoExercicio,
							'aparelho'         => $aparelho,
							'serie'            => "",
							'repeticao'        => "",
							'peso'             => "",
							'intervalo'        => ""
						);	
					}
					else
					{
						// monta o array para adicionar na tabela aluno_exercicio pegando
						// os dados do ultimo exercicio
						$data = array(
							'idaluno_treino'   => $idaluno_treino,
							'exercicio'        => $exercicio."".$stringExercicioCombinado,
							'regiaoTrabalhada' => $regiaoTrabalhada,
							'tipoExercicio'    => $tipoExercicio,
							'aparelho'         => $aparelho,
							'serie'            => "",
							'repeticao'        => "",
							'peso'             => "",
							'intervalo'        => ""
						);	
						
						
						// pega os nomes dos exercicios combinados desse exercicio
						$exerciciosCombinados = $this->Aluno_mod->getNomeExerciciosCombinados($value->idexercicio_combinado);

						$stringExercicioCombinado = "";
						$stringExercicioCombinado .= " + ".$exerciciosCombinados[0]->exercicio;
					}	
						
					
				}
				// se não existir exercicio combinado adiciona apenas a variável 
				// $exercicio sem o exercicio combinado
				else 
				{
					// monta o array para adicionar na tabela aluno_exercicio pegando
					// os dados do ultimo exercicio
					$data = array(
						'idaluno_treino'   => $idaluno_treino,
						'exercicio'        => $exercicio,
						'regiaoTrabalhada' => $regiaoTrabalhada,
						'tipoExercicio'    => $tipoExercicio,
						'aparelho'         => $aparelho,
						'serie'            => "",
						'repeticao'        => "",
						'peso'             => "",
						'intervalo'        => ""
					);	
					
				}

				// chama o metodo para adicionar na tabela aluno_exercicio
				$idaluno_exercicio = $this->Aluno_mod->addAluno_exercicio($data);	
			}

			// verifica se o exercicio é o ultimo do array para adicionar na tabela alunos_exercicios com os dados do foreach ou seja o proprio exercicio atual do laço
			if ($key == $lastKey)
			{
				// verifica se o ultimo exercicio é combinado ou não
				if ($value->idexercicio_combinado)
				{
					// pega os nomes dos exercicios combinados desse exercicio
					$exerciciosCombinados = $this->Aluno_mod->getNomeExerciciosCombinadosLast($value->exercicio_idexercicio);

					$stringExercicioCombinado = "";

					// percorre todos os exercicios combinados do ultimo exercicio
					foreach ($exerciciosCombinados as $key => $lastExercicioCombinado) 
					{
						$stringExercicioCombinado .= " + ".$lastExercicioCombinado->exercicio;
					}

									
					
					// monta o array para adicionar na tabela aluno_exercicio
					$data = array(
						'idaluno_treino'   => $idaluno_treino,
						'exercicio'        => $value->exercicio."".$stringExercicioCombinado,
						'regiaoTrabalhada' => $value->regiaoTrabalhada,
						'tipoExercicio'    => $value->tipoExercicio,
						'aparelho'         => $value->aparelho,
						'serie'            => "",
						'repeticao'        => "",
						'peso'             => "",
						'intervalo'        => ""
					);	
				}
				else
				{
					// monta o array para adicionar na tabela aluno_exercicio
					$data = array(
						'idaluno_treino'   => $idaluno_treino,
						'exercicio'        => $value->exercicio,
						'regiaoTrabalhada' => $value->regiaoTrabalhada,
						'tipoExercicio'    => $value->tipoExercicio,
						'aparelho'         => $value->aparelho,
						'serie'            => "",
						'repeticao'        => "",
						'peso'             => "",
						'intervalo'        => ""
					);		
				}	
								
				// chama o metodo para adicionar na tabela aluno_exercicio
				$idaluno_exercicio = $this->Aluno_mod->addAluno_exercicio($data);
			}	
					
									
			// passa o $value->exercicio_idexercicio para a variavel de verificação
			$verifica_exercicio_idexercicio = $value->exercicio_idexercicio;
			
			// passa os dados para outras variaveis para serem utilizadas para adicionar na tabela aluno_exercicio quando o exercicio for o proximo e não for o ultimo do array
			$exercicio        = $value->exercicio;
			$regiaoTrabalhada = $value->regiaoTrabalhada;
			$tipoExercicio    = $value->tipoExercicio;
			$aparelho		  = $value->aparelho;

			$idexercicio_combinado = $value->idexercicio_combinado;
				
		}

	}

	// metodo para salvar um novo ciclo ao aluno
	public function salvarNovoCicloTreinoAluno_post()
	{
		$postdata      = file_get_contents("php://input");
		$idAluno_ciclo = json_decode($postdata);

		$idaluno = $idAluno_ciclo->idaluno;
		$ciclo   = $idAluno_ciclo->ciclo;

		// cria um novo objeto para guardar as mensagens
		// de validações e o retorno do idaluno_ciclo se for cadastrado
		$objNovoCiclo = new stdClass();

			
		if ($ciclo->ciclo == "")
		{
			$objNovoCiclo->mensagem = "O campo ciclo nao pode ser vazio";
			print(json_encode($objNovoCiclo));
			die();
		}
		else if($ciclo->nivel == "")
		{
			$objNovoCiclo->mensagem = "O campo nivel nao pode ser vazio";
			print(json_encode($objNovoCiclo));
			die();
		}else if($ciclo->modeloCiclo == "")
		{
			$objNovoCiclo->mensagem = "O campo modelo de ciclo nao pode ser vazio";
			print(json_encode($objNovoCiclo));
			die();
		}

		if($ciclo->dataInicio == "")
		{
			$objNovoCiclo->mensagem = "O campo data de inicio nao pode ser vazio";
			print(json_encode($objNovoCiclo));
			die();
		}

		if($ciclo->dataTermino == "")
		{
			$objNovoCiclo->mensagem = "O campo data de termino nao pode ser vazio";
			print(json_encode($objNovoCiclo));
			die();
		}

		$data_inicio  = implode("-",array_reverse(explode("/",$ciclo->dataInicio)));

		$data_termino  = implode("-",array_reverse(explode("/",$ciclo->dataTermino)));

		$today = date("Y-m-d");

		$data = array(
			'idaluno'         => $idaluno,
			'ciclo'			  => $ciclo->ciclo,	
			'nivel'           => $ciclo->nivel,
			'genero'          => $ciclo->genero,
			'metaPrincipal'   => $ciclo->metaPrincipal,
			'modeloCiclo'     => $ciclo->modeloCiclo,
			'data_inicio'     => $data_inicio,
			'data_termino'    => $data_termino,
			'ativo'			  => 0,
			'idcadastrador'   => $_SESSION["iduser"],
			'dataCadastro'    => $today	    
 		);

		// veririfica se tem id para alterar ou cadastrar
		if ($request->idciclo)
		{
			$this->Treino_mod->updateCiclo($request->idciclo, $data);
			// encerro a execução pois os treinos não devem ser alterados apenas o ciclo
			die();
		}
		else
		{
			$objNovoCiclo->idaluno_ciclo = $this->Aluno_mod->addAluno_ciclo($data);
		}

		
		// verifica o modelo de ciclo de treino para inserir nas tabela
		// de treino 
		if (($ciclo->modeloCiclo == "AB") ||
			($ciclo->modeloCiclo == "ABC") ||
			($ciclo->modeloCiclo == "ABCD") ||
			($ciclo->modeloCiclo == "ABCDE"))
		{

			$data = array(
				'idaluno_ciclo' => $objNovoCiclo->idaluno_ciclo,
				'treino'        => "A"
			);

			$idaluno_treino = $this->Aluno_mod->addAluno_treino($data);
			
			$data = array(
				'idaluno_ciclo' => $objNovoCiclo->idaluno_ciclo,
				'treino'  		=> "B"
			);
	 		
			$idaluno_treino = $this->Aluno_mod->addAluno_treino($data);
			

		}
		
		if (($ciclo->modeloCiclo == "ABC")||
			($ciclo->modeloCiclo == "ABCD") ||
			($ciclo->modeloCiclo == "ABCDE"))
		{
			
	 		$data = array(
	 			'idaluno_ciclo' => $objNovoCiclo->idaluno_ciclo,
				'treino'  		=> "C"
			);
	 		
			$idaluno_treino = $this->Aluno_mod->addAluno_treino($data);

		}

		if (($ciclo->modeloCiclo == "ABCD")||
			($ciclo->modeloCiclo == "ABCDE"))
		{

			$data = array(
				'idaluno_ciclo' => $objNovoCiclo->idaluno_ciclo,
				'treino'  		=> "D"
			);
	 		
			$idaluno_treino = $this->Aluno_mod->addAluno_treino($data);

		}

		if ($ciclo->modeloCiclo == "ABCDE")
		{

	 		$data = array(
	 			'idaluno_ciclo' => $objNovoCiclo->idaluno_ciclo,
				'treino'  => "E"
			);
	 		
			$idtreino = $this->Aluno_mod->addAluno_treino($data);
		}

		// retorna o objeto para o metodo do angular
		print(json_encode($objNovoCiclo));
	}

	// adiciona os exercicios do treino selecionado quando o usário cadastrar um novo ciclo
	public function addExercicioTreinoAluno_post()
	{
		$postdata           = file_get_contents("php://input");
		$novoExercicioAluno = json_decode($postdata);
		
		$data = array(
 			'idaluno_treino'   => $novoExercicioAluno->idaluno_treino,
			'exercicio'        => $novoExercicioAluno->exercicio->exercicio,
			'regiaoTrabalhada' => $novoExercicioAluno->exercicio->regiaoTrabalhada,
			'tipoExercicio'    => $novoExercicioAluno->exercicio->tipoExercicio,
			'aparelho'         => $novoExercicioAluno->exercicio->aparelho,
			'serie'            => "",
			'repeticao'        => "",
			'peso'             => "",
			'intervalo'        => ""
		);
 		
		$idaluno_exercicio = $this->Aluno_mod->addExercicioTreinoAluno($data);

		print(json_encode($idaluno_exercicio));
	}

	// lista os novos treinos do novo ciclo adicionado
	// para poderem adicionar os novos exercicios
	public function listaTreinosAluno_post()
	{
		$postdata       = file_get_contents("php://input");
		$idaluno_ciclo  = json_decode($postdata);

		$treinos = $this->Aluno_mod->listaTreinosAluno($idaluno_ciclo);
			
		$this->response($treinos);
	}

	// lista os exercicios do treino selecionado
	public function listaNovosExerciciosTreinoAluno_post()
	{
		$postdata        = file_get_contents("php://input");
		$idAluno_treino  = json_decode($postdata);

		$exerciciosTreinoAluno = $this->Aluno_mod->listaNovosExerciciosTreinoAluno($idAluno_treino);
			
		$this->response($exerciciosTreinoAluno);
	}

	// metodo para fazer update na tabela aluno_exercicio
	// para adicionar exercicios combinados
	public function salvarTreinoCombinadoAluno_post()
	{
		$postdata              = file_get_contents("php://input");
		$objExercicioCombinado = json_decode($postdata);


		$idaluno_exercicio = $objExercicioCombinado->ID_aluno_exercicio;

		$exercicioExistente = $objExercicioCombinado->Exercicio_novo_aluno;

		$novoExercicioCombinado = $objExercicioCombinado->exercicio->exercicio;

		$idaluno_exercicio = $this->Aluno_mod->salvarTreinoCombinadoAluno(
			$idaluno_exercicio, $exercicioExistente, $novoExercicioCombinado);
			
		$this->response($idaluno_exercicio);
	}
	

	// pega os ciclos de treino do aluno selecionado
	public function getCiclosTreinosAluno_post()
	{
		$postdata = file_get_contents("php://input");
		$idaluno  = json_decode($postdata);

		$ciclos = $this->Aluno_mod->getCiclosTreinosAluno($idaluno);

		foreach ($ciclos as $key => $value) 
		{
			$ciclos[$key]->dataInicioBrasileiro = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$ciclos[$key]->dataTerminoBrasileiro = implode("/",array_reverse(explode("-",$value->data_termino)));
		}
			
		$this->response($ciclos);
	}

	// seleciona os treinos do aluno selecionado
	public function getTreinos_post()
	{
		$postdata       = file_get_contents("php://input");
		$idAluno_ciclo  = json_decode($postdata);

		$idaluno = $idAluno_ciclo->idaluno;
		$idaluno_ciclo = $idAluno_ciclo->idaluno_ciclo;

		$treinos = $this->Aluno_mod->getTreinos($idaluno, $idaluno_ciclo);

		print(json_encode($treinos));
	}

	// seleciona os exercicios dos treinos do aluno e do ciclo selecionado
	public function getExerciciosTreinos_post()
	{
		$postdata            = file_get_contents("php://input");
		$idAluno_cicloTreino = json_decode($postdata);

		$idaluno        = $idAluno_cicloTreino->idaluno;
		$idaluno_ciclo  = $idAluno_cicloTreino->idaluno_ciclo;
		$idaluno_treino = $idAluno_cicloTreino->idaluno_treino;

		$exerciciosTreinos = $this->Aluno_mod->getExerciciosTreinos($idaluno, $idaluno_ciclo, $idaluno_treino);

		print(json_encode($exerciciosTreinos));
	}

	

	// metodo para pesquisar o aluno segundo os criterios de busca
	// digitados no input de pesquisa
	public function pesquisarAluno_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$aluno->idaluno  = $request->buscarAluno->idaluno;
				
		// metodo para converter a data do formato brasileiro para o do mysql
		$aluno->dataNascimento  = implode("-",array_reverse(explode("/",$request->buscarDataNascimento)));

		$alunos = $this->Aluno_mod->pesquisarAluno($aluno);

		foreach ($alunos as $key => $value) 
		{
			$alunos[$key]->dataNascimentoBrasileiro = implode("/",array_reverse(explode("-",$value->dataNascimento)));
		}
			
		$this->response($alunos); 
		
	}

	 // metodo para salvar o peso, serie e intervalo do exercicio selecionado
	public function salvarExercicio_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$idaluno_exercicio = $request->idaluno_exercicio;
		$exercicio = $request->exercicio;
		
		// chama o metodo para atualizar a tabela aluno_exercicio
		$this->Aluno_mod->salvarExercicio($idaluno_exercicio, $exercicio);

	}	

	// pesquisa o ciclo de treino quando clica no botão buscar e filtra a grid de ciclos
	public function pesquisarCicloAluno_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);
		
		$idaluno_ciclo = $request->buscar->idaluno_ciclo;
		$idaluno       = $request->idaluno;

		$ciclo->dataInicio  = implode("-",array_reverse(explode("/",$request->dataInicio)));

		$ciclo->dataTermino  = implode("-",array_reverse(explode("/",$request->dataTermino)));
		
		$ciclos = $this->Aluno_mod->pesquisarCicloAluno($idaluno, $idaluno_ciclo, $ciclo);

		foreach ($ciclos as $key => $value) 
		{
			$ciclos[$key]->dataInicioBrasileiro = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$ciclos[$key]->dataTerminoBrasileiro = implode("/",array_reverse(explode("-",$value->data_termino)));
		}
			
		$this->response($ciclos); 
		
	}

	// autocomplete do campo de busca de alunos
	public function autoAluno_post()
	{
		$postdata      = file_get_contents("php://input");
		$request       = json_decode($postdata);
		$buscarAluno   = $request->buscarAluno;

		$res = $this->Aluno_mod->autoAluno($buscarAluno);

		print(json_encode($res));
	}

	// faz o auto complete do buscar ciclo de treino do aluno
	public function autoCicloAluno_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$buscar  = $request->buscarCicloAluno->buscar;
		$idaluno = $request->buscarCicloAluno->idaluno;
				
		// chama o metodo que irá pegar os ciclos do aluno passando o id do aluno e a string
		// que o usuário digitou no input		
		$res = $this->Aluno_mod->autoCicloAluno($buscar, $idaluno);

		print(json_encode($res));
	}

	// deleta um exercicio da tabela de treino do aluno
	public function exluirExercicioTreinoAluno_post()
	{
		$postdata           = file_get_contents("php://input");
		$idaluno_exercicio  = json_decode($postdata);

		$this->Aluno_mod->exluirExercicioTreinoAluno($idaluno_exercicio);
		
	}

	// lista os treinos realizados pelo aluno
	public function getTreinosRealizadosAluno_post()
	{

		$postdata = file_get_contents("php://input");
		$idaluno  = json_decode($postdata);

		$ciclo = $this->Aluno_mod->getTreinosRealizadosAluno($idaluno);

		foreach ($ciclo as $key => $value) 
		{
			$ciclo[$key]->dataInicioTreino = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$ciclo[$key]->dataTerminoTreino = implode("/",array_reverse(explode("-",$value->data_termino)));

			$ciclo[$key]->dataTreino = implode("/",array_reverse(explode("-",$value->data_treino)));
		}


		$this->response($ciclo);
	}

	public function autoCiclosRealizados_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$buscar  = $request->buscar;
		$idaluno = $request->idaluno;
						
		$res = $this->Aluno_mod->autoCiclosRealizados($idaluno, $buscar);

		print(json_encode($res));
	}

	public function pesquisarTreinosRealizados_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$idaluno = $request->idaluno;

		$idaluno_ciclo = $request->buscar->idaluno_ciclo;

		$ciclo->dataInicio  = implode("-",array_reverse(explode("/",$request->dataInicio)));

		$ciclo->dataTermino  = implode("-",array_reverse(explode("/",$request->dataTermino)));

		$ciclo->dataTreinoRealizado  = implode("-",array_reverse(explode("/",$request->dataTreinoRealizado)));
		
		$ciclos = $this->Aluno_mod->pesquisarTreinosRealizados($idaluno, $idaluno_ciclo, $ciclo);

		foreach ($ciclos as $key => $value) 
		{
			$ciclos[$key]->dataInicioTreino = implode("/",array_reverse(explode("-",$value->data_inicio)));

			$ciclos[$key]->dataTerminoTreino = implode("/",array_reverse(explode("-",$value->data_termino)));

			$ciclos[$key]->dataTreino = implode("/",array_reverse(explode("-",$value->data_treino)));
		}
			
		$this->response($ciclos); 
		
	}

	public function mostraTreinosRealizadosAluno_post()
	{
		$postdata = file_get_contents("php://input");
		$idtreino_realizado  = json_decode($postdata);

		$treinoSelecionado = $this->Aluno_mod->mostraTreinosRealizadosAluno($idtreino_realizado);

		foreach ($treinoSelecionado as $key => $value) 
		{
			$treinoSelecionado[$key]->dataTreino = implode("/",array_reverse(explode("-",$value->data_treino)));
		}
							
		$this->response($treinoSelecionado); 
	}

	public function getTreinosRealizadosAlunoSelecionado_post()
	{
		$postdata = file_get_contents("php://input");
		$idtreino_realizado  = json_decode($postdata);

		$treinos = $this->Aluno_mod->getTreinosRealizadosAlunoSelecionado($idtreino_realizado);

		print(json_encode($treinos));
	}

	public function getExerciciosTreinosAlunoSelecionado_post()
	{
		$postdata  = file_get_contents("php://input");
		$idtreino_realizado  = json_decode($postdata);

		$exerciciosTreinos = $this->Aluno_mod->getExerciciosTreinosAlunoSelecionado($idtreino_realizado);

		print(json_encode($exerciciosTreinos));
	}
}