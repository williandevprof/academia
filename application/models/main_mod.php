<?php 

class Main_mod extends CI_Model{

	// __________ metodos de seleção __________________

	// metodo que pega os dados do usuário logado
	public function getUsuario($idusuario)
    {

    	$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa');
		$this->db->join('pessoaFisica pf','p.idpessoa = pf.idpessoa',   'left');
		$this->db->join('pessoaJuridica pj','p.idpessoa = pj.idpessoa ','left');
		$this->db->join('aluno a','p.idpessoa = a.idpessoa',            'left');
		
		$this->db->join('funcionario func','p.idpessoa = func.idpessoa','left');
		$this->db->join('fornecedor f','p.idpessoa = f.idpessoa',       'left');
		$this->db->join('endereco e','p.idpessoa = e.idpessoa',         'left');
		$this->db->join('bairro b','e.idbairro = b.idbairro' ,          'left');
		$this->db->join('cidade c','b.idcidade = c.idcidade' ,          'left');
		$this->db->join('estado es','c.idestado = es.idestado',         'left');
		$this->db->join('telefone t','p.idpessoa = t.idpessoa',         'left');
		$this->db->join('email em','p.idpessoa = em.idpessoa',          'left');
		
		$this->db->where("u.idusuario", $idusuario);

		$this->db->group_by('u.idusuario');
				
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

	// metodo que irá verificar se tem aluno com ciclo de treino
    // com data expirando hoje
	public function getAlunosCiclos($dataAtual)
	{
		$this->db->where("ac.data_termino", $dataAtual);

		$this->db->where("ac.ativo", 1);
		
		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
				
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
}	