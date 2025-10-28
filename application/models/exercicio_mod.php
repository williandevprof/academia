<?php 

class Exercicio_mod extends CI_Model{

	public function verificaTipoExercicio($tipoExercicio)
	{
		$this->db->where('tipoExercicio', $tipoExercicio);
		$query = $this->db->get('tipo_exercicio');

		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	public function verificaRegiaoTrabalhada($regiao)
	{
		$this->db->where('regiaoTrabalhada', $regiao);
		$query = $this->db->get('regiao_trabalhada');

		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	public function verificaAparelho($aparelho)
	{
		$this->db->where('aparelho', $aparelho);
		$query = $this->db->get('aparelho');

		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}
	

	public function addExercicio($data)
	{
		$this->db->insert('exercicio', $data);
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 1,
			'descricao'  => "Cadastrou o Exercicio: ".$data['exercicio'].", Tipo: ".$data['idtipoExercicio'].", Região ".$data['idregiaoTrabalhada'].", Aparelho ".$data['idaparelho'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
		
	}

	public function updateExercicio($idexercicio, $data)
	{
		// seleciona o exercício que vai ser alterado no sistema para a tabela de log
		$this->db->where('idexercicio', $idexercicio);
				
		$query = $this->db->get('exercicio');
		$res   = $query->result();

		// altera o exercício 
		$this->db->where('idexercicio', $idexercicio);
		$this->db->update('exercicio', $data);
		
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 2,
			'descricao'  => "Alterou o Exercicio: ".$res[0]->exercicio." para ".$data['exercicio'].", Tipo: ".$data['idtipoExercicio'].", Região ".$data['idregiaoTrabalhada'].", Aparelho ".$data['idaparelho'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
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

	public function getExercicios()
	{
		$this->db->select('*');
		$this->db->from('exercicio ex');
		$this->db->join('tipo_exercicio te', 'ex.idtipoExercicio = te.idtipoExercicio');
		$this->db->join('aparelho a', 'ex.idaparelho = a.idaparelho');
		$this->db->join('regiao_trabalhada rt', 'ex.idregiaoTrabalhada = rt.idregiaoTrabalhada');

		$this->db->order_by("ex.idexercicio", "asc");
		
		$query = $this->db->get();

		return $query->result();
	}

	

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

	public function autoExercicio($buscarExercicio)
	{
		$this->db->like('exercicio', $buscarExercicio);
		$query = $this->db->get('exercicio');
		return $query->result();
	}

	public function autoExercicioRegiao($buscarExercicioRegiao)
	{
		$this->db->like('regiaoTrabalhada', $buscarExercicioRegiao);
		$query = $this->db->get('regiao_trabalhada');
		return $query->result();
	}

	
}
