<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_information_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_course_id($school_year,$term,$class_id,$odd_even,$class_time,$weekday,$week,$classroom) 
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
		if(!empty($classroom))$this->db->where('course_information.classroom',$classroom);
		if($odd_even=='even')
			$this->db->where_in('course_information.odd_even',array(0,2));
		else
			$this->db->where_in('course_information.odd_even',array(0,1));

		if(!empty($class_id))$this->db->where('course_class_information.class_id',$class_id);
		$this->db->where('course_class_information.school_year',$school_year);
		$this->db->where('course_class_information.term',$term);

		$query=$this->db->get();
		$query=$query->result_array();

		if(empty($query))
			return $query;
		else
		{
			$course_id=$query[0]['course_id'];
			$class_array=$this->get_all_class_id($school_year,$term,$course_id);
			$class_list=NULL;
			foreach ($class_array as $key => $value) 
			{
				$class_list.=$value['class_id'].",";
			}
			$class_list=substr($class_list, 0, -1);
			$query[0]['class_list']=$class_list;
			return $query;
		}
	}

	public function get_all_class_id($school_year,$term,$course_id)
	{
		$this->db->select('class_id');
		$this->db->from('course_class_information');
		$this->db->where('school_year',$school_year);
		$this->db->where('term',$term);
		$this->db->where('course_id',$course_id);

		$query=$this->db->get();
		$query=$query->result_array();

		return $query;
	}

	public function get_course_list($school_year,$term,$classroom_array = NULL,$count = NULL,$offset = NULL)
	{
		$this->db->select('*');
		$this->db->from('course_information');
		$this->db->where('school_year',$school_year);
		$this->db->where('term',$term);
		if($classroom_array)
		{
			$where_in_array = NULL;
			foreach ($classroom_array as $key => $value)
			{
				$where_in_array[] = $value['full_number'];
			}
			$this->db->where_in('classroom',$where_in_array);
		}

		$this->db->limit($count,$offset);
		$query=$this->db->get();
		$query=$query->result_array();

		$result = NULL;
		foreach ($query as $key => $value)
		{
			$temp = NULL;
			$temp['classroom'] = $value['classroom'];
			$temp['weekday'] = $this->weekday_chinese($value['weekday']);
			$temp['class_time'] = '第'.$value['class_time'].'大节';
			$temp['course_name'] = $value['course_name'];
			$temp['tercher_name'] = $value['tercher_name'];
			$temp['choices_number'] = $value['choices_number'];
			$temp['operation'] = '<a href="'.base_url("admin/change_course_information_middleware")."?course_id=".$value['course_id'].'" class="btn btn-primary"><i class="fa fa-hand-o-right"></i> 操作</a>';
			$result[] = $temp;
		}

		return $result;
	}

	public function count_course_list($school_year,$term,$classroom_array = NULL)
	{
		$this->db->select('*');
		$this->db->from('course_information');
		$this->db->where('school_year',$school_year);
		$this->db->where('term',$term);
		if($classroom_array)
		{
			$where_in_array = NULL;
			foreach ($classroom_array as $key => $value)
			{
				$where_in_array[] = $value['full_number'];
			}
			$this->db->where_in('classroom',$where_in_array);
		}

		return $this->db->count_all_results();
	}

	protected function weekday_chinese($weekday)
	{
		switch ($weekday) {
			case '1':
				return "周一";
				break;
			case '2':
				return "周二";
				break;
			case '3':
				return "周三";
				break;
			case '4':
				return "周四";
				break;
			case '5':
				return "周五";
				break;
			case '6':
				return "周六";
				break;
			case '0':
				return "周日";
				break;
			default:
				return "周日";
				break;
		}
	}

	public function get_course_information($course_id)
	{
		$this->db->select('*');
		$this->db->from('course_information');
		$this->db->where('course_id',$course_id);
		$query=$this->db->get();
		$query=$query->result_array();

		if($query)
			return $query[0];
		else
			return NULL;
	}

	public function update_course_information($course_id,$choices_number)
	{
		$data=array('choices_number' => $choices_number);

		$this->db->where('course_id',$course_id);
		$query=$this->db->update('course_information',$data);
	}
}