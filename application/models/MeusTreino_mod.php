<?php 

class MeusTreino_mod extends CI_Model{

	//___________ Metodos de Seleção ________________//

	// seleciona os ciclos dos treinos do usuario logado
	public function getCiclosTreinos($idusuario)
	{
		$this->db->where("u.idusuario", $idusuario);

		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');

		$query = $this->db->get();

		return $query->result();
	}	


	// seleciona os treinos do usuario logado e do ciclo selecionado
	public function getTreinos($idusuario, $idaluno_ciclo)
	{
		$this->db->where("u.idusuario", $idusuario);

		$this->db->where("ac.idaluno_ciclo", $idaluno_ciclo);

		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		
		$query = $this->db->get();

		return $query->result();
	}

	// seleciona os exercicios dos treinos do usuario logado e do ciclo selecionado
	public function getExerciciosTreinos($idusuario, $idaluno_ciclo, $idaluno_treino)
	{
		$this->db->where("u.idusuario", $idusuario);

		$this->db->where("ac.idaluno_ciclo", $idaluno_ciclo);

		$this->db->where("at.idaluno_treino", $idaluno_treino);

		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		$this->db->join('aluno_exercicio ae', 'at.idaluno_treino = ae.idaluno_treino');

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

	// lista todos os exercicios do ciclo e do treino selecionado
	public function listaExerciciosTreinoAluno($cicloTreino)
	{
		$this->db->where("ac.idaluno_ciclo", $cicloTreino->idCiclo);

		$this->db->where("at.idaluno_treino", $cicloTreino->idTreino);

		$this->db->select("*");
		$this->db->from("aluno_exercicio  ae");
		$this->db->join('aluno_treino at', 'ae.idaluno_treino = at.idaluno_treino');
		$this->db->join('aluno_ciclo ac', 'at.idaluno_ciclo = ac.idaluno_ciclo');
		
		$query = $this->db->get();

		return $query->result();
	}

	
	// busca os ciclos e carrega a grid de ciclos de treino
	public function pesquisarMeusCiclos($idusuario, $idaluno_ciclo, $ciclo)
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

		$this->db->where("u.idusuario", $idusuario);
		
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

	public function autoMeusCiclos($idusuario, $buscar)
	{
		$this->db->where("u.idusuario", $idusuario);
		
		$this->db->like('ac.ciclo', $buscar);

		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
		
		$query = $this->db->get();
		
		return $query->result();
	}

}	
