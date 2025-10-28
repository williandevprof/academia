<?php 

class Avaliacao_fisica_mod extends CI_Model{

	public function salvarAvaliacao($data)
	{
		$this->db->insert('avaliacao_fisica', $data);
	}

	public function updateAvaliacao($idavaliacao_fisica, $data)
	{
		// seleciona a avaliação física que vai ser alterada no sistema para a tabela de log
		$this->db->where('idavaliacao_fisica', $idavaliacao_fisica);

		$query = $this->db->get('avaliacao_fisica');
		$res   = $query->result();

		// altera a avaliação física 
		$this->db->where('idavaliacao_fisica', $idavaliacao_fisica);
		$this->db->update('avaliacao_fisica', $data);

		// pega a hora atual
		$horaLocal =  date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());

		// pega a data atual
		$data_log = date('Y-m-d'); 

		$data_avaliacao = implode("/",array_reverse(explode("-",$data['data_avaliacao'])));

		$res[0]->data_avaliacao = implode("/",array_reverse(explode("-",$res[0]->data_avaliacao)));

		// array para a tabela de log
		$log = array(
			'idusuario'	 => $data["idcadastrador"],
			'idtipo_log' => 2,
			'descricao'  => "Alterou a Avaliação Física com a data de: ".$res[0]->data_avaliacao." para ".$data_avaliacao.
				", Peso: ".$res[0]->peso." para ".$data['peso'].
				", Altura: ".$res[0]->altura." para ".$data['altura'].
				", Triceps: ".$res[0]->triceps." para ".$data['triceps'].
				", Subescapular: ".$res[0]->subescapular." para ".$data['subescapular'].
				", Supralliaca: ".$res[0]->supralliaca." para ".$data['supralliaca'].
				", Abdomen: ".$res[0]->abdomen." para ".$data['abdomen'].
				", Braço Esqurdo: ".$res[0]->braco_esquerdo." para ".$data['braco_esquerdo'].
				", Braço Direito: ".$res[0]->braco_direito." para ".$data['braco_direito'].
				", Anti-Braço Esquerdo: ".$res[0]->antibraco_esquerdo." para ".$data['antibraco_esquerdo'].
				", Anti-Braço Direito: ".$res[0]->antibraco_direito." para ".$data['antibraco_direito'].
				", Quadril: ".$res[0]->quadril." para ".$data['quadril'].
				", Cintura: ".$res[0]->cintura." para ".$data['cintura'].
				", Pescoço: ".$res[0]->pescoco." para ".$data['pescoco'].
				", Coxa Esquerda: ".$res[0]->coxa_esquerda." para ".$data['coxa_esquerda'].
				", Coxa Direita: ".$res[0]->coxa_direita." para ".$data['coxa_direita'].
				", Perna Esquerda: ".$res[0]->perna_esquerda." para ".$data['perna_esquerda'].
				", Perna Direita: ".$res[0]->perna_direita." para ".$data['perna_direita'].
				", Radio: ".$res[0]->radio." para ".$data['radio'].
				", Fermur: ".$res[0]->femur." para ".$data['femur'].
				", IMC: ".$res[0]->imc." para ".$data['imc'].
				", Percentual de Gordura: ".$res[0]->percentual_gordura." para ".$data['percentual_gordura'].
				", Massa Magra: ".$res[0]->massa_magra." para ".$data['massa_magra'].
				", Massa Gorda: ".$res[0]->massa_gorda." para ".$data['massa_gorda'],
				'data'   => $data_log,
				'hora'   => $hora
			
		);
		
		// insere na tabela de log
		$this->db->insert('log', $log);
	}

	public function listaAvaliacao($idaluno)
	{
		$this->db->where('af.idaluno', $idaluno);

		$this->db->select('*');
		$this->db->from('aluno a');
		$this->db->join('avaliacao_fisica af','a.idaluno = af.idaluno');

		$query = $this->db->get();
		return $query->result();
	}

	public function pesquisarAvaliacao($avaliacao, $idaluno)
	{
		if ($avaliacao->data_avaliacao1) 
		{
			$this->db->where('data_avaliacao >=', $avaliacao->data_avaliacao1);
		}

		if ($avaliacao->data_avaliacao2) 
		{
			$this->db->where('data_avaliacao <=', $avaliacao->data_avaliacao2);
		}
		
		$this->db->where('idaluno', $idaluno);

		$query = $this->db->get('avaliacao_fisica');
		
		return $query->result();
	}

	public function detalharAvaliacao($avaliacao)
	{
		$this->db->where('af.idavaliacao_fisica', $avaliacao->idavaliacao_fisica);

		$this->db->select("*");
		$this->db->from('avaliacao_fisica af');
		$this->db->join('aluno a', 'af.idaluno = a.idaluno');
		$this->db->join('pessoa p', 'a.idpessoa = p.idpessoa');
		$this->db->join('pessoafisica pf', 'p.idpessoa = pf.idpessoa');
		
		$query = $this->db->get();
		
		return $query->result();
	}


}
