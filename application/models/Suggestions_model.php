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

}