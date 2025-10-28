<?php 

class Treinos_realizados_mod extends CI_Model{

	public function getTreinosRealizados($idusuario)
	{
		$this->db->where("u.idusuario", $idusuario);
		
		$this->db->select("*");
		$this->db->from("treino_realizado tr");
		$this->db->join('aluno_treino at', 'tr.idaluno_treino = at.idaluno_treino');
		$this->db->join('aluno_ciclo ac', 'at.idaluno_ciclo = ac.idaluno_ciclo');
		$this->db->join('aluno a', 'ac.idaluno = a.idaluno');
		$this->db->join('pessoa p', 'a.idpessoa = p.idpessoa');
		$this->db->join('usuario u', 'p.idpessoa = u.idpessoa');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function autoCiclosRealizados($idusuario, $buscar)
	{
		$this->db->where("u.idusuario", $idusuario);
		
		$this->db->like('ac.ciclo', $buscar);

		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		$this->db->join('treino_realizado tr', 'at.idaluno_treino = tr.idaluno_treino');

		$this->db->group_by('ac.idaluno_ciclo');
		
		$query = $this->db->get();
		
		return $query->result();
	}

	public function pesquisarTreinosRealizados($idusuario, $idaluno_ciclo, $ciclo)
	{
		if ($idaluno_ciclo)
		{
			$this->db->where("ac.idaluno_ciclo", $idaluno_ciclo);
		}

		if ($ciclo->dataInicio)
		{
			$this->db->where('ac.data_inicio >=', $ciclo->dataInicio);
		}

		if ($ciclo->dataTermino)
		{
			$this->db->where('ac.data_termino <=', $ciclo->dataTermino);
		}

		if ($ciclo->dataTreinoRealizado)
		{
			$this->db->where('tr.data_treino', $ciclo->dataTreinoRealizado);
		}

		$this->db->where("u.idusuario", $idusuario);
		
		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		$this->db->join('treino_realizado tr', 'at.idaluno_treino = tr.idaluno_treino');
				
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

	public function mostraTreinoRealizado($idtreino_realizado)
	{
		$this->db->where("tr.idtreino_realizado", $idtreino_realizado);
		
		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		$this->db->join('treino_realizado tr', 'at.idaluno_treino = tr.idaluno_treino');
				
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

	public function getTreinos($idtreino_realizado)
	{
		$this->db->where("tr.idtreino_realizado", $idtreino_realizado);

		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		$this->db->join('treino_realizado tr', 'at.idaluno_treino = tr.idaluno_treino');
		
		$query = $this->db->get();

		return $query->result();
	}


	public function getExerciciosTreinos($idtreino_realizado)
	{
		$this->db->where("tr.idtreino_realizado", $idtreino_realizado);

		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		$this->db->join('treino_realizado tr', 'at.idaluno_treino = tr.idaluno_treino');
		$this->db->join('exercicio_realizado er', 'tr.idtreino_realizado = er.idtreino_realizado');
		$this->db->join('aluno_exercicio ae', 'er.idaluno_exercicio = ae.idaluno_exercicio');

		$query = $this->db->get();

		return $query->result();
	}
}	