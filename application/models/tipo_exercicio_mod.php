<?php 

class Tipo_Exercicio_mod extends CI_Model{

	public function getTiposExercicios()
	{
		$query = $this->db->get('tipo_exercicio');
		return $query->result();
	}

	public function addTipoExercicio($data)
	{
		$this->db->insert('tipo_exercicio', $data);
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 1,
			'descricao'  => "Cadastrou o Tipo de Exercício: ".$data['tipoExercicio'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);

		// insere na tabela de log
		$this->db->insert('log', $log);
	}

	public function updateTipoExercicio($idtipoExercicio, $data)
	{
		// seleciona o tipo de exrcício que vai ser alterado no sistema para a tabela de log
		$this->db->where('idtipoExercicio', $idtipoExercicio);
				
		$query = $this->db->get('tipo_exercicio');
		$res   = $query->result();

		// altera a tabela de tipo de exercício
		$this->db->where('idtipoExercicio', $idtipoExercicio);
		$this->db->update('tipo_exercicio', $data);
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 2,
			'descricao'  => "Alterou o Tipo de Exercício: ".$res[0]->tipoExercicio." para ".$data['tipoExercicio'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
	}

	public function getAparelhoEditar($idtipo)
	{
		$this->db->where('idtipoExercicio', $idtipo);
		$query = $this->db->get('tipo_exercicio');
		return $query->result();
	}

	public function autoTipo($buscarTipoExercicio)
	{
		$this->db->like('tipoExercicio', $buscarTipoExercicio);
		$query = $this->db->get('tipo_exercicio');
		return $query->result();
	}

	public function pesquisarTipoExercicio($tipoExercicio)
	{

		$this->db->select('*');
		$this->db->from('tipo_exercicio t');
		
		if ($tipoExercicio->idtipoExercicio)
		{
			$this->db->where('t.idtipoExercicio', $tipoExercicio->idtipoExercicio);
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
}
