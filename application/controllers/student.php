<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Student extends CI_Controller
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

			if($this->type!="student")redirect('');
		}

		public function index()
		{
			$this->login_status_detection();

			$header_data['account']=$this->user_name;

			$this->load->view('student/header',$header_data);
			$this->load->view('student/main');
			$this->load->view('template/footer');

		}
	}