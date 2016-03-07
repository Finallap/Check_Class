<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class College_information_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_college_information() 
	{
		$this->db->select('*');
		$query=$this->db->get('college_information');

		$query=$query->result_array();

		$result=array();

		foreach ($query as $key => $value) {
			$id=$value['college_id'];

			$result[$id]=$value['college_name'];
		}

		return $result;
	}

	public function get_user_college_name($type,$id)
	{
		$table_name=$type.'_information';

		$this->db->select("college_information.college_name");
		$this->db->from("$table_name,college_information");
		$this->db->where("$table_name.".$type.'_id',$id);
		$this->db->where("$table_name.college_id=college_information.college_id");
		$query=$this->db->get();
		$query=$query->result_array();

		return $query[0]['college_name'];
	}
}