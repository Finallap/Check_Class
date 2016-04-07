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

	public function check_account_exist($type,$id)
	{
		switch ($type) 
		{
			case 'admin':
				return TRUE;
				break;
			case 'teacher':
				{
					$this->db->select($type.'_name');
					$this->db->where($type.'_id',$id);
					$query=$this->db->get($type.'_information');
					$query=$query->result_array();

					if($query)return TRUE;
					else return FALSE;
				}
				break;
			case 'student':
				{
					$this->db->select($type.'_name');
					$this->db->where($type.'_id',$id);
					$query=$this->db->get($type.'_information');
					$query=$query->result_array();

					if($query)return TRUE;
					else return FALSE;
				}
				break;
			case 'class':
				{
					$this->db->select($type.'_name');
					$this->db->where($type.'_id',$id);
					$query=$this->db->get($type.'_information');
					$query=$query->result_array();

					if($query)return TRUE;
					else return FALSE;
				}
				break;
			default:
				return FALSE;
				break;
		}
	}

	public function get_user_telephone($type,$id) 
	{
		switch ($type) {
			case 'teacher':
				{
					$this->db->select('telephone');
					$this->db->where($type.'_id',$id);
					$query=$this->db->get($type.'_information');
					$query=$query->result_array();

					return $query[0]['telephone'];
				}
				break;
			case 'student':
				{
					$this->db->select('telephone');
					$this->db->where($type.'_id',$id);
					$query=$this->db->get($type.'_information');
					$query=$query->result_array();

					return $query[0]['telephone'];
				}
				break;
			default:
				return '无';
				break;
		}
	}

}