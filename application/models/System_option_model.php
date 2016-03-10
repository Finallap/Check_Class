<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_option_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_system_option() 
	{
		$this->db->select('*');
		$query=$this->db->get('system_option');

		$result=$query->result_array();

		if($result)
			return $result['0'];
	}

	public function update_system_option($school_year,$term,$start_day)
	{
		if(!empty($school_year))$this->db->set('school_year', $school_year);
		if(!empty($term))$this->db->set('term', $term);
		if(!empty($start_day))$this->db->set('start_day', $start_day);
		$this->db->update('system_option');
	}
}