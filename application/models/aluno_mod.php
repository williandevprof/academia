<?php 

class Aluno_mod extends CI_Model{

	// __________ metodos de seleção __________________

	// metodo que pega os alunos para listar
	public function getAlunos()
    {

    	$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa');
		$this->db->join('pessoaFisica pf','p.idpessoa = pf.idpessoa',   'left');
		$this->db->join('pessoaJuridica pj','p.idpessoa = pj.idpessoa ','left');
		$this->db->join('aluno a','p.idpessoa = a.idpessoa');
		
		$this->db->join('endereco e','p.idpessoa = e.idpessoa',         'left');
		$this->db->join('bairro b','e.idbairro = b.idbairro' ,          'left');
		$this->db->join('cidade c','b.idcidade = c.idcidade' ,          'left');
		$this->db->join('estado es','c.idestado = es.idestado',         'left');
		$this->db->join('telefone t','p.idpessoa = t.idpessoa',         'left');
		$this->db->join('email em','p.idpessoa = em.idpessoa',          'left');
		
		
		$this->db->group_by('a.idaluno');
				
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
		$this->db->where("c.idciclo", $cicloTreino->idCiclo);

		$this->db->where("t.idtreino", $cicloTreino->idTreino);

		$this->db->select("*");
		$this->db->from("exercicio as e");
		$this->db->join('exercicio_treino et', 'e.idexercicio = et.exercicio_idexercicio');
		$this->db->join('treino t', 'et.treino_idtreino = t.idtreino');
		$this->db->join('ciclo_treino ct', 't.idtreino = ct.treino_idtreino');
		$this->db->join('ciclo c', 'ct.ciclo_idciclo = c.idciclo');
		$this->db->join('regiao_trabalhada rt', 'e.idregiaoTrabalhada = rt.idregiaoTrabalhada');
		$this->db->join('aparelho a', 'e.idaparelho = a.idaparelho');

		$query = $this->db->get();

		return $query->result();
	}


	// mostra o treino detalhado quando o usuário clica na 
    //grid do visualizar ciclos de treinos
	public function listaExerciciosAluno($cicloTreino)
	{
		$this->db->where("ac.idaluno_ciclo", $cicloTreino->idCiclo);

		$this->db->where("at.idaluno_treino", $cicloTreino->idTreino);

		$this->db->select("*");
		$this->db->from("aluno_exercicio  ae");
		$this->db->join('aluno_treino at', 'ae.idaluno_treino = at.idaluno_treino');
		$this->db->join('aluno_ciclo ac', 'at.idaluno_ciclo = ac.idaluno_ciclo');

		$this->db->order_by("ae.regiaoTrabalhada", "asc");
				
		$query = $this->db->get();

		return $query->result();
	}

	

	// lista os exercicios combinados
	public function listaExerciciosCombinadosAluno($cicloTreino)
	{
		$this->db->where("c.idciclo", $cicloTreino->idCiclo);

		$this->db->select("e.exercicio, e.idexercicio, et.idexercicio_treino");
		$this->db->from('exercicio e');
		$this->db->join('exercicio_combinado ec', 'e.idexercicio = ec.idexercicio');
		$this->db->join('exercicio_treino et', 'ec.idexercicio_treino = et.idexercicio_treino');
		$this->db->join('treino t', 'et.treino_idtreino = t.idtreino');
		$this->db->join('ciclo_treino ct', 't.idtreino = ct.treino_idtreino');
		$this->db->join('ciclo c', 'ct.ciclo_idciclo = c.idciclo');
		
		$query = $this->db->get();

		return $query->result();
	}

	// pega os nomes dos exercicios combinados desse exercicio
	public function getNomeExerciciosCombinados($idexercicio_combinado)
	{
		$this->db->select("*");
		$this->db->from("exercicio_combinado ec");
		$this->db->join('exercicio e', 'ec.idexercicio = e.idexercicio');
				
		$this->db->where("ec.idexercicio_combinado", $idexercicio_combinado);
				
		$query = $this->db->get();

		return $query->result();
	}

