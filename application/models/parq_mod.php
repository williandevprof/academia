<?php 

class Parq_mod extends CI_Model{

	// lista as perguntas para o usuário responder o parq
	public function getPeguntas()
	{
		$query = $this->db->get('perguntas_parq');
		return $query->result();
	}

	// lista as respostas do aluno no parq para evitar 
   //de listar perguntas repetidas
	public function listaRespostasParq($idpessoa)
	{
		$this->db->where('p.idpessoa', $idpessoa);

		$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('aluno a','p.idpessoa = a.idpessoa' );
		$this->db->join('parq_aluno pa','a.idaluno = pa.idaluno');
		$this->db->join('parq_aluno_perguntas_parq pq_aluno_perguntas','pa.idparqAluno = pq_aluno_perguntas.idparqAluno');

		$query = $this->db->get();
		return $query->result();
	}

	public function countPerguntasParq()
	{
		// retorno o numero de linhas da tabela
		return $this->db->count_all('perguntas_parq');
	}


	// metodo para mostrar o parq do aluno em pdf e preencher o text area do cadastro de parq
	public function montarParq()
	{
		$query = $this->db->get('parq');
		
		
	    if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	
	}

	// metodo para mostrar o parq do aluno em pdf
	public function perguntas($idpessoa)
	{
	  			
		$this->db->select('perguntas_parq.pergunta, parq_aluno_perguntas_parq.resposta');
		$this->db->from('pessoa');
		$this->db->join('aluno', 'pessoa.idpessoa = aluno.idpessoa');
		$this->db->join('parq_aluno', 'aluno.idaluno = parq_aluno.idaluno');
		$this->db->join('parq_aluno_perguntas_parq', 'parq_aluno.idparqAluno = parq_aluno_perguntas_parq.idparqAluno');
		$this->db->join('perguntas_parq', 'parq_aluno_perguntas_parq.idperguntaParq = perguntas_parq.idperguntaParq');
					
		$this->db->where('pessoa.idpessoa', $idpessoa);
		
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

	// adiciona uma nova pergunta ao parq
	public function addPergunta($data)
	{
		$this->db->insert('perguntas_parq', $data);
		return $this->db->insert_id();
	}

	public function updatePergunta($idperguntaParq, $data)
	{
		$this->db->where('idperguntaParq', $idperguntaParq);
		$this->db->update('perguntas_parq', $data);
		return $this->db->affected_rows();
	}

	public function deletePergunta($idperguntaParq)
	{
		$this->db->where('idperguntaParq', $idperguntaParq);
		$this->db->delete('perguntas_parq');
		return $this->db->affected_rows();
	}

	// altera a tabela parq que contém o texto
	public function updateTextoParq($data)
	{
		$this->db->where('idparq', 1);
		$this->db->update('parq', $data);
		return $this->db->affected_rows();
	}
}


