<?php 

class Treino_mod extends CI_Model{

	// _________________ Metodos de adição _________________ //

	// adiciona na tabela ciclo
	public function addCiclo($data)
	{
		// insere primeiro na tabela log por causa do retorno obrigatótio do id ciclo inserido

		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 1,
			'descricao'  => "Cadastrou o Ciclo: ".$data['ciclo'].", Nível: ".$data['nivel'].", genero: ".$data['genero'].", Meta: ".$data['metaPrincipal'].", Modelo: ".$data['modeloCiclo'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);

		// insere na tabela ciclo
		$this->db->insert('ciclo', $data);
		return $this->db->insert_id();
	}

	// insere na tabela que faz a ligação entre o treino e o ciclo de treinos
	public function addCiclo_treino($data)
	{
		$this->db->insert('ciclo_treino', $data);
		return $this->db->insert_id();
	}

	// adiciona na tabela treino
	public function addTreino($data)
	{
		$this->db->insert('treino', $data);
		return $this->db->insert_id();
	}
	
	
	// adiciona na tabela que faz a ligação do treino com o exercicio
	public function addExercicioTreino($data)
	{
		// adiciona na tabela de exercicio_treino
		$this->db->insert('exercicio_treino', $data);
		
		// faz o select para pegar o nome do ciclo, do treino e do exercicio adicionado para a tabela de log 
		$this->db->where('et.exercicio_idexercicio', $data["exercicio_idexercicio"]);

		$this->db->where('et.treino_idtreino', $data["treino_idtreino"]);

		$this->db->select('*');
		$this->db->from('ciclo c');
		$this->db->join('ciclo_treino ct', 'c.idciclo = ct.Ciclo_idciclo');
		$this->db->join('treino t', 'ct.treino_idtreino = t.idtreino');
		$this->db->join('exercicio_treino et', 't.idtreino = et.treino_idtreino');
		$this->db->join('exercicio e', 'et.exercicio_idexercicio = e.idexercicio');
		
		$query = $this->db->get();
		
		$cicloTreinoExercio = $query->result();

		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 1,
			'descricao'  => "Cadastrou o Exercicio: ".$cicloTreinoExercio[0]->exercicio.", No Treino: ".$cicloTreinoExercio[0]->treino.", No Ciclo: ".$cicloTreinoExercio[0]->ciclo,
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
	}

