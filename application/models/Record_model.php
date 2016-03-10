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

	public function get_record_list($account_type=NULL,$account_id=NULL,$count=10,$offset=0)
	{
		$this->db->select("*");
		$this->db->from('check_class_record');

		$this->db->where("account_type",$account_type);
		$this->db->where("account_id",$account_id);

		$this->db->limit($count,$offset);
		$this->db->order_by('recording_time','ASC');
		$query=$this->db->get();
		$query=$query->result_array();

		foreach ($query as $key => $value) 
		{
			$this->db->reset_query();
			$this->db->select("*");
			$this->db->where("course_id",$value["course_id"]);
			$this->db->from('course_information');
			$query1=$this->db->get();
			$query1=$query1->result_array();

			$query[$key]['course_name']=$query1[0]['course_name'];
			$query[$key]['weekday']=$query1[0]['weekday'];
			$query[$key]['classroom']=$query1[0]['classroom'];
			$query[$key]['tercher_name']=$query1[0]['tercher_name'];
			$query[$key]['choices_number']=$query1[0]['choices_number'];
			if(!empty($query1[0]['choices_number']))
				$query[$key]['students_attendance']=$value["real_number"]/$query1[0]['choices_number'];
			else
				$query[$key]['students_attendance']=0;
		}

		return $query;
	}

	public function count_record_list($account_type=NULL,$account_id=NULL)
	{
		$this->db->select("COUNT(*)");
		$this->db->from('check_class_record');
		$this->db->where("account_type",$account_type);
		$this->db->where("account_id",$account_id);

		return $this->db->count_all_results();
	}
}