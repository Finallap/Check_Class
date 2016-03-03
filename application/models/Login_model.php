<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_password($type,$id) 
	{
		$this->db->select('password');
		$this->db->where($type.'_id',$id);
		$query=$this->db->get($type.'_information');

		return $query->result_array();

	}

	public function add_login_record($type,$id)
	{
		$data = array(
					    $type.'_id' => $id,
					    'login_time' => date('Y-m-d H:i:s')
					);

		$this->db->insert($type.'_login_information', $data);
	}
}