<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_information_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_login_information_option($type,$id,$count=10,$offset=0) 
	{
		$table_name=$type.'_login_information';

		$this->db->select('@rownum:=@rownum+1 AS rownum', FALSE);
		$this->db->select("$table_name.login_time");
		$this->db->from("(SELECT @rownum:=0) r", FALSE);
		$this->db->from($table_name);
		if($id !== null)
			$this->db->where("$table_name.".$type.'_id',$id);
		$this->db->limit($count,$offset);
		$this->db->order_by("$table_name.login_time",'DESC');
		$query=$this->db->get();

		return $query->result_array();
	}

	public function get_login_information_count($type,$id) 
	{
		$table_name=$type.'_login_information';

		$this->db->select("COUNT(*)");
		$this->db->from($table_name);
		$this->db->where($type.'_id',$id);
		$query=$this->db->get();
		$query=$query->result_array();

		if(!empty($query[0]))
			return $query[0]['COUNT(*)'];
		else
			return "从未登陆";
	}
}