	// pega os nomes dos exercicios combinados desse exercicio quando ele for o ultimo
	// la no laço
	public function getNomeExerciciosCombinadosLast($exercicio_idexercicio)
	{
		$this->db->select("*");
		$this->db->from("exercicio_treino et");
		$this->db->join("exercicio_combinado ec", 'et.idexercicio_treino = ec.idexercicio_treino');
		$this->db->join('exercicio e', 'ec.idexercicio = e.idexercicio');
				
		$this->db->where("et.exercicio_idexercicio", $exercicio_idexercicio);
				
		$query = $this->db->get();

		return $query->result();
	}

	
	// pega todos os dados do ciclo
	public function getCicloTreino($idCiclo)
	{
		$this->db->where("c.idciclo", $idCiclo);

		$this->db->select("*");
		$this->db->from("exercicio as e");
		$this->db->join('exercicio_treino et', 'e.idexercicio = et.exercicio_idexercicio');
		$this->db->join('treino t', 'et.treino_idtreino = t.idtreino');
		$this->db->join('ciclo_treino ct', 't.idtreino = ct.treino_idtreino');
		$this->db->join('ciclo c', 'ct.ciclo_idciclo = c.idciclo');
		$this->db->join('regiao_trabalhada rt', 'e.idregiaoTrabalhada = rt.idregiaoTrabalhada');
		$this->db->join('aparelho a', 'e.idaparelho = a.idaparelho');
		$this->db->join('tipo_exercicio te', 'e.idtipoExercicio = te.idtipoExercicio');
		$this->db->join('exercicio_combinado ec', 'et.idexercicio_treino = ec.idexercicio_treino', 'left');

		
		$query = $this->db->get();

		return $query->result();
	}

