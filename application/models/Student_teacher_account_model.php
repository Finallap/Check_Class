<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_teacher_account_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function get_user_list($type,$college_id=NULL,$count=10,$offset=0) //获取按条件搜索出的用户列表
	{
		$information_table_name=$type.'_information';
		$college_table_name='college_information';

		$this->db->select("$information_table_name.$type"."_id,$college_table_name.college_name,$information_table_name.$type"."_name");
		$this->db->from("$information_table_name,$college_table_name");

		if(isset($college_id)&&($college_id!=-1))
			$this->db->where("$information_table_name.college_id",$college_id);
		$this->db->where("$information_table_name.college_id=$college_table_name.college_id");

		$this->db->limit($count,$offset);
		$this->db->order_by($information_table_name.'.'.$type.'_id','ASC');
		$query=$this->db->get();
		$query=$query->result_array();

		foreach ($query as $key => $value) 
		{
			$id=$type."_id";
			$query[$key]['last_login_time']=$this->get_login_information_option($type,$value["$id"]);
			$query[$key]['operation']='<a href="'.base_url("admin/operation_$type")."?$id=".$value["$id"].'" class="btn btn-primary"><i class="fa fa-hand-o-right"></i> 操作</a>';
		}

		return $query;
	}

	public function count_user_list($type,$college_id=NULL) //获取按条件搜索出的用户列表的条数
	{
		if(isset($college_id)&&($college_id!=-1))
			$this->db->where("college_id",$college_id);
		$this->db->from($type.'_information');

		return $this->db->count_all_results();
	}

	public function all_count($type) 
	{
		return $this->db->count_all($type.'_information');
	}

	public function get_login_information_option($type,$id) //获取最近一条登陆信息
	{
		$this->db->select('login_time');
		$this->db->where($type.'_id',$id);
		$this->db->limit(1,0);
		$this->db->order_by('login_time','DESC');
		$query=$this->db->get($type.'_login_information');
		$query=$query->result_array();

		if(!empty($query[0]))
			return $query[0]['login_time'];
		else
			return "从未登陆";
	}

	public function add_accout($type,$id,$name,$college_id,$telephone,$password)
	{
		$this->db->select('*');
		$this->db->where($type.'_id',$id);
		$query=$this->db->get($type.'_information');
		$query=$query->result_array();

		if(!empty($query[0]))
			return false;
		else
		{
			$data = array(
						    $type.'_id' => $id,
						    $type.'_name' => $name,
						    'college_id' => $college_id,
						    'telephone' => $telephone,
						    'password' => $password
						);
			$this->db->insert($type.'_information', $data);
			return true;
		}
	}

	public function teacher_get_class_id($id)
	{
		$this->db->select('college_id');
		$this->db->from('teacher_information');
		$this->db->where('teacher_id',$id);
		$query=$this->db->get();
		$query=$query->result_array();

		$college_id=$query[0]['college_id'];

		$this->db->select('class_id');
		$this->db->from('class_information');
		$this->db->where('college_id',$college_id);
		$query=$this->db->get();
		$query=$query->result_array();

		foreach ($query as $key => $value) 
		{
			$id=$value['class_id'];
			$result[$id]=$value['class_id'];
		}

		return $result;
	}

	public function delete_account($type,$id)
	{
		$where_array = array($type.'_id' => $id);
		$this->db->delete($type.'_information', $where_array);
	}

	public function get_grade_list()
	{
		$this->db->select('grade');
		$this->db->from('class_information');
		$this->db->group_by('grade');
		$query=$this->db->get();
		$query=$query->result_array();

		$result = NULL;
		
		foreach ($query as $key => $value)
		{
			$grade=$value['grade'];
			$result[$grade] = $grade.'级';
		}

		return $result;
	}

}