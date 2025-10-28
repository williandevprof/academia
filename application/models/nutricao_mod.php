<?php 

class Nutricao_mod extends CI_Model{

	public function getRefeicoes()
	{
		$query = $this->db->get('refeicao');

		return $query->result();
   	}

   
   	public function addPlano_nutricao($data)
	{
		$this->db->insert('plano_nutricao', $data);
		return $this->db->insert_id();
	}

	public function addRefeicao_plano_nutricao($data)
	{
		$this->db->insert('refeicao_plano_nutricao', $data);
		return $this->db->insert_id();
	}

	public function addAlimento($data)
	{
		$this->db->insert('alimento', $data);
		return $this->db->insert_id();
	}

	public function verificaHorario_refeicao($idplano_nutricao, $idrefeicao)
	{

		$this->db->where("idplano_nutricao", $idplano_nutricao);

		$this->db->where("idrefeicao", $idrefeicao);
		
		$query = $this->db->get('refeicao_plano_nutricao');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }

	}

	// atualiza a grid que mostra o plano de nutrição
	public function getPlano_nutricao($idaluno, $idplano_nutricao)
	{
		$this->db->where("a.idaluno", $idaluno);

		$this->db->where("pn.idplano_nutricao", $idplano_nutricao);

		$this->db->select('*');
		$this->db->from('aluno a');
		$this->db->join('plano_nutricao pn','a.idaluno = pn.idaluno');
		$this->db->join('refeicao_plano_nutricao rpn','pn.idplano_nutricao = rpn.idplano_nutricao');
		$this->db->join('refeicao ref','rpn.idrefeicao = ref.idrefeicao');
		$this->db->join('alimento ali','rpn.idrefeicao_plano_nutricao = ali.idrefeicao_plano_nutricao');

		
		$this->db->order_by("rpn.horario", "asc");
		
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

	
	public function deleteAlimento($plano)
	{
		$this->db->where('idalimento', $plano->idalimento);
		$this->db->delete('alimento');

		$this->db->where('idrefeicao_plano_nutricao', $plano->idrefeicao_plano_nutricao);
		$this->db->delete('refeicao_plano_nutricao');
	}

	// lista os planos de nutrição do aluno selecionado
	public function getPlanosAluno($idaluno)
	{
		$this->db->where('idaluno', $idaluno);
		
		$query = $this->db->get('plano_nutricao');

		return $query->result();
	}

	// pesquisa planos de nutrição de acordo com o que usuário digitar
	public function pesquisarNutricao($nutricao, $idaluno)
	{
		if ($nutricao->data_inicio)
		{
			$this->db->where('data_inicio >=', $nutricao->data_inicio);
		}

		if ($nutricao->data_termino)
		{
			$this->db->where('data_termino <=', $nutricao->data_termino);
		}

		$this->db->where('idaluno', $idaluno);
		
		$query = $this->db->get('plano_nutricao');

		return $query->result();
	}

	// pega informações como aluno e nome do plano de nutrição
	public function detalharPlano_Nutricao($plano)
	{
		$this->db->where("pn.idplano_nutricao", $plano->idplano_nutricao);

		
		$this->db->select('*');
		$this->db->from('aluno a');
		$this->db->join('pessoa p', 'a.idpessoa = p.idpessoa');
		$this->db->join('pessoafisica pf', 'p.idpessoa = pf.idpessoa');
		$this->db->join('plano_nutricao pn','a.idaluno = pn.idaluno');
		
		
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

	// pega dados como refeição horario, alimento
	public function detalharNutricao_Dados($plano)
	{
		$this->db->where("pn.idplano_nutricao", $plano->idplano_nutricao);

		
		$this->db->select('*');
		$this->db->from('aluno a');
		$this->db->join('pessoa p', 'a.idpessoa = p.idpessoa');
		$this->db->join('pessoafisica pf', 'p.idpessoa = pf.idpessoa');
		$this->db->join('plano_nutricao pn','a.idaluno = pn.idaluno');
		$this->db->join('refeicao_plano_nutricao rpn','pn.idplano_nutricao = rpn.idplano_nutricao');
		$this->db->join('refeicao ref','rpn.idrefeicao = ref.idrefeicao');
		$this->db->join('alimento ali','rpn.idrefeicao_plano_nutricao = ali.idrefeicao_plano_nutricao');

		
		$this->db->order_by("rpn.horario", "asc");
		
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

	public function updatePlano_nutricao($data, $idplano_nutricao)
	{
		$this->db->where('idplano_nutricao', $idplano_nutricao);
		$this->db->update('plano_nutricao', $data);
		return $this->db->affected_rows();
	}

	public function updateRefeicao_plano_nutricao($data, $idrefeicao_plano_nutricao)
	{
		$this->db->where('idrefeicao_plano_nutricao', $idrefeicao_plano_nutricao);
		$this->db->update('refeicao_plano_nutricao', $data);
		return $this->db->affected_rows();
	}

	public function updateAlimento($data, $idrefeicao_plano_nutricao)
	{
		$this->db->where('idrefeicao_plano_nutricao', $idrefeicao_plano_nutricao);
		$this->db->update('alimento', $data);
		return $this->db->affected_rows();
	}

	

}	