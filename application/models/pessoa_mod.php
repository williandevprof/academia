<?php 

class Pessoa_mod extends CI_Model{

	// __________ metodos de seleção __________________

	// pega o id do estado de acordo com o nome 
	public function getIdEstado($estado)
	{
		$this->db->where("estado", $estado);
		$this->db->select('idestado');
		$this->db->from('estado');

		$query = $this->db->get();
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	public function getPessoas()
	{
		$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa',          'left');
		$this->db->join('pessoaFisica pf','p.idpessoa = pf.idpessoa',   'left');
		$this->db->join('pessoaJuridica pj','p.idpessoa = pj.idpessoa ','left');
		$this->db->join('aluno a','p.idpessoa = a.idpessoa',            'left');
		$this->db->join('parq_aluno pq','a.idaluno = pq.idaluno',       'left');
		$this->db->join('parq_aluno_perguntas_parq pq_perguntas','pq.idparqAluno = pq_perguntas.idparqAluno', 'left');
		//$this->db->join('contrato_plano cont','a.idaluno = cont.idaluno','left');
		//$this->db->join('categoria_treino cat','cont.idcategoriaTreino = cat.idcategoriaTreino','left');
		$this->db->join('funcionario func','p.idpessoa = func.idpessoa','left');
		$this->db->join('fornecedor f','p.idpessoa = f.idpessoa',       'left');
		$this->db->join('endereco e','p.idpessoa = e.idpessoa',         'left');
		$this->db->join('bairro b','e.idbairro = b.idbairro' ,          'left');
		$this->db->join('cidade c','b.idcidade = c.idcidade' ,          'left');
		$this->db->join('estado es','c.idestado = es.idestado',         'left');
		$this->db->join('telefone t','p.idpessoa = t.idpessoa',         'left');
		$this->db->join('email em','p.idpessoa = em.idpessoa',          'left');
		//$this->db->join('aluno_contrato ac','ac.idaluno = a.idaluno',   'left');

		$this->db->group_by("t.idpessoa"); 

		$this->db->order_by("p.idpessoa", "desc");
		
		$query = $this->db->get();
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	// metodo para preencher todos os telefones para alterar
	public function getPessoaEditar($idpessoa)
	{
		
		$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa',          'left');
		$this->db->join('pessoaFisica pf','p.idpessoa = pf.idpessoa',   'left');
		$this->db->join('pessoaJuridica pj','p.idpessoa = pj.idpessoa ','left');
		$this->db->join('aluno a','p.idpessoa = a.idpessoa',            'left');
		$this->db->join('parq_aluno pq','a.idaluno = pq.idaluno',       'left');
		$this->db->join('parq_aluno_perguntas_parq pq_perguntas','pq.idparqAluno = pq_perguntas.idparqAluno');
		//$this->db->join('contrato_plano cont','a.idaluno = cont.idaluno','left');
		//$this->db->join('categoria_treino cat','cont.idcategoriaTreino = cat.idcategoriaTreino','left');
		$this->db->join('funcionario func','p.idpessoa = func.idpessoa','left');
		$this->db->join('fornecedor f','p.idpessoa = f.idpessoa',       'left');
		$this->db->join('endereco e','p.idpessoa = e.idpessoa',         'left');
		$this->db->join('bairro b','e.idbairro = b.idbairro' ,          'left');
		$this->db->join('cidade c','b.idcidade = c.idcidade' ,          'left');
		$this->db->join('estado es','c.idestado = es.idestado',         'left');
		$this->db->join('telefone t','p.idpessoa = t.idpessoa',         'left');
		$this->db->join('email em','p.idpessoa = em.idpessoa',          'left');
		
		$this->db->where('p.idpessoa', $idpessoa);

		$query = $this->db->get();
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	

	public function autoPessoa($buscarPessoa)
	{
		$this->db->select('idpessoa, nome');
		$this->db->from('pessoa');
		$this->db->like('nome', $buscarPessoa);
		
		$query = $this->db->get();

		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	public function autoUsuario($buscarUsuario)
	{
		$this->db->select('idusuario, usuario');
		$this->db->from('usuario');
		$this->db->like('usuario', $buscarUsuario);
		
		$query = $this->db->get();

		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	public function pesquisarPessoa($pessoa)
	{

		$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa', 'left');
		$this->db->join('pessoaFisica pf','p.idpessoa = pf.idpessoa',   'left');
		$this->db->join('pessoaJuridica pj','p.idpessoa = pj.idpessoa ','left');

		// se estiver filtrando por aluno eu tiro o left do join para trazer 
		// apenas os alunos
		if ($pessoa->tipoPessoa == "Aluno") 
		{
			$this->db->join('aluno a','p.idpessoa = a.idpessoa');
		}
		else
		{
			$this->db->join('aluno a','p.idpessoa = a.idpessoa', 'left');
		}

		if ($pessoa->tipoPessoa == "Funcionario") 
		{
			$this->db->join('funcionario func','p.idpessoa = func.idpessoa');	
		
		}	
		else
		{
			$this->db->join('funcionario func','p.idpessoa = func.idpessoa','left');
		}	

		if ($pessoa->tipoPessoa == "Fornecedor") 
		{
			$this->db->join('fornecedor f','p.idpessoa = f.idpessoa');
		}
		else
		{
			$this->db->join('fornecedor f','p.idpessoa = f.idpessoa', 'left');
		}
		
		
		$this->db->join('endereco e','p.idpessoa = e.idpessoa', 'left');
		$this->db->join('bairro b','e.idbairro = b.idbairro' ,  'left');
		$this->db->join('cidade c','b.idcidade = c.idcidade' ,  'left');
		$this->db->join('telefone t','p.idpessoa = t.idpessoa', 'left');
		$this->db->join('email em','p.idpessoa = em.idpessoa',  'left');


		if ($pessoa->idpessoa)
		{
			$this->db->where('p.idpessoa', $pessoa->idpessoa);
		}

		if ($pessoa->dataNascimento)
		{
			$this->db->where('pf.dataNascimento', $pessoa->dataNascimento);
		}
		
		$this->db->group_by("t.idpessoa"); 
		
		$this->db->order_by("p.idpessoa", "desc");
		
		$query = $this->db->get();
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	public function getEstados()
	{
		$query = $this->db->get('estado');
		return $query->result();
	}

	public function getConsultores()
	{
		$this->db->select('p.nome, p.idpessoa');
		$this->db->from('pessoa p');
		$this->db->join('funcionario f', 'p.idpessoa = f.idpessoa');
		
		$query = $this->db->get();
		
		return $query->result();
	}	

	public function getContratos()
	{
		$query = $this->db->get('contrato');
			
		return $query->result();
	}	

	

	public function getCategoriaTreino()
	{
		$query = $this->db->get('categoria_treino');
		
		return $query->result();
	}

	public function getTipoPlano()
	{
		$query = $this->db->get('tipo_plano');
		
		return $query->result();
	}

	public function getFormaPgto()
	{
		$query = $this->db->get('forma_pagamento');
		
		return $query->result();
	}

	public function getPrazoPlano()
	{
		$query = $this->db->get('prazo_plano');
		
		return $query->result();
	}


	// __________ metodos de adição __________________

	public function addPessoa($data)
	{
		// eu utilizo sessão nessa classe porque ela utiliza vários
		// metodos para inserir a pessoa
		// sendo assim a sessão serve para ir concatenando o texto
		// da tabela de log
		session_start();

		$_SESSION["descricaoCadastro"] = "Cadastrou a pessoa: ".$data['nome'];

		$_SESSION["idusuario"] = $data["idcadastrador"];
		
		$this->db->insert('pessoa', $data);
		return $this->db->insert_id();
	} 

	
	public function addPessoaFisica($data)
	{
		$dataNascimento = implode("/",array_reverse(explode("-",$data['dataNascimento'])));

		if ($data['genero'] == "M")
		{
			$genero = "Masculino";
		
		}else if ($data['genero'] == "F")
		{
			$genero = "Feminino";
		}

		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Data de Nascimento: ".$dataNascimento.", Cpf: ".$data['cpf'].", Rg: ".$data['rg']." Genero: ".$genero.", Estado Civil: ".$data['estadoCivil'].", Profissão: ".$data['profissao'];

		$this->db->insert('pessoaFisica', $data);
		return $this->db->insert_id();
	}

	public function addPessoaJuridica($data)
	{
		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Razão Social: ".$data['razaoSocial'].", Cnpj:: ".$data['cnpj'].", Inscrição Estadual: ".$data['inscricaoEstadual'];

		$this->db->insert('pessoaJuridica', $data);
		return $this->db->insert_id();
	}
	
	public function addUsuario($data)
	{
		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Usuário: ".$data['usuario'];

		$this->db->insert('usuario', $data);
		return $this->db->insert_id();
	} 

	public function addAluno($data)
	{
		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Consultor: ".$data['consultor'].", Código da Catraca: ".$data['codigoCatraca'];

		$this->db->insert('aluno', $data);
		return $this->db->insert_id();
	} 

	public function addContrato($data)
	{
		$this->db->insert('contrato_plano', $data);
		return $this->db->insert_id();
	} 

	public function addParq_aluno($data)
	{
		$this->db->insert('parq_aluno', $data);
		return $this->db->insert_id();
	} 

	public function addParq_aluno_perguntas_parq($data)
	{
		$this->db->insert('parq_aluno_perguntas_parq', $data);
		return $this->db->insert_id();
	} 

	public function addFuncionario($data)
	{
		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Função: ".$data['funcao'].", Setor:: ".$data['setor'].", Data de Admissão: ".$data['dataAdmissao'].", Carteira de Trabalho: ".$data['ctps'].", Serie:: ".$data['serie'].", Pis: ".$data['pis'].", Salário Base: ".$data['salarioBase'];

		$this->db->insert('funcionario', $data);
		return $this->db->insert_id();
	} 

	public function addFornecedor($data)
	{
		$this->db->insert('fornecedor', $data);
		return $this->db->insert_id();
	} 
	
	public function addCidade($data)
	{

		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Cidade: ".$data['cidade'];

		$this->db->insert('cidade', $data);
		return $this->db->insert_id();
	}

	public function addBairro($data)
	{
		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Bairro: ".$data['bairro'];

		$this->db->insert('bairro', $data);
		return $this->db->insert_id();
	}

	public function addEndereco($data)
	{
		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Rua: ".$data['rua'].", numero: ".$data['numero'].", Complemento: ".$data['complemento'].", Referência: ".$data['referencia'].", Cep: ".$data['cep'];

		$this->db->insert('endereco', $data);
		return $this->db->insert_id();
	}

	public function addEmail($data)
	{
		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Email: ".$data['email'];

		$this->db->insert('email', $data);
		return $this->db->insert_id();
	}

	public function addTelefone($data)
	{
		$_SESSION["descricaoCadastro"] = $_SESSION["descricaoCadastro"]. ", Tipo de Telefone: ".$data['tipo'].", Operadora:: ".$data['operadora'].", Telefone: ".$data['telefone'].", Contato: ".$data['contato'];

		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log 
		$log = array(
			'idusuario'	 => $_SESSION["idusuario"],
			'idtipo_log' => 1,
			'descricao'  => $_SESSION["descricaoCadastro"],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
						
		// insere na tabela de log com os dados de todas as tabela
		$this->db->insert('log', $log);

		unset($_SESSION["descricaoCadastro"]);

		$this->db->insert('telefone', $data);
		return $this->db->insert_id();
	}


	// __________ metodos de alteração __________________

	public function updatePessoa($idpessoa, $data){
		
    	session_start();

		// seleciona a pessoa que vai ser alterado no sistema para a tabela de log
		$this->db->where('idpessoa', $idpessoa);
				
		$query = $this->db->get('pessoa');
		$res   = $query->result();

		$_SESSION["descricaoAlteracao"] = "Alterou o nome: ".$res[0]->nome." para ".$data['nome'];

		$_SESSION["idusuario"] = $data["idcadastrador"];

		// altera a pessoa
		$this->db->where('idpessoa', $idpessoa);
		$this->db->update('pessoa', $data);

	}

	public function updatePessoaFisica($idpessoa, $data){
		
		$this->db->where('idpessoa', $idpessoa);
				
		$query = $this->db->get('pessoafisica');
		$res   = $query->result();

		$dataNascimento = implode("/",array_reverse(explode("-",$data['dataNascimento'])));

		if ($data['genero'] == "M")
		{
			$genero = "Masculino";
		
		}else if ($data['genero'] == "F")
		{
			$genero = "Feminino";
		}

		$res[0]->dataNascimento = implode("/",array_reverse(explode("-",$res[0]->dataNascimento)));

		$_SESSION["descricaoAlteracao"] = $_SESSION["descricaoAlteracao"]." Alterou a Data de Nascimento: ".$res[0]->dataNascimento." para ".$dataNascimento." Alterou o CPF: ".$res[0]->cpf." para ".$data['cpf']." Alterou o RG: ".$res[0]->rg." para ".$data['rg']." Alterou o Gênero: ".$res[0]->genero." para ".$genero." Alterou o Esdato Civil: ".$res[0]->estadoCivil." para ".$data['estadoCivil']." Alterou a Profissão: ".$res[0]->profissao." para ".$data['profissao'];	

		// altera a pessoa física
		$this->db->where('idpessoa', $idpessoa);
		$this->db->update('pessoaFisica', $data);
		
	}

	public function updatePessoaJuridica($idpessoa, $data){
		
		$this->db->where('idpessoa', $idpessoa);
				
		$query = $this->db->get('pessoajuridica');
		$res   = $query->result();

		$_SESSION["descricaoAlteracao"] = $_SESSION["descricaoAlteracao"]." Alterou a Razão Social: ".$res[0]->razaoSocial." para ".$data['razaoSocial']." Alterou o CNPJ: ".$res[0]->cnpj." para ".$data['cnpj']." Alterou a Inscrição Estadual: ".$res[0]->inscricaoEstadual." para ".$data['inscricaoEstadual'];

		// altera a pessoa juridica
		$this->db->where('idpessoa', $idpessoa);
		$this->db->update('pessoaJuridica', $data);
		
	}

	public function updateUsuario($idpessoa, $data){
		
		$this->db->where('idpessoa', $idpessoa);
				
		$query = $this->db->get('usuario');
		$res   = $query->result();

		$_SESSION["descricaoAlteracao"] = $_SESSION["descricaoAlteracao"]." Alterou o Usuário: ".$res[0]->usuario." para ".$data['usuario'];

		// altera o usuário
		$this->db->where('idpessoa', $idpessoa);
		$this->db->update('usuario', $data);
		
	}

	public function updateAluno($idpessoa, $data){
		
		$this->db->where('idpessoa', $idpessoa);
				
		$query = $this->db->get('aluno');
		$res   = $query->result();

		$_SESSION["descricaoAlteracao"] = $_SESSION["descricaoAlteracao"]." Alterou o Consultor: ".$res[0]->consultor." para ".$data['consultor']." Alterou o Codigo da Catraca: ".$res[0]->codigoCatraca." para ".$data['codigoCatraca'];


		// altera o aluno
		$this->db->where('idpessoa', $idpessoa);
		$this->db->update('aluno', $data);
		
	}

	public function updateParq_aluno_perguntas_parq($idparq_aluno_perguntas_parq, $data){
		
		$this->db->where('idparq_aluno_perguntas_parq', $idparq_aluno_perguntas_parq);
		$this->db->update('parq_aluno_perguntas_parq', $data);
		return $this->db->affected_rows();
	}

	

	public function updateFuncionario($idpessoa, $data){
		
		$this->db->where('idpessoa', $idpessoa);
		$this->db->update('funcionario', $data);
		return $this->db->affected_rows();
	}

	public function updateFornecedor($idpessoa, $data){
		
		$this->db->where('idpessoa', $idpessoa);
		$this->db->update('fornecedor', $data);
		return $this->db->affected_rows();
	}

	public function updateCidade($idcidade, $data){
		
		$this->db->where('idcidade', $idcidade);
				
		$query = $this->db->get('cidade');
		$res   = $query->result();

		$_SESSION["descricaoAlteracao"] = $_SESSION["descricaoAlteracao"]." Alterou a Cidade: ".$res[0]->cidade." para ".$data['cidade'];
		
		
		// altera a cidade
		$this->db->where('idcidade', $idcidade);
		$this->db->update('cidade', $data);
		
	}	
	
	public function updateEndereco($idendereco, $data){
		
		$this->db->where('idendereco', $idendereco);
				
		$query = $this->db->get('endereco');
		$res   = $query->result();

		$_SESSION["descricaoAlteracao"] = $_SESSION["descricaoAlteracao"]." Alterou a Rua: ".$res[0]->rua." para ".$data['rua']." Alterou o Número: ".$res[0]->numero." para ".$data['numero']." Alterou o Complemento: ".$res[0]->complemento." para ".$data['complemento']." Alterou a Refeência: ".$res[0]->referencia." para ".$data['referencia']." Alterou o Cep: ".$res[0]->cep." para ".$data['cep'];

		// altetao endereço
		$this->db->where('idendereco', $idendereco);
		$this->db->update('endereco', $data);
		
	}	

	public function updateBairro($idbairro, $data){
		
		$this->db->where('idbairro', $idbairro);
				
		$query = $this->db->get('bairro');
		$res   = $query->result();

		$_SESSION["descricaoAlteracao"] = $_SESSION["descricaoAlteracao"]." Alterou o Bairro: ".$res[0]->bairro." para ".$data['bairro'];
		
		// altera o bairro
		$this->db->where('idbairro', $idbairro);
		$this->db->update('bairro', $data);
		
	}	

	public function updateEmail($idemail, $data){
		
		$this->db->where('idemail', $idemail);
				
		$query = $this->db->get('email');
		$res   = $query->result();

		$_SESSION["descricaoAlteracao"] = $_SESSION["descricaoAlteracao"]." Alterou o Email: ".$res[0]->email." para ".$data['email'];

		// altera o email
		$this->db->where('idemail', $idemail);
		$this->db->update('email', $data);
		
	}

	public function updateTelefone($idtelefone, $data){
		
		$this->db->where('idtelefone', $idtelefone);
				
		$query = $this->db->get('telefone');
		$res   = $query->result();

		$_SESSION["descricaoAlteracao"] = $_SESSION["descricaoAlteracao"]." Alterou o Tipo de Telefone: ".$res[0]->tipo." para ".$data['tipo']." Alterou a operadora: ".$res[0]->operadora." para ".$data['operadora']." Alterou o Número: ".$res[0]->telefone." para ".$data['telefone']." Alterou o contato: ".$res[0]->contato." para ".$data['contato'];


		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log 
		$log = array(
			'idusuario'	 => $_SESSION["idusuario"],
			'idtipo_log' => 2,
			'descricao'  => $_SESSION["descricaoAlteracao"],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
						
		// insere na tabela de log com os dados de todas as tabela
		$this->db->insert('log', $log);

		unset($_SESSION["descricaoAlteracao"]);

		// altera o telefone
		$this->db->where('idtelefone', $idtelefone);
		$this->db->update('telefone', $data);
		
	}
	
}
