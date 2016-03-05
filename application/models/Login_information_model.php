<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_information_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_login_information_option($type,$id,$count=10,$offset=0) 
	{
		$this->db->select('login_time');
		$this->db->where($type.'_id',$id);
		$this->db->limit($count,$offset);
		$this->db->order_by('login_time','DESC');
		$query=$this->db->get($type.'_login_information');

		return $query->result_array();
	}
}