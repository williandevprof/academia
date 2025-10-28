<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Pessoa extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Pessoa_mod');
        $this->load->model('Parq_mod');
        session_start();
    }

	public function index_get()
	{
		$this->load->view('pessoa/pessoa');
	}


	// pega o id do estado de acordo com o nome 
	public function getIdEstado_post()
	{
		$estado  = file_get_contents("php://input");
		
		$idestado = $this->Pessoa_mod->getIdEstado($estado);

		print(json_encode($idestado));
	}


	public function autoPessoa_post()
	{
		$postdata      = file_get_contents("php://input");
		$request       = json_decode($postdata);
		$buscarPessoa  = $request->buscarPessoa;

		$res = $this->Pessoa_mod->autoPessoa($buscarPessoa);

		print(json_encode($res));
	}

	public function autoUsuario_post()
	{
		$postdata       = file_get_contents("php://input");
		$request        = json_decode($postdata);
		$buscarUsuario  = $request->buscarUsuario;

		$res = $this->Pessoa_mod->autoUsuario($buscarUsuario);

		print(json_encode($res));
	}

	public function listaEstado_get()
	{
		$estados = $this->Pessoa_mod->getEstados();
			
		$this->response($estados);
	}

	public function listaPessoa_get()
	{
		$pessoas = $this->Pessoa_mod->getPessoas();

		$this->response($pessoas);
	}

	// lista as perguntas para o usuário responder o parq
	public function listaPerguntas_get()
	{
		$perguntas = $this->Parq_mod->getPeguntas();
			
		$this->response($perguntas);
	}

	// lista as respostas do aluno no parq para evitar 
    //de listar perguntas repetidas
	public function listaRespostasParq_post()
	{
		$postdata = file_get_contents("php://input");
		$idpessoa = json_decode($postdata);

		$respostasAlunoParq = $this->Parq_mod->listaRespostasParq($idpessoa);
			
		$this->response($respostasAlunoParq);
	}
	

	public function pesquisarPessoa_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$pessoa->idpessoa   	= $request->buscarPessoa->idpessoa;
		$pessoa->tipoPessoa 	= $request->buscarTipoPessoa;
		
		// metodo para converter a data do formato brasileiro para o do mysql
		$pessoa->dataNascimento  = implode("-",array_reverse(explode("/",$request->buscarDataNascimento)));

		$res = $this->Pessoa_mod->pesquisarPessoa($pessoa);
			
		$this->response($res); 
		
	}

	// metodo para preencher os campos do formulario para alterar
	public function getPessoaEditar_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$idpessoa = $request->idpessoa;

		$pessoa = $this->Pessoa_mod->getPessoaEditar($idpessoa);

		foreach ($pessoa as $key => $value) 
		{
			$pessoa[$key]->dataNascimento = implode("/",array_reverse(explode("-",$value->dataNascimento)));
		}
			
		$this->response($pessoa);

	}

	public function getConsultores_get()
	{
		$consultores = $this->Pessoa_mod->getConsultores();
			
		$this->response($consultores);
	}

	public function getContratos_get()
	{
		$contratos = $this->Pessoa_mod->getContratos();
			
		$this->response($contratos);
	}
	

	public function getCategoriaTreino_get()
	{
		$categorias = $this->Pessoa_mod->getCategoriaTreino();
			
		$this->response($categorias);
	}

	
	public function getTipoPlano_get()
	{
		$tipoPlano = $this->Pessoa_mod->getTipoPlano();
			
		$this->response($tipoPlano);
	}

	public function getFormaPgto_get()
	{
		$formaPgto = $this->Pessoa_mod->getFormaPgto();
			
		$this->response($formaPgto);
	}

	public function getPrazoPlano_get()
	{
		$formaPgto = $this->Pessoa_mod->getPrazoPlano();
			
		$this->response($formaPgto);
	}

	
	public function addPessoa_post()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);


		// cria um novo objeto para guardar as mensagens
		// de validações e o retorno do idpessoa se for cadastrado
		$objPessoa = new stdClass();
		
		 		
		if ($request->natureza == "")
		{
		 	$request->natureza = "pf";
		} 
		
		
		
		/* Validações */ 
		// da mensagem se não for número
		if (!is_numeric($request->estado))
		{
		 	$objPessoa->mensagem = "Escolha o estado para realizar o cadastro";
			print(json_encode($objPessoa)); 
	        die();
		} 

				
		if ($request->nome == "")
		{
			$objPessoa->mensagem = "O campo nome e de preenchimento obrigatorio";
			print(json_encode($objPessoa)); 
	        die();
		}

		if ($request->cep != "")
		{
			if (!eregi("^[0-9]{5}-[0-9]{3}$", $request->cep)) 
			{
				$objPessoa->mensagem = "Cep invalido";
				print(json_encode($objPessoa)); 
		        die();
			}
		}

		if ($request->cpf != "")
		{
			if (!eregi("^([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}$", $request->cpf))
			{
				$objPessoa->mensagem = "CPF Invalido";
				print(json_encode($objPessoa)); 
		        die();
				
			}
		}	
		
						
		// validação de senha caso o usuário esteja tentando cadastrar um usuário
		if (($request->user) || ($request->senha))
		{
			$validUsuario = true;

			if ($request->user == "") 
			{
	            $objPessoa->mensagem = "O campo usuario nao pode ser vazio";
	        	$validUsuario = false;
	        } else if ($request->senha == "") 
			{
	            $objPessoa->mensagem = "O campo senha nao pode ser vazio";
	        	$validUsuario = false;
	        }else if (strlen($request->user) < 8)
	        {
	            $objPessoa->mensagem = "O usuario nao pode ter menos de 8 caracteres";
	        	$validUsuario = false;
	        } 
	        else if (($request->confsenha == "") || ($request->senha != $request->confsenha))
	        {
	            $objPessoa->mensagem = "Senha nao confirmada";
	        	$validUsuario = false;
	        }else if (strlen($request->senha) < 8) {
	        	$objPessoa->mensagem = "A senha nao pode ter menos do que 8 caracteres";
	        	$validUsuario = false;
	        } else
	        if (preg_match('/[A-Za-z]/', $request->senha) && preg_match('/[0-9]/', $request->senha))
			{
			    // verifica se a senha contem números e letras
			}
			else
			{
				$objPessoa->mensagem = "A senha deve conter letras e numeros";
				$validUsuario = false;
			}	
	         
	        if ($validUsuario == false)
	        {
	        	print(json_encode($objPessoa)); 
	        	die();
	        }
	    }	
		
		// pega a data atual
		$dataCadastro = date("Y-m-d");

		// array para a tabela pessoa
		$data = array(
			'foto'           => $request->foto,
			'nome'           => $request->nome,
			'observacao'     => $request->observacao,
			'dataCadastro'   => $dataCadastro,
			'idcadastrador'  => $_SESSION["iduser"]
		);

			
		// veririfica se tem id para alterar ou cadastrar
		if ($request->idpessoa)
		{
			$this->Pessoa_mod->updatePessoa($request->idpessoa, $data);
		}
		else
		{
			$idPeople = $this->Pessoa_mod->addPessoa($data);
		}	
		
		
		// verifica se é pessoa física ou jurídica
		if ($request->natureza == "pf")
		{
			// metodo para converter a data do formato brasileiro para o do mysql
			$dataNascimento  = implode("-",array_reverse(explode("/",$request->dataNascimento)));

			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				$data = array(
					'dataNascimento' => $dataNascimento,
					'cpf'            => $request->cpf,
					'rg'             => $request->rg,
					'genero'         => $request->genero,
					'estadoCivil'    => $request->estadoCivil,
					'profissao'      => $request->profissao
				);
				
				$this->Pessoa_mod->updatePessoaFisica($request->idpessoa, $data);
			}
			else
			{
				$data = array(
					'idpessoa'       => $idPeople,
					'dataNascimento' => $dataNascimento,
					'cpf'            => $request->cpf,
					'rg'             => $request->rg,
					'genero'         => $request->genero,
					'estadoCivil'    => $request->estadoCivil,
					'profissao'      => $request->profissao
				);

				$idPf = $this->Pessoa_mod->addPessoaFisica($data);
			}	
		}else if($request->natureza == "pj")
		{
			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				$data = array(
					'razaoSocial' 	    => $request->razaoSozial,
					'cnpj'        		=> $request->cnpj,
					'inscricaoEstadual' => $request->inscricaoEstadual
				);
				
				$this->Pessoa_mod->updatePessoaJuridica($request->idpessoa, $data);
			}
			else
			{
				$data = array(
					'idpessoa'          => $idPeople,
					'razaoSocial' 	    => $request->razaoSozial,
					'cnpj'        		=> $request->cnpj,
					'inscricaoEstadual' => $request->inscricaoEstadual
				);

				$idPj = $this->Pessoa_mod->addPessoaJuridica($data);
			}
		}

			
		// verifica se a pessoa é também um usuario
		if ($request->user)
		{
		
			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				// é necessário montar outro array sem o idpessoa
				$data = array(
					'usuario '  => $request->user,
					'senha'     => $request->senha,
					'ativo'     => true,
					'idusuario_grupo' => 2
				);

				$this->Pessoa_mod->updateUsuario($request->idpessoa, $data);
			}
			else
			{

				// array para a tabela usuario
				$data = array(
					'idpessoa'  => $idPeople,
					'usuario '  => $request->user,
					'senha'     => $request->senha,
					'ativo'     => true,
					'idusuario_grupo' => 2
				);
				
				$idUser = $this->Pessoa_mod->addUsuario($data);
			}

		}

		
		// verifica se a pessoa é também um aluno
		if ($request->aluno)
		{
			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				// array para a tabela aluno
				$data = array(
					'codigoCatraca' => $request->codigoCatraca,
					'consultor' 	=> $request->consultor
				);

				$res = $this->Pessoa_mod->updateAluno($request->idpessoa, $data);


			}
			else
			{
				// array para a tabela aluno
				$data = array(
					'idpessoa '     => $idPeople,
					'codigoCatraca' => $request->codigoCatraca,
					'consultor' 	=> $request->consultor
				);

				$idAlu = $this->Pessoa_mod->addAluno($data);

				/*$dataPagamento   = implode("-",array_reverse(explode("/",$request->dataPagamento)));
				$dataContratacao = implode("-",array_reverse(explode("/",$request->dataContratacao)));
				$dataTermino     = implode("-",array_reverse(explode("/",$request->dataTermino)));
				$dataRenovacao   = implode("-",array_reverse(explode("/",$request->dataRenovacao)));


				//array para a tabela de contrato
				$data = array(
					'idaluno '         => $idAlu,
					'idcategoriaTreino'=> $request->categoriaTreino,
					'idtipoPlano'      => $request->tipoPlano,
					'idprazoPlano'     => $request->prazoPlano,
					'idformaPagamento' => $request->formaPgto,
					'numeroParcelas'   => $request->numeroParcelas,
					'valorParcela'     => $request->valorParcela,
					'valorTotal'       => $request->valorTotal,
					'dataPagamento'	   => $dataPagamento,	
					'dataContratacao'  => $dataContratacao,
					'dataTermino'      => $dataTermino,
					'dataRenovacao'    => $dataRenovacao
				);
				
				$idContrato = $this->Pessoa_mod->addContrato($data);*/
				
			}
		}

	
		// verifica se a pessoa é também um aluno para cadastrar o parq
		if ($request->aluno)
		{
			// array para a tabela Parq_aluno
			$data = array(
				'idaluno '     => $idAlu
			);

			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				//$this->Pessoa_mod->updateParq_aluno($request->idpessoa, $data);
			}
			else
			{
				$idParq_aluno = $this->Pessoa_mod->addParq_aluno($data);
			}
		}


		// verifica se a pessoa é também um aluno para cadastrar o parq
		if ($request->aluno)
		{
			// pega a quantidade de linhas da tabela perguntas_parq
			$resCountPerguntasParq = $this->Parq_mod->countPerguntasParq();
		
			
			for ($i=0; $i < $resCountPerguntasParq; $i++)
			{
				
				
				// veririfica se tem id para alterar ou cadastrar
				if ($request->idpessoa)
				{
					$idparq_aluno_perguntas_parq = $request->respostasAlunoParq[$i]->idparq_aluno_perguntas_parq;
					
					
					$data = array(
						'idparqAluno'   => $request->respostasAlunoParq[$i]->idparqAluno,
						'idperguntaParq'=> $request->perguntas[$i]->idperguntaParq,
						'resposta'      => $request->perguntas[$i]->resposta
					);

					
					$this->Pessoa_mod->updateParq_aluno_perguntas_parq($idparq_aluno_perguntas_parq, $data);
				}
				else
				{
					// array para a tabela parq_aluno_perguntas_parq
					$data = array(
						'idparqAluno'   => $idParq_aluno,
						'idperguntaParq'=> $request->perguntas[$i]->idperguntaParq,
						'resposta'      => $request->perguntas[$i]->resposta
					);

					$this->Pessoa_mod->addParq_aluno_perguntas_parq($data);
				}
			}	
		}

		// verifica se a pessoa é também um funcionario
		if ($request->funcionario)
		{

			// metodo para converter a data do formato brasileiro para o do mysql
			$dataAdmissao  = implode("-",array_reverse(explode("/",$request->dataAdmissao)));
			
			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				
				$data = array(
					'funcao' 	    => $request->funcao,
					'setor'        	=> $request->setor,
					'dataAdmissao'  => $dataAdmissao,
					'ctps' 			=> $request->ctps,
					'serie' 		=> $request->serie,
					'pis'			=> $request->pis,
					'salarioBase' 	=> $request->salario
				);

				$this->Pessoa_mod->updateFuncionario($request->idpessoa, $data);
			}
			else
			{
				// array para a tabela funcionario
				$data = array(
					'idpessoa '     => $idPeople,
					'funcao' 	    => $request->funcao,
					'setor'        	=> $request->setor,
					'dataAdmissao'  => $dataAdmissao,
					'ctps' 			=> $request->ctps,
					'serie' 		=> $request->serie,
					'pis'			=> $request->pis,
					'salarioBase' 	=> $request->salarioBase
				);

				$idfunc = $this->Pessoa_mod->addFuncionario($data);
			}
		}

		// verifica se a pessoa é também um fornecedor
		if ($request->fornecedor)
		{
			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				
				$data = array(
					
				);

				$this->Pessoa_mod->updateFornecedor($request->idpessoa, $data);
			}
			else
			{
				// array para a tabela fornecedor
				$data = array(
					'idpessoa' => $idPeople
				);

				$idforn = $this->Pessoa_mod->addFornecedor($data);
			}
		}

		
		// array para a tabela cidade
		$data = array(
			'idestado ' => $request->estado,
			'cidade'    => $request->cidade
		);

		// veririfica se tem id para alterar ou cadastrar
		if ($request->idcidade)
		{
			
			$this->Pessoa_mod->updateCidade($request->idcidade, $data);
			
		}
		else
		{
			$idCity = $this->Pessoa_mod->addCidade($data);

		}

	
		// veririfica se tem id para alterar ou cadastrar
		if ($request->idbairro)
		{
			$data = array(
				'idcidade ' => $request->idcidade,
				'bairro'    => $request->bairro
			);
			
			$this->Pessoa_mod->updateBairro($request->idbairro, $data);
		}
		else
		{
			// array para a tabela bairro
			$data = array(
				'idcidade ' => $idCity,
				'bairro'    => $request->bairro
			);

			$idJardim = $this->Pessoa_mod->addBairro($data);
		}


		// veririfica se tem id para alterar ou cadastrar
		if ($request->idendereco)
		{
			$data = array(
				'idpessoa'   => $request->idpessoa,
				'idbairro'   => $request->idbairro,
				'rua'        => $request->rua,
				'numero'     => $request->numero,
				'complemento'=> $request->complemento,
				'referencia' => $request->referencia,
				'cep'        => $request->cep
			); 
			
			$res = $this->Pessoa_mod->updateEndereco($request->idendereco, $data);
			
		}
		else
		{

			// array para a tabela endereco
			$data = array(
				'idpessoa '  => $idPeople,
				'idbairro'   => $idJardim,
				'rua'        => $request->rua,
				'numero'     => $request->numero,
				'complemento'=> $request->complemento,
				'referencia' => $request->referencia,
				'cep'        => $request->cep
			); 

			$idlocalizacao = $this->Pessoa_mod->addEndereco($data);
		}

		// pega as chaves e depois a ultima posição do array
		$keys = array_keys($request->enderecos);
		$last_key = end($keys);
		
		// se o last key for falso ele não entra no laço
		// por isso passo ele para -1
		if (!$last_key) 
		{
			$last_key = -1 ;
		}

		// faz o laço para inserir todos os endereços
		for ($i=0; $i <= $last_key; $i++) 
		{
			
			// array para a tabela cidade
			$data = array(
				'idestado ' => $request->estado,
				'cidade'    => $request->enderecos[$i]->cidade,
			); 

			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				//$this->Pessoa_mod->updateCidade($request->idcidade, $data);
			}
			else
			{
				$idCity = $this->Pessoa_mod->addCidade($data);
			}

			// array para a tabela bairro
			$data = array(
				'idcidade ' => $idCity,
				'bairro'    => $request->enderecos[$i]->bairro
			); 

			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				//$this->Pessoa_mod->updateBairro($request->idbairro, $data);
			}
			else
			{
				$idJardim = $this->Pessoa_mod->addBairro($data);
			}

			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				$data = array(
					'rua'        => $request->enderecos[$i]->rua,
					'numero'     => $request->enderecos[$i]->numero,
					'complemento'=> $request->enderecos[$i]->complemento,
					'referencia' => $request->enderecos[$i]->referencia,
					'cep'        => $request->enderecos[$i]->cep
				); 
				$this->Pessoa_mod->updateEndereco($request->idendereco, $data);
			}
			else
			{

				// array para a tabela endereco
				$data = array(
					'idpessoa '  => $idPeople,
					'idbairro'   => $idJardim,
					'rua'        => $request->enderecos[$i]->rua,
					'numero'     => $request->enderecos[$i]->numero,
					'complemento'=> $request->enderecos[$i]->complemento,
					'referencia' => $request->enderecos[$i]->referencia,
					'cep'        => $request->enderecos[$i]->cep
				); 

				$idlocalizacao = $this->Pessoa_mod->addEndereco($data);
			}
		}

		// veririfica se tem id para alterar ou cadastrar
		if ($request->idemail)
		{
			$data = array(
				'idpessoa' => $request->idpessoa,
				'email'    => $request->email
			); 

			$this->Pessoa_mod->updateEmail($request->idemail, $data);
		}
		else
		{
			// array para a tabela email
			$data = array(
				'idpessoa ' => $idPeople,
				'email'     => $request->email

			); 

			$idmail = $this->Pessoa_mod->addEmail($data);
		}

		if ($request->email_dois)
		{
			// veririfica se tem id para alterar ou cadastrar
			if ($request->idemail_dois)
			{
				$data = array(

					'email'   => $request->email_dois
				); 

				$this->Pessoa_mod->updateEmail($request->idpessoa, $data);
			}
			else
			{
				// array para a tabela email
				$data = array(
					'idpessoa ' => $idPeople,
					'email'     => $request->email_dois

				); 

				$idmail = $this->Pessoa_mod->addEmail($data);
			}
		}
			

		// veririfica se tem id para alterar ou cadastrar
		if ($request->idtelefone)
		{
			$data = array(
				'idpessoa'  => $request->idpessoa,
				'tipo' 		=> $request->tipoTelefone,
				'operadora' => $request->operadora,
				'telefone'  => $request->telefone,
				'contato'   => $request->contato
			); 
			$this->Pessoa_mod->updateTelefone($request->idtelefone, $data);
		}
		else
		{

			// array para a tabela telefone
			$data = array( 
				'idpessoa ' => $idPeople,
				'tipo' 		=> $request->tipoTelefone,
				'operadora' => $request->operadora,
				'telefone'  => $request->telefone,
				'contato'   => $request->contato
			); 

			$idtel1 = $this->Pessoa_mod->addTelefone($data);
		}


		// pega as chaves e depois a ultima posição do array
		$keys = array_keys($request->contatos);
		$last_key = end($keys);

		// se o last key for falso ele não entra no laço
		// por isso passo ele para -1
		if (!$last_key) 
		{
			$last_key = -1 ;
		}
		
		// faz o laço para inserir todos os telefones
		for ($i=0; $i <= $last_key; $i++) 
		{
			// veririfica se tem id para alterar ou cadastrar
			if ($request->idpessoa)
			{
				$data = array(
					'tipo' 		=> $request->contatos[$i]->tipoTelefone,
					'operadora' => $request->contatos[$i]->operadora,
					'telefone'  => $request->contatos[$i]->telefone,
					'contato'   => $request->contatos[$i]->contato
				); 
				$this->Pessoa_mod->updateTelefone($request->idpessoa, $data);
			}
			else
			{

				// array para a tabela telefone
				$data = array(
					'idpessoa ' => $idPeople,
					'tipo' 		=> $request->contatos[$i]->tipoTelefone,
					'operadora' => $request->contatos[$i]->operadora,
					'telefone'  => $request->contatos[$i]->telefone,
					'contato'   => $request->contatos[$i]->contato
				); 

				$this->Pessoa_mod->addTelefone($data);
			}
		}

		// passa para o objeto o id da pessoa cadastrada
		$objPessoa->idpessoa = $idPeople;

		// depois de cadastrar nas tabelas retorna o objeto 
		//com o id da pessoa para  cadastrar a foto na tabela pessoa
		print(json_encode($objPessoa));
	
	}// fim do metodo
} // fim da classe