<?php 

class Log_mod extends CI_Model{

	public function pesquisarLog($log)
	{

		if ($log->data1) 
		{
			$this->db->where('l.data >=', $log->data1);
		}

		if ($log->data2) 
		{
			$this->db->where('l.data <=', $log->data2);
		}
		
		
		$this->db->select('*');
		$this->db->from('log l');
		$this->db->join('usuario u','l.idusuario = u.idusuario');
		$this->db->join('pessoa p','u.idpessoa = p.idpessoa');

		$this->db->order_by("l.idlog", "asc");
				
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