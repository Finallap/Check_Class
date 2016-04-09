<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_teaching_building_number()
	{
		$this->db->select('teaching_building_number');
		$this->db->from('classroom_information');
		$this->db->group_by("teaching_building_number");
		$qurey=$this->db->get();

		return $qurey->result_array();
	}

	public function get_classroom_number()
	{
		$this->db->select('teaching_building_number');
		$this->db->from('classroom_information');
		$this->db->group_by("teaching_building_number");
		$qurey=$this->db->get();
		$qurey=$qurey->result_array();

		$result=array();

		foreach ($qurey as $key => $value) 
		{
			$teaching_building_number=$value['teaching_building_number'];

			$this->db->select('classroom_number');
			$this->db->from('classroom_information');
			$this->db->where("teaching_building_number",$teaching_building_number);
			$qurey=$this->db->get();
			$qurey=$qurey->result_array();

			$result[$teaching_building_number]=$qurey;
		}

		return $result;
	}

	public function get_classroom_list($teaching_building_number = NULL,$classroom_number =NULL)
	{
		$this->db->select('full_number');
		$this->db->from('classroom_information');
		if(($teaching_building_number!=NULL)||($teaching_building_number!=-1))$this->db->where("teaching_building_number",$teaching_building_number);
		if(($classroom_number!=NULL)||($classroom_number!=-1))$this->db->where("classroom_number",$classroom_number);
		$qurey=$this->db->get();
		$qurey=$qurey->result_array();

		return $qurey;
	}
}