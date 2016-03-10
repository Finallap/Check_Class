<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Teacher extends CI_Controller
	{
		protected $type;
		protected $account;
		protected $user_name;

		public function _construct()
		{
			parent::_construct();
		}

		protected function login_status_detection()
		{
			$this->type=$this->session->type;
			$this->account=$this->session->account;

			$this->load->model('Account_information_model');
			$this->user_name=$this->Account_information_model-> get_user_name($this->type,$this->account);

			$this->output->enable_profiler(TRUE);

			if($this->type!="teacher")redirect('');
		}

		public function index()
		{
			$this->login_status_detection();

			$header_data['account']=$this->user_name;

			$this->load->view('teacher/header',$header_data);
			$this->load->view('teacher/main');
			$this->load->view('template/footer');
		}

		public function data_entry()
		{
			$this->login_status_detection();
			$this->load->model('College_information_model');
			$this->load->model('Student_teacher_account_model');

			$header_data['account']=$this->user_name;

			$college_name=$this->College_information_model->get_user_college_name($this->type,$this->account);
			$all_class=$this->Student_teacher_account_model->teacher_get_class_id($this->account);

			$select_data['name']='class_id';
			$select_data['default_value']='请选择';
			$select_data['details']=$all_class;

			$class_select = $this->load->view('template/select',$select_data, TRUE);

			$data['college_name']=$college_name;
			$data['class_select']=$class_select;

			$this->load->view('teacher/header',$header_data);
			$this->load->view('teacher/teacher_check_class_classid_select',$data);
			$this->load->view('template/footer');
			$this->load->view('teacher/classid_select_js');
		}

	}