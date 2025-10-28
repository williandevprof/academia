<?php 

class Usuario_mod extends CI_Model{

	// __________ metodos de seleção __________________

	// metodo que pega os usuarios para listar
	public function getUsuarios()
    {

    	$this->db->select('*');
		$this->db->from('pessoa p');
		$this->db->join('pessoafisica pf','p.idpessoa = pf.idpessoa', 'left');
		$this->db->join('pessoajuridica pj','p.idpessoa = pj.idpessoa'
			, 'left');
		$this->db->join('usuario u','p.idpessoa = u.idpessoa');
		$this->db->join('funcionario f','p.idpessoa = f.idpessoa');
		$this->db->join('endereco end','p.idpessoa = end.idpessoa');
		$this->db->join('bairro b','end.idbairro = b.idbairro');
		$this->db->join('cidade c','b.idcidade = c.idcidade');
		$this->db->join('email em','p.idpessoa = em.idpessoa');
		$this->db->join('telefone t','p.idpessoa = t.idpessoa');

		$this->db->group_by("u.idusuario"); 
				
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

	public function getPermissoes($idusuario)
	{
		
		$this->db->where('up.idusuario', $idusuario);

		$this->db->select('*');
		$this->db->from('permissao p');
		$this->db->join('usuario_permissao up','p.idpermissao = up.idpermissao');

		$this->db->order_by("p.idpermissao", "asc");
		
		$query = $this->db->get();
		
		// se tiver permissões desse usuario na tabela usuario_permissao, pega as permissões dessa tabela, caso contrario pega da tabela permissao 
		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else 
        {
           $query = $this->db->get('permissao');
		   return $query->result();
        }
   	}

	
	public function autoPermissao($permissao)
	{
		$this->db->select('idpermissao, permissao');
		$this->db->from('permissao');
		$this->db->like('permissao', $permissao);
		
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

	public function pesquisarPermissao($idpermissao)
	{
		if ($idpermissao)
		{
			$this->db->where('idpermissao', $idpermissao);
		}	
		
		$query = $this->db->get('permissao');

		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}

	

	public function verificaUsuarioPermissaoExiste($idusuario)
	{

		$this->db->where('idusuario',   $idusuario);
				
		$query = $this->db->get('usuario_permissao');

		if($query->num_rows() != 0)
        {
           return $query->result();
        }
        else
        {
           return false;
        }
	}


	public function getLinhasPermissao()
	{
		$query = $this->db->get('permissao');

		return $query->num_rows();
   	}

   	public function insertPermissõesUsuario($data)
   	{
   		$this->db->insert('usuario_permissao', $data);
		return $this->db->insert_id();
   	}

	
	public function updatePermissao($idusuario, $idpermissao, $data)
	{
		$this->db->where('idusuario',   $idusuario);
		$this->db->where('idpermissao', $idpermissao);
		
		$this->db->update('usuario_permissao', $data);
		return $this->db->affected_rows();
	}
	
}	