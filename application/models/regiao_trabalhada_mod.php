<?php 

class Regiao_Trabalhada_mod extends CI_Model{

	public function getRegioesTrabalhadas()
	{
		$query = $this->db->get('regiao_trabalhada');
		return $query->result();
	}

	public function addRegiaoTrabalhada($data)
	{
		$this->db->insert('regiao_trabalhada', $data);
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 1,
			'descricao'  => "Cadastrou a Trabalhada: ".$data['regiaoTrabalhada'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);

		// insere na tabela de log
		$this->db->insert('log', $log);
	}

	public function updateRegiaoTabalhada($idregiaoTrabalhada, $data)
	{
		// seleciona a região que vai ser alterada no sistema para a tabela de log
		$this->db->where('idregiaoTrabalhada', $idregiaoTrabalhada);
				
		$query = $this->db->get('regiao_trabalhada');
		$res   = $query->result();

		// altera a região trabalhada
		$this->db->where('idregiaoTrabalhada', $idregiaoTrabalhada);
		$this->db->update('regiao_trabalhada', $data);


		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 2,
			'descricao'  => "Alterou a Região Trabalhada: ".$res[0]->regiaoTrabalhada." para ".$data['regiaoTrabalhada'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
		
	}

	public function getRegiaoEditar($idregiaoTrabalhada)
	{
		$this->db->where('idregiaoTrabalhada', $idregiaoTrabalhada);
		$query = $this->db->get('regiao_trabalhada');
		return $query->result();
	}

	public function autoRegiao($buscarRegiaoTrabalhada)
	{
		$this->db->like('regiaoTrabalhada', $buscarRegiaoTrabalhada);
		$query = $this->db->get('regiao_trabalhada');
		return $query->result();
	}

	public function pesquisarRegiaoTrabalhada($regiaoTrabalhada)
	{

		$this->db->select('*');
		$this->db->from('regiao_trabalhada r');
		
		if ($regiaoTrabalhada->idregiaoTrabalhada)
		{
			$this->db->where('r.idregiaoTrabalhada', $regiaoTrabalhada->idregiaoTrabalhada);
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
