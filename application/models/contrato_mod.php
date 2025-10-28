<?php 

class Contrato_mod extends CI_Model{

	// adiciona na tabela contrato 
	public function addContrato($data)
	{
		$this->db->insert('contrato', $data);
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 1,
			'descricao'  => "Cadastrou o Contrato: ".$data['nome'].", Texto: ".$data['texto'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
	}

	// altera a tabela contrato
	public function updateContrato($idcontrato, $data)
	{   
		// seleciona o contrato que vai ser alterado no sistema para a tabela de log
		$this->db->where('idcontrato', $idcontrato);
				
		$query = $this->db->get('contrato');
		$res   = $query->result();

		// altera o contrato 
		$this->db->where('idcontrato', $idcontrato);
		$this->db->update('contrato', $data);
		
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 2,
			'descricao'  => "Alterou o Contrato: ".$res[0]->nome." para ".$data['nome'].", Texto: ".$res[0]->texto." para ".$data['texto'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
	}


	// pega o contrato da tabela contrato para gerar o pdf
	public function getContrato($contrato)
	{
		$this->db->where('idcontrato', $contrato->idcontrato);
				
		$query = $this->db->get('contrato');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}


 	// auto complete do campo de busca do contrato
	public function autoContrato($buscarContrato)
	{
		$this->db->like('nome', $buscarContrato);
				
		$query = $this->db->get('contrato');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	// pesquisa um contrato de acordo com os criterios de busca do usuário
	public function pesquisarContrato($contrato)
	{

		if ($contrato->dataContrato1) 
		{
			$this->db->where('dataCadastro >=', $contrato->dataContrato1);
		}

		if ($contrato->dataContrato2) 
		{
			$this->db->where('dataCadastro <=', $contrato->dataContrato2);
		}
		
		$this->db->where('idcontrato =', $contrato->idcontrato);		
		
		$this->db->order_by("idcontrato", "asc");
				
		$query = $this->db->get('contrato');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           $query = $this->db->get('contrato');
           return $query->result();
        }

	}

	// seleciona para listar no campo contrato do formulario do aluno contrato
	public function listarContratos()
	{
		$query = $this->db->get('contrato');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	// seleciona para listar no forma de pagamento do formulario do aluno contrato
	public function listarFormas_pgto()
	{
		$query = $this->db->get('forma_pagamento');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	// seleciona para listar no campo prazo do plano do formulario do aluno contrato
	public function listarPrazos_plano()
	{
		$query = $this->db->get('prazo_plano');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	// seleciona para listar no campo tipo de plano do formulario do aluno contrato
	public function listarTipos_plano()
	{
		$query = $this->db->get('tipo_plano');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	// seleciona para listar no campo modalidade do formulario do aluno contrato
	public function listarModalidades()
	{
		$query = $this->db->get('modalidade');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	// seleciona os contratos do aluno selecionado
	public function listaContratosAluno($pessoa)
	{
		
		$this->db->where('a.idaluno =',  $pessoa->idaluno);

		$this->db->select('*, p.nome pessoa');
		$this->db->from('pessoa p');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_contrato ac', 'a.idaluno = ac.idaluno');
		$this->db->join('contrato c', 'ac.idcontrato = c.idcontrato');
		$this->db->join('tipo_plano tp', 'ac.idtipoPlano = tp.idtipoPlano');
		$this->db->join('modalidade m', 'ac.idmodalidade = m.idmodalidade');
		$this->db->join('forma_pagamento fp', 'ac.idformaPagamento = fp.idformaPagamento');
		$this->db->join('prazo_plano pp', 'ac.idprazoPlano = pp.idprazoPlano');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa',          'left');
		$this->db->join('pessoaFisica pf','p.idpessoa = pf.idpessoa',   'left');
		$this->db->join('pessoaJuridica pj','p.idpessoa = pj.idpessoa ','left');
		$this->db->join('funcionario func','p.idpessoa = func.idpessoa','left');
		$this->db->join('fornecedor f','p.idpessoa = f.idpessoa',       'left');
		$this->db->join('endereco e','p.idpessoa = e.idpessoa',         'left');
		$this->db->join('bairro b','e.idbairro = b.idbairro' ,          'left');
		$this->db->join('cidade cid','b.idcidade = cid.idcidade' ,          'left');
		$this->db->join('estado es','cid.idestado = es.idestado',         'left');
		$this->db->join('telefone t','p.idpessoa = t.idpessoa',         'left');
		$this->db->join('email em','p.idpessoa = em.idpessoa',          'left');

		$this->db->group_by("t.idpessoa"); 
		$this->db->group_by("em.idpessoa");
		$this->db->group_by("e.idpessoa");  

		$query = $this->db->get();
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return $query->num_rows();
        }
	}

	// metodo que busca os valores na tabela valores_planos 
   //conforme o que o usuário escolher no formulario de contrato do aluno
	public function getValores($aluno_contrato)
	{
		$this->db->where('vp.idmodalidade =', $aluno_contrato->modalidade);

		$this->db->where('vp.idprazoPlano =', $aluno_contrato->prazo_plano);

		$this->db->where('vp.idtipoPlano =',  $aluno_contrato->tipo_plano);			
		
		$this->db->select('*');
		$this->db->from('valores_plano vp');
		$this->db->join('tipo_plano tp', 'vp.idtipoPlano = tp.idtipoPlano');
		$this->db->join('prazo_plano pp', 'vp.idprazoPlano = pp.idprazoPlano');
		$this->db->join('modalidade m', 'vp.idmodalidade = m.idmodalidade');

		$query = $this->db->get();
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return $query->num_rows();
        }
	}

	// salva o contrato do aluno na tabela aluno_contrato
	public function salvarAlunoContrato($data)
	{
		$this->db->insert('aluno_contrato', $data);
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// select para pegar o nome do aluno
		$this->db->where('a.idaluno', $data['idaluno']);

		$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');

		$query = $this->db->get();
		
		$aluno = $query->result();

		// select para pegar o nome do contrato
		$this->db->where('idcontrato', $data['idcontrato']);
				
		$query = $this->db->get('contrato');
		
		$contrato = $query->result();

		// select para pegar o nome do tipo de plano
		$this->db->where('idtipoPlano', $data['idtipoPlano']);
				
		$query = $this->db->get('tipo_plano');
		
		$tipoPlano = $query->result();

		// select para pegar o nome da modalidade
		$this->db->where('idmodalidade', $data['idmodalidade']);
				
		$query = $this->db->get('modalidade');
		
		$modalidade = $query->result();

		// select para pegar o nome do prazo plano
		$this->db->where('idprazoPlano', $data['idprazoPlano']);
				
		$query = $this->db->get('prazo_plano');
		
		$prazoPlano = $query->result();

		
		// select para pegar o nome da forma de pagamento
		$this->db->where('idformaPagamento', $data['idformaPagamento']);
				
		$query = $this->db->get('forma_pagamento');
		
		$formaPagamento = $query->result();

		

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 1,
			'descricao'  => "Cadastrou o Contrato: ".$contrato[0]->nome.", Tipo de Plano: ".$tipoPlano[0]->tipoPlano.", Modalidade: ".$modalidade[0]->modalidade.", Prazo do Plano: ".$prazoPlano[0]->prazoPlano.", Forma de Pagamento: ".$formaPagamento[0]->formaPagamento.", Número de Parcelas: ".$data["numeroParcelas"].", Valor das Parcelas: ".$data["valorParcela"].", Valor Total: ".$data["valorTotal"].", Para o(a) aluno: ".$aluno[0]->nome,
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
	}

}	