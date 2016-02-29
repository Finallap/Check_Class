<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_user($table_name,$id) 
	{
		//$this->db->get($table_name);
		//$query = $this->db->get_where($table_name, array('student_id' => $id));
		//return $this->db->get()->row();
		return $this->db->get($table_name);
	}
}