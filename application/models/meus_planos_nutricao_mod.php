<?php 

class Meus_planos_nutricao_mod extends CI_Model{

	public function getPlanos_nutricao($idusuario)
	{
		$this->db->where('u.idusuario', $idusuario);

		$this->db->select('*');
		$this->db->from('aluno a');
		$this->db->join('pessoa p', 'a.idpessoa = p.idpessoa');
		$this->db->join('pessoafisica pf', 'p.idpessoa = pf.idpessoa');
		$this->db->join('usuario u', 'p.idpessoa = u.idpessoa');
		$this->db->join('plano_nutricao pn','a.idaluno = pn.idaluno');
				
		$query = $this->db->get();
		
		return $query->result();
	}

	// pesquisa planos de nutrição de acordo com o que usuário digitar
	public function pesquisarNutricao($nutricao, $idusuario)
	{
		if ($nutricao->data_inicio)
		{
			$this->db->where('data_inicio >=', $nutricao->data_inicio);
		}

		if ($nutricao->data_termino)
		{
			$this->db->where('data_termino <=', $nutricao->data_termino);
		}

		$this->db->where('u.idusuario', $idusuario);

		$this->db->select('*');
		$this->db->from('aluno a');
		$this->db->join('pessoa p', 'a.idpessoa = p.idpessoa');
		$this->db->join('usuario u', 'p.idpessoa = u.idpessoa');
		$this->db->join('plano_nutricao pn','a.idaluno = pn.idaluno');
		
		$query = $this->db->get();

		return $query->result();
	}

}	