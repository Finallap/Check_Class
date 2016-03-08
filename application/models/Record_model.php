<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function record_input($input_data) 
	{
		$this->db->insert('check_class_record', $input_data);
	}

	public function exist_record($select_data) 
	{
		$this->db->select('*');
		$this->db->from('check_class_record');

		$this->db->where('school_year',$select_data['school_year']);
		$this->db->where('term',$select_data['term']);
		$this->db->where('account_type',$select_data['account_type']);
		$this->db->where('account_id',$select_data['account_id']);
		$this->db->where('week',$select_data['week']);
		$this->db->where('course_id',$select_data['course_id']);

		$query=$this->db->get();
		$query=$query->result_array();

		if(empty($query))
			return false;
		else
			return true;
	}
}