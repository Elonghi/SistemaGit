<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class usuario extends CI_Model{
	function login($login,$senha){

		$this->db->select('id,nome,login,email,created_at');
		$this->db->from('usuarios');
		$this->db->where('login',$login);
		$this->db->where('senha',$senha);
		
		$query = $this->db->get();
		if($query->num_rows() == 1){
			return $query->result();
		}else{
			return false;
		}
	}
}

?>
