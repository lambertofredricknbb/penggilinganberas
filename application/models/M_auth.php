<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_auth extends CI_Model
{

	public function cek_login($username, $password)
	{
	    $this->db->where('username', $username);
	    $this->db->where('password', md5($password));
	    $result = $this->db->get('tb_user', 1);
	    return $result;
	}

}