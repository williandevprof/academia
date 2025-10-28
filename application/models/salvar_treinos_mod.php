<?php 

class Salvar_Treinos_mod extends CI_Model{

	//___________ Metodos de Seleção ________________//

	// seleciona o ciclo de treino ativo para o aluno poder salvar
	// o treino que irá realizar
	public function getCicloAtivo($idusuario)
	{
		$this->db->where("u.idusuario", $idusuario);
		$this->db->where("ac.ativo", 1);

		$this->db->select("*");
		$this->db->from("aluno_ciclo ac");
		$this->db->join('aluno a', 'ac.idaluno = a.idaluno');
		$this->db->join('pessoa p', 'a.idpessoa = p.idpessoa');
		$this->db->join('usuario u', 'p.idpessoa = u.idpessoa');
		
		$query = $this->db->get();

		return $query->result();
	}	

	public function getTreinoAtivo($idusuario)
	{
		$this->db->where("u.idusuario", $idusuario);
		$this->db->where("ac.ativo", 1);

		$this->db->select("*");
		$this->db->from("aluno_ciclo ac");
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		$this->db->join('aluno a', 'ac.idaluno = a.idaluno');
		$this->db->join('pessoa p', 'a.idpessoa = p.idpessoa');
		$this->db->join('usuario u', 'p.idpessoa = u.idpessoa');
		
		$query = $this->db->get();

		return $query->result();
	}	

	public function getExerciciosTreinoAtivo($idusuario, $idaluno_treino)
	{
		$this->db->where("u.idusuario", $idusuario);

		$this->db->where("at.idaluno_treino", $idaluno_treino);
		
		$this->db->where("ac.ativo", 1);

		$this->db->select("*");
		$this->db->from("aluno_ciclo ac");
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		$this->db->join('aluno_exercicio ae', 'at.idaluno_treino = ae.idaluno_treino');
		$this->db->join('aluno a', 'ac.idaluno = a.idaluno');
		$this->db->join('pessoa p', 'a.idpessoa = p.idpessoa');
		$this->db->join('usuario u', 'p.idpessoa = u.idpessoa');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function selecionarTreino($idaluno_treino)
	{
		$this->db->where("at.idaluno_treino", $idaluno_treino);
		
		$this->db->select("*");
		
		$this->db->from('aluno_treino at');
			
		$query = $this->db->get();

		return $query->result();
	}

	// salva os treinos realizados pelo aluno
	public function salvarTreinoSelecionado($data)
	{
		$this->db->insert('treino_realizado', $data);
		return $this->db->insert_id();
	}	

	// salva os exercicios realizados pelo aluno
	public function salvarExercicioRealizado($data)
	{
		$this->db->insert('exercicio_realizado', $data);
		return $this->db->insert_id();
	}
}	