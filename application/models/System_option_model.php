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
}