<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/rest_controller.php';

header('Access-Control-Allow-Origin: *');
header('Accllow-Headers: Content-Type');
header('Access-Control-Aess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Contrato extends REST_Controller{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Contrato_mod');
        session_start();
        
    }

	public function index_get()
	{
		$this->load->view('contrato/contrato');
	}

	public function addContrato_post()
	{
				
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$mensagem = 0;

		if ($request->nome == "")
		{
			$mensagem = "O campo nome e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		if ($request->texto == "")
		{
			$mensagem = "O campo contrato e de preenchimento obrigatorio";
			print(json_encode($mensagem)); 
	        die();
		}

		$today = date("Y-m-d");

		// array para a tabela contrato
		$data = array(
			'texto'         => $request->texto,
			'nome'          => $request->nome,
			'idcadastrador' => $_SESSION["iduser"],
			'dataCadastro'  => $today
			
		);
		
		// veririfica se tem id para alterar ou cadastrar
		if ($request->idcontrato)
		{
			$res = $this->Contrato_mod->updateContrato($request->idcontrato, $data);
			
		}
		else
		{
			$idContrato = $this->Contrato_mod->addContrato($data);
		}	

		print(json_encode($mensagem));

	}	

	// lista os contratos para o campo contrato do formulario
	public function listarContratos_get()
	{
		$contratos = $this->Contrato_mod->listarContratos();
			
		$this->response($contratos);

	}

	// lista as formas de pagamento para o campo do formulario
	public function listarFormas_pgto_get()
	{
		$formas_pgto = $this->Contrato_mod->listarFormas_pgto();
			
		$this->response($formas_pgto);

	}

	// lista os prazos dos planos para o campo do formulario
	public function listarPrazos_plano_get()
	{
		$prazos_plano = $this->Contrato_mod->listarPrazos_plano();
			
		$this->response($prazos_plano);

	}

	// lista os tipos de plano para o campo do formulario
	public function listarTipos_plano_get()
	{
		$tipos_plano = $this->Contrato_mod->listarTipos_plano();
			
		$this->response($tipos_plano);

	}

	// lista as modalidades para o campo do formulário
	public function listarModalidades_get()
	{
		$modalidades = $this->Contrato_mod->listarModalidades();
			
		$this->response($modalidades);

	}
	
	// lista os contratos do aluno selecionado
	public function listaContratosAluno_post()
	{
		$postdata  = file_get_contents("php://input");
		$pessoa    = json_decode($postdata);
		
		$contratosAluno = $this->Contrato_mod->listaContratosAluno($pessoa);

		print(json_encode($contratosAluno));
	}

	// autocomplete do campo de busca de contratos
	public function autoContrato_post()
	{
		$postdata       = file_get_contents("php://input");
		$request        = json_decode($postdata);
		$buscarContrato = $request->buscarContrato;

		$contratos = $this->Contrato_mod->autoContrato($buscarContrato);

		print(json_encode($contratos));
	}	


	public function pesquisarContrato_post()
	{

		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);

		$contrato->idcontrato    = $request->buscarContrato->idcontrato;
				
		$contrato->dataContrato1  = implode("-",array_reverse(explode("/",$request->buscarDataContrato1)));

		$contrato->dataContrato2  = implode("-",array_reverse(explode("/",$request->buscarDataContrato2)));
		
		$contratos = $this->Contrato_mod->pesquisarContrato($contrato);
			
		$this->response($contratos); 
		
	}

	// metodo que busca os valores na tabela valores_planos 
   //conforme o que o usuário escolher no formulario de contrato do aluno
	public function getValores_post()
	{
		$postdata       = file_get_contents("php://input");
		$aluno_contrato = json_decode($postdata);
		
		
		$valores_contrato = $this->Contrato_mod->getValores($aluno_contrato);
			
		$this->response($valores_contrato);
	}

	// metodo que salva o contrato do aluno na tabela aluno_contrato
	public function salvarAlunoContrato_post()
	{
		$postdata       = file_get_contents("php://input");
		$aluno_contrato = json_decode($postdata);

		$idaluno = $aluno_contrato->idaluno;

		$aluno_contrato = $aluno_contrato->contrato;

		$mensagem = 0;

		if ($aluno_contrato->contrato == "")
		{
			$mensagem = "O Campo contrato nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		if ($aluno_contrato->tipo_plano == "")
		{
			$mensagem = "O Campo tipo de plano nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		if ($aluno_contrato->modalidade == "")
		{
			$mensagem = "O Campo modalidade nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		if ($aluno_contrato->prazo_plano == "")
		{
			$mensagem = "O Campo prazo de plano nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		if ($aluno_contrato->formaPgto == "")
		{
			$mensagem = "O Campo forma de pagamento nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		/*if ($aluno_contrato->dataContratacao == "")
		{
			$mensagem = "O Campo data do contrato nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}*/

		if ($aluno_contrato->numeroParcelas == "")
		{
			$mensagem = "O Campo numero de parcelas nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		if ($aluno_contrato->valorParcela == "")
		{
			$mensagem = "O Campo valor das parcelas nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		if ($aluno_contrato->valorTotal == "")
		{
			$mensagem = "O Campo valor total nao pode ser vazio";
			print(json_encode($mensagem));
			die();
		}

		$today = date("Y-m-d");

		// fazer os metodos para cadastrar o contrato do aluno
		$data = array(
				'idaluno'          => $idaluno,
				'idcontrato'       => $aluno_contrato->contrato,
				'idtipoPlano'      => $aluno_contrato->tipo_plano,
				'idmodalidade'     => $aluno_contrato->modalidade,
				'idprazoPlano'     => $aluno_contrato->prazo_plano,
				'idformaPagamento' => $aluno_contrato->formaPgto,
				'numeroParcelas'   => $aluno_contrato->numeroParcelas,
				'valorParcela'     => $aluno_contrato->valorParcela,
				'valorTotal'       => $aluno_contrato->valorTotal,
				'dataPagamento'    => $aluno_contrato->dataPagamento,
				'dataContratacao'  => $aluno_contrato->dataContratacao,
				'dataTermino'      => $aluno_contrato->dataTermino,
				'dataRenovacao'    => $aluno_contrato->dataRenovacao,
				'dataCadastro'     => $today,
				'idcadastrador'    => $_SESSION["iduser"],
				'ativo'  		   => 0

			);

			// chama o metodo para salvar na tabela aluno_contrato
			$this->Contrato_mod->salvarAlunoContrato($data);

			print(json_encode($mensagem));
		
	}
}	