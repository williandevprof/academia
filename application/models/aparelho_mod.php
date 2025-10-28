<?php 

class Aparelho_mod extends CI_Model{

	public function getAparelhos()
	{
		$query = $this->db->get('aparelho');
		return $query->result();
	}

	public function addAparelho($data)
	{
		$this->db->insert('aparelho', $data);
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 1,
			'descricao'  => "Cadastrou o Aparelho: ".$data['aparelho']." Número ".$data['numero'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);

		// insere na tabela de log
		$this->db->insert('log', $log);
	}

	public function updateAparelho($idaparelho, $data)
	{
		// seleciona o aparelho que vai ser alterado no sistema para a tabela de log
		$this->db->where('idaparelho', $idaparelho);
				
		$query = $this->db->get('aparelho');
		$res   = $query->result();

		// altera o aparelho
		$this->db->where('idaparelho', $idaparelho);
		$this->db->update('aparelho', $data);

		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 2,
			'descricao'  => "Alterou o Aparelho: ".$res[0]->aparelho." para ".$data['aparelho']." Número ".$res[0]->numero." para ".$data['numero'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
	
	}

	public function getAparelhoEditar($idaparelho)
	{
		$this->db->where('idaparelho', $idaparelho);
		$query = $this->db->get('aparelho');
		return $query->result();
	}

	public function autoAparelho($buscarAparelho)
	{
		$this->db->like('aparelho', $buscarAparelho);
		$query = $this->db->get('aparelho');
		return $query->result();
	}

	public function pesquisarAparelho($aparelho)
	{

		$this->db->select('*');
		$this->db->from('aparelho a');
		
		if ($aparelho->idaparelho)
		{
			$this->db->where('a.idaparelho', $aparelho->idaparelho);
		}

		if ($aparelho->numero)
		{
			
			$this->db->where('a.numero', $aparelho->numero);
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
