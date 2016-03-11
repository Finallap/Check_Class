<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_notification($type) 
	{
		$this->db->select('@rownum:=@rownum+1 AS rownum', FALSE);
		$this->db->select('notification_information.*');
		$this->db->from("(SELECT @rownum:=0) r", FALSE);
		$this->db->from("notification_information");
		$this->db->where('notification_information.notification_target',$type);
		$this->db->order_by('notification_information.release_time',"DESC");
		$query=$this->db->get();

		return $query->result_array();
	}

	public function add_notification($target,$account,$content) 
	{
		$data = array(
					    'notification_target' => $target,
					    'release_account' => $account,
					    'notification_content' => $content,
					    'release_time' => date('Y-m-d H:i:s',time())
					);

		$this->db->insert('notification_information', $data);
	}
}