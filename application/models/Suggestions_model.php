<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suggestions_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function add_suggestions($account_type,$account,$suggestions_type,$suggestions_content)
	{
		$data = array(
						    'suggestions_type' => $suggestions_type,
						    'release_account_type' => $account_type,
						    'release_account' => $account,
						    'suggestions_content' => $suggestions_content,
						    'release_time' => date('Y-m-d H:i:s',time())
						);
		$this->db->insert('suggestions', $data);
	}

	public function get_suggestions($count=10000000,$offset=0)
	{
		$this->db->select('@rownum:=@rownum+1 AS rownum', FALSE);
		$this->db->select('suggestions.*');
		$this->db->from("(SELECT @rownum:=0) r", FALSE);
		$this->db->from("suggestions");
		$this->db->limit($count,$offset);
		$this->db->order_by('suggestions.release_time',"DESC");
		$query=$this->db->get();

		return $query->result_array();
	}

	public function count_suggestions()
	{
		return $this->db->count_all('suggestions');
	}

}