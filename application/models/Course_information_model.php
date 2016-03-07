<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_information_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_course_id($school_year,$term,$class_id,$odd_even,$class_time,$weekday,$week) 
	{
		$this->db->select("course_information.*");
		$this->db->from("course_information,course_class_information");

		$this->db->where('course_class_information.course_id=course_information.course_id');

		$this->db->where('course_information.school_year',$school_year);
		$this->db->where('course_information.term',$term);
		$this->db->where('course_information.class_time',$class_time);
		$this->db->where('course_information.weekday',$weekday);
		$this->db->where("course_information.start_week<=$week");
		$this->db->where("course_information.end_week>=$week");
		if($odd_even=='even')
			$this->db->where_in('course_information.odd_even',array(0,2));
		else
			$this->db->where_in('course_information.odd_even',array(0,1));

		$this->db->where('course_class_information.class_id',$class_id);
		$this->db->where('course_class_information.school_year',$school_year);
		$this->db->where('course_class_information.term',$term);

		$query=$this->db->get();
		$query=$query->result_array();

		return $query;
	}
}