	public function pesquisarAluno($aluno)
	{

		$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('aluno a','p.idpessoa = a.idpessoa');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa', 'left');
		$this->db->join('pessoaFisica pf','p.idpessoa = pf.idpessoa',   'left');
		$this->db->join('pessoaJuridica pj','p.idpessoa = pj.idpessoa ','left');
		$this->db->join('endereco e','p.idpessoa = e.idpessoa', 'left');
		$this->db->join('bairro b','e.idbairro = b.idbairro' ,  'left');
		$this->db->join('cidade c','b.idcidade = c.idcidade' ,  'left');
		$this->db->join('telefone t','p.idpessoa = t.idpessoa', 'left');
		$this->db->join('email em','p.idpessoa = em.idpessoa',  'left');


		if ($aluno->idaluno)
		{
			$this->db->where('a.idaluno', $aluno->idaluno);
		}

		if ($aluno->dataNascimento)
		{
			$this->db->where('pf.dataNascimento', $aluno->dataNascimento);
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

	// busca os ciclos e carrega a grid de ciclos de treino
	public function pesquisarCicloAluno($idaluno, $idaluno_ciclo, $ciclo)
	{
		if ($idaluno_ciclo)
		{
			$this->db->where('idaluno_ciclo', $idaluno_ciclo);
		}

		if ($ciclo->dataInicio)
		{
			$this->db->where('data_inicio >=', $ciclo->dataInicio);
		}

		if ($ciclo->dataTermino)
		{
			$this->db->where('data_termino <=', $ciclo->dataTermino);
		}
		
		$this->db->where('idaluno', $idaluno);
		
		$query = $this->db->get('aluno_ciclo');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}


	public function autoAluno($buscarAluno)
	{
		$this->db->select('a.idaluno, p.nome');
		$this->db->from('pessoa p');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->like('p.nome', $buscarAluno);
		
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

	public function autoCicloAluno($buscar, $idaluno)
	{
		$this->db->where('idaluno', $idaluno);
		$this->db->like('ciclo', $buscar);
		$query = $this->db->get('aluno_ciclo');
		return $query->result();
	}

	// pega os ciclos de treino do aluno selecionado
	public function getCiclosTreinosAluno($idaluno)
	{
		$this->db->where("a.idaluno", $idaluno);

		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');

		$query = $this->db->get();

		return $query->result();
	}

	// seleciona os treinos do usuario logado e do ciclo selecionado
	public function getTreinos($idaluno, $idaluno_ciclo)
	{
		$this->db->where("a.idaluno", $idaluno);

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
	
	// seleciona os exercicios dos treinos do aluno e do ciclo selecionado
	public function getExerciciosTreinos($idaluno, $idaluno_ciclo, $idaluno_treino)
	{
		$this->db->where("a.idaluno", $idaluno);

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

		return $query->result();
	}


	// lista os novos treinos do novo ciclo adicionado
	// para poderem adicionar os novos exercicios
	public function listaTreinosAluno($idaluno_ciclo)
	{
		$this->db->where("ac.idaluno_ciclo", $idaluno_ciclo);

		$this->db->select("at.treino, at.idaluno_treino, ac.ciclo, ac.nivel, ac.genero, ac.metaPrincipal, ac.modeloCiclo");
		$this->db->from("aluno_treino as at");
		$this->db->join('aluno_ciclo ac', 'at.idaluno_ciclo = ac.idaluno_ciclo');
				
		$query = $this->db->get();

		return $query->result();

	}

	// lista os exericios do treino selecionado
	public function listaNovosExerciciosTreinoAluno($idAluno_treino)
	{
		$this->db->where("idaluno_treino", $idAluno_treino);

		$query = $this->db->get('aluno_exercicio');

		return $query->result();
	}

	// lista os treinos realizados pelo aluno
	public function getTreinosRealizadosAluno($idaluno)
	{
		$this->db->where("a.idaluno", $idaluno);
		
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

	public function autoCiclosRealizados($idaluno, $buscar)
	{
		$this->db->where("a.idaluno", $idaluno);
		
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

	public function pesquisarTreinosRealizados($idaluno, $idaluno_ciclo, $ciclo)
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

		$this->db->where("a.idaluno", $idaluno);
		
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

	public function mostraTreinosRealizadosAluno($idtreino_realizado)
	{
		$this->db->where("tr.idtreino_realizado", $idtreino_realizado);
		
		$this->db->select("*");
		$this->db->from("usuario u");
		$this->db->join('pessoa p', 'u.idpessoa = p.idpessoa');
		$this->db->join('aluno a', 'p.idpessoa = a.idpessoa');
		$this->db->join('aluno_ciclo ac', 'a.idaluno = ac.idaluno');
		$this->db->join('aluno_treino at', 'ac.idaluno_ciclo = at.idaluno_ciclo');
		$this->db->join('treino_realizado tr', 'at.idaluno_treino = tr.idaluno_treino');
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

	public function getTreinosRealizadosAlunoSelecionado($idtreino_realizado)
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

	public function getExerciciosTreinosAlunoSelecionado($idtreino_realizado)
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

	//____________________ Metodos de Adição __________________________//

	public function addAluno_ciclo($data)
	{
		$this->db->insert('aluno_ciclo', $data);
		return $this->db->insert_id();
	}

	public function addAluno_treino($data)
	{
		$this->db->insert('aluno_treino', $data);
		return $this->db->insert_id();
	}

	public function addAluno_exercicio($data)
	{
		$this->db->insert('aluno_exercicio', $data);
		return $this->db->insert_id();
	}

	public function addExercicioTreinoAluno($data)
	{
		$this->db->insert('aluno_exercicio', $data);
		return $this->db->insert_id();
	}

	
	//______________ Metodos de Atualização _____________//

	// atualiza a tabela aluno_exercicio adicionando peso, serie, intervalo
	public function salvarExercicio($idaluno_exercicio, $exercicio)
	{
		$this->db->where('idaluno_exercicio', $idaluno_exercicio);
	    
	    $this->db->set('serie', $exercicio->serie);
	    $this->db->set('repeticao', $exercicio->repeticao);
	    $this->db->set('peso', $exercicio->peso);
	    $this->db->set('intervalo', $exercicio->intervalo);
	    
	    $this->db->update('aluno_exercicio');
	}

	// metodo para fazer update na tabela aluno_exercicio
	// para adicionar exercicios combinados
	public function salvarTreinoCombinadoAluno($idaluno_exercicio, 
			$exercicioExistente, $novoExercicioCombinado)
	{
		$this->db->where('idaluno_exercicio', $idaluno_exercicio);
	    
	    $this->db->set('exercicio', $exercicioExistente." + ".$novoExercicioCombinado);
	    	    
	    $this->db->update('aluno_exercicio');

	    return $idaluno_exercicio;

	}

	// altera o status de ativo do ciclo do aluno
	public function mudarCicloAtivo($idaluno_ciclo, $idaluno)
	{
		// passa o ciclo clicado para ativo
		$this->db->where('idaluno_ciclo', $idaluno_ciclo);
	    
	    $this->db->set('ativo', 1);
	    	    
	    $this->db->update('aluno_ciclo');


	    // passa todos os outros ciclos com exceção do clicado 
	    // para inativo, desde que seja do mesmo aluno clicado
	    // garantindo assim que somente um ciclo do aluno ficará ativo
	    $this->db->where('idaluno', $idaluno);
	    $this->db->where('idaluno_ciclo !=', $idaluno_ciclo);
	    
	    $this->db->set('ativo', 0);
	    	    
	    $this->db->update('aluno_ciclo');
	}

	// deleta um exercicio da tabela de treino do aluno
	public function exluirExercicioTreinoAluno($idaluno_exercicio)
	{
		$this->db->where('idaluno_exercicio', $idaluno_exercicio);
		$this->db->delete('aluno_exercicio'); 
	}
}	