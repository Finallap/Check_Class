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
}