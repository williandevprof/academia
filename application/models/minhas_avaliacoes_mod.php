<?php 

class Minhas_avaliacoes_mod extends CI_Model{

	public function getAvaliacoes($idusuario)
	{
		$this->db->where('u.idusuario', $idusuario);

		$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa');
		$this->db->join('aluno a','p.idpessoa = a.idpessoa');
		$this->db->join('avaliacao_fisica af','a.idaluno = af.idaluno');
				
		$query = $this->db->get();
		
		return $query->result();
	}

	public function pesquisarAvaliacao($avaliacao, $idusuario)
	{
		if ($avaliacao->data_avaliacao1) 
		{
			$this->db->where('data_avaliacao >=', $avaliacao->data_avaliacao1);
		}

		if ($avaliacao->data_avaliacao2) 
		{
			$this->db->where('data_avaliacao <=', $avaliacao->data_avaliacao2);
		}
		
		$this->db->where('u.idusuario', $idusuario);

		$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa');
		$this->db->join('aluno a','p.idpessoa = a.idpessoa');
		$this->db->join('avaliacao_fisica af','a.idaluno = af.idaluno');
				
		$query = $this->db->get();
		
		return $query->result();
	}

}	