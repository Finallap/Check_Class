<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_information_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_user_name($type,$id) 
	{
		switch ($type) {
			case 'admin':
				return 'admin';
				break;
			case 'teacher':
				{
					$this->db->select($type.'_name');
					$this->db->where($type.'_id',$id);
					$query=$this->db->get($type.'_information');
					$query=$query->result_array();

					return $query[0][$type.'_name'];
				}
				break;
			case 'student':
				{
					$this->db->select($type.'_name');
					$this->db->where($type.'_id',$id);
					$query=$this->db->get($type.'_information');
					$query=$query->result_array();

					return $query[0][$type.'_name'];
				}
				break;
			case 'class':
				return $id;
				break;
			default:
				return '';
				break;
		}
	}

}