<?php 

class Valores_planos_mod extends CI_Model{

	public function listarValores_plano()
	{
		$this->db->select('*');
		$this->db->from('valores_plano vp');
		$this->db->join('tipo_plano tp', 'vp.idtipoPlano = tp.idtipoPlano');
		$this->db->join('prazo_plano pp', 'vp.idprazoPlano = pp.idprazoPlano');
		$this->db->join('modalidade m', 'vp.idmodalidade = m.idmodalidade');
		
		$query = $this->db->get();
		
		return $query->result();
	}

	public function salvarValor_plano($data)
	{
		$this->db->insert('valores_plano', $data);
		
		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		// select para pegar o nome da modalidade
		$this->db->where('idmodalidade', $data['idmodalidade']);
				
		$query = $this->db->get('modalidade');
		
		$modalidade = $query->result();

		// select para pegar o nome do prazo plano
		$this->db->where('idprazoPlano', $data['idprazoPlano']);
				
		$query = $this->db->get('prazo_plano');
		
		$prazoPlano = $query->result();

		// select para pegar o nome do tipo de plano
		$this->db->where('idtipoPlano', $data['idtipoPlano']);
				
		$query = $this->db->get('tipo_plano');
		
		$tipoPlano = $query->result();
		

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 1,
			'descricao'  => "Cadastrou o tipo de Plano: ".$tipoPlano[0]->tipoPlano.", Modalidade: ".$modalidade[0]->modalidade.", Prazo do Plano: ".$prazoPlano[0]->prazoPlano.", Valor: ".$data["valor"],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
	}

}