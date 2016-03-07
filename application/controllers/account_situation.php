<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_situation extends CI_Controller {

	protected $type;
	protected $account;
	protected $user_name;

	protected function login_status_detection()
	{
		$this->type=$this->session->type;
		$this->account=$this->session->account;

		$this->load->model('Account_information_model');
		$this->user_name=$this->Account_information_model-> get_user_name($this->type,$this->account);

		$this->output->enable_profiler(TRUE);

		if(is_null($this->type))redirect('');
		if($this->type=='admin')redirect('');
	}

	public function index()
	{
		$this->login_status_detection();

		$this->load->model('login_information_model');
		$this->load->model('College_information_model');
		$this->load->model('Account_information_model');
		$this->load->library('table');

		$college_name=$this->College_information_model->get_user_college_name($this->type,$this->account);
		$user_name=$this->Account_information_model-> get_user_name($this->type,$this->account);

		$current_login_time=$this->login_information_model->get_login_information_option($this->type,$this->account,1,1);
		$current_login_time=$current_login_time[0]['login_time'];
		$current_login=$this->login_information_model->get_login_information_option($this->type,$this->account);
		$login_count=$this->login_information_model->get_login_information_count($this->type,$this->account);

		$template = array('table_open'  => ' <table class="table">');
		$this->table->set_template($template);
		$this->table->set_heading('#', '登陆时间');
		$table=$this->table->generate($current_login);

		$header_data['account']=$this->user_name;

		$situation_data['account']=$this->account;
		switch ($this->type) {
			case 'admin':
				$situation_data['type']='admin';
				break;
			case 'teacher':
				$situation_data['type']='教师';
				break;
			case 'student':
				$situation_data['type']='查课员';
				break;
			case 'class':
				$situation_data['type']='班级';
				break;
			default:
				$situation_data['type']='';
				break;
		}
		$situation_data['college_name']=$college_name;
		$situation_data['current_login_time']=$current_login_time;
		$situation_data['login_count']=$login_count;
		$situation_data['user_name']=$user_name;
		$situation_data['table']=$table;

		$this->load->view('teacher/header',$header_data);
		$this->load->view('template/account-situation',$situation_data);
		$this->load->view('template/footer');
	}
}