	// adiciona na tabela exercicio_combinado
	public function addExercicioCombinado($data)
	{
		$this->db->insert('exercicio_combinado', $data);
		return $this->db->insert_id();
	}

	

	
	// _________________ Metodos de alteração _________________ //
	public function updateCiclo($idciclo, $data)
	{
		
		$this->db->where('idciclo', $idciclo);

		$query = $this->db->get('ciclo');
		$res   = $query->result();

		// altera o ciclo
		$this->db->where('idciclo', $idciclo);
		$this->db->update('ciclo', $data);

		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 2,
			'descricao'  => "Alterou o Ciclo: ".$res[0]->ciclo." para ".$data['ciclo'].", Nível: ".$res[0]->nivel." para ".$data['nivel'].", genero: ".$res[0]->genero." para ".$data['genero'].", Meta: ".$res[0]->metaPrincipal." para ".$data['metaPrincipal'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
	}

	public function updateExercicio($idexercicio, $data)
	{
		$this->db->where('idexercicio', $idexercicio);
		$this->db->update('exercicio', $data);
		return $this->db->affected_rows();
	}

	public function updateTreino($idtreino, $data)
	{
		$this->db->where('idtreino', $idtreino);
		$this->db->update('treino', $data);
		return $this->db->affected_rows();
	}

	// _________________ Metodos de pesquisa _________________ //
	
	public function getCicloEditar($idciclo)
	{
		$this->db->where('idciclo', $idciclo);

		$this->db->select('*');
		$this->db->from('ciclo');
				
		$query = $this->db->get();
		
		return $query->result();
	}




	public function getTreinoEditar($idtreino)
	{
		$this->db->where('idtreino', $idtreino);

		$this->db->select('*');
		$this->db->from('treino');
				
		$query = $this->db->get();
		
		return $query->result();
	}

	public function getExercicioEditar($idexercicio)
	{
		$this->db->where('ex.idexercicio', $idexercicio);

		$this->db->select('*');
		$this->db->from('exercicio ex');
		$this->db->join('tipo_exercicio te', 'ex.idtipoExercicio = te.idtipoExercicio');
		$this->db->join('aparelho a', 'ex.idaparelho = a.idaparelho');
		$this->db->join('regiao_trabalhada rt', 'ex.idregiaoTrabalhada = rt.idregiaoTrabalhada');
		
		$query = $this->db->get();
		
		return $query->result();
	}


	public function getCiclo($idciclo)
	{
		$this->db->where("idciclo", $idciclo);
		$query = $this->db->get("ciclo");

		return $query->result();
	}

	

	// seleciona todos os treinos cadastrados para aquele ciclo selecionado
	public function listaTreino($idciclo)
	{
		$this->db->where("c.idciclo", $idciclo);

		$this->db->select("t.treino, t.idtreino, c.ciclo, c.nivel, c.genero, c.metaPrincipal, c.modeloCiclo");
		$this->db->from("treino as t");
		$this->db->join('ciclo_treino ct', 't.idtreino = ct.treino_idtreino');
		$this->db->join('ciclo c', 'ct.ciclo_idciclo = c.idciclo');
		
		$query = $this->db->get();

		return $query->result();
	}

	// lista os exercicios do treino selecionado
	public function listaExerciciosTreino($cicloTreino)
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

	// lista os exercicios combinados
	public function listaExerciciosCombinados($cicloTreino)
	{
		$this->db->where("c.idciclo", $cicloTreino->idCiclo);

		$this->db->where("t.idtreino", $cicloTreino->idTreino);

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

	
		
	// lista os ciclos
	public function getCiclos()
	{
		$query = $this->db->get("ciclo");

		return $query->result();
	}


	// busca os exercicios e carrega a grid de exercicios
	public function pesquisarExercicio($exercicio)
	{

		$this->db->select('*');
		
		$this->db->from('exercicio ex');
		$this->db->join('tipo_exercicio te', 'ex.idtipoExercicio = te.idtipoExercicio');
		$this->db->join('aparelho a', 'ex.idaparelho = a.idaparelho');
		$this->db->join('regiao_trabalhada rt', 'ex.idregiaoTrabalhada = rt.idregiaoTrabalhada');
		
		if ($exercicio->idexercicio)
		{
			$this->db->where('ex.idexercicio', $exercicio->idexercicio);
		}

		if ($exercicio->idregiaoTrabalhada)
		{
			$this->db->where('rt.idregiaoTrabalhada', $exercicio->idregiaoTrabalhada);
		}
		

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
	public function pesquisarCiclo($ciclo)
	{
		if ($ciclo)
		{
			$this->db->where('ciclo', $ciclo);
		}
				
		$query = $this->db->get('ciclo');
		
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}


	// pega o id do exercicio já cadastrado no sistema que esta selecionado
	// na tabela de treino
	public function getIdExercicio($idexercicio_treino)
	{

		$this->db->where('et.idexercicio_treino', $idexercicio_treino);

		$this->db->select('ex.idexercicio');
		
		$this->db->from('exercicio ex');
		$this->db->join('exercicio_treino et', 'ex.idexercicio = et.exercicio_idexercicio');
		
		$query = $this->db->get();
		
		if($query->num_rows() != 0)
        {
           $row = $query->row();		
           return $row->idexercicio;
        }
        else
        {
           return false;
        }
	}
	
	public function autoCiclo($buscarCiclo)
	{
		$this->db->like('ciclo', $buscarCiclo);
		$query = $this->db->get('ciclo');
		return $query->result();
	}

	// __________ Metodos de exclusão ________________ //

	// metodo para excluir o exercicio do treino
	public function exluirExercicioTreino($idexercicio_treino)
	{
		// faz o select para pegar o nome do exercício que será excluido, de qual treino e ciclo para a tabela de log 
		$this->db->where('et.idexercicio_treino', $idexercicio_treino);

		
		$this->db->select('*');
		$this->db->from('ciclo c');
		$this->db->join('ciclo_treino ct', 'c.idciclo = ct.Ciclo_idciclo');
		$this->db->join('treino t', 'ct.treino_idtreino = t.idtreino');
		$this->db->join('exercicio_treino et', 't.idtreino = et.treino_idtreino');
		$this->db->join('exercicio e', 'et.exercicio_idexercicio = e.idexercicio');
		
		$query = $this->db->get();
		
		$cicloTreinoExercio = $query->result();

		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		session_start();

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $_SESSION["iduser"],
			'idtipo_log' => 3,
			'descricao'  => "Excluiu o Exercicio: ".$cicloTreinoExercio[0]->exercicio.", Do Treino: ".$cicloTreinoExercio[0]->treino.", Do Ciclo: ".$cicloTreinoExercio[0]->ciclo,
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);

		// deleta o exercício da tabela exercicio_treino
		$this->db->where('idexercicio_treino', $idexercicio_treino);
		$this->db->delete('exercicio_treino');
	}

}
