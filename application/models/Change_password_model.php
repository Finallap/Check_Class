<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function change_password($type,$id,$password) 
	{
		$data=array('password' => $password);

		$this->db->where($type.'_id',$id);
		$query=$this->db->update($type.'_information',$data);
	}

	public function get_all_user($type)
	{
		$this->db->select($type.'_id');
		$query=$this->db->get($type.'_information');

		return $query->result_array();
	}
}