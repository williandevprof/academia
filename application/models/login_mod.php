<?php 

class Login_mod extends CI_Model{

  // seleciona todos os usuários do banco para verificar o login
	public function getUsers()
	{
	 		$query = $this->db->get('usuario');

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