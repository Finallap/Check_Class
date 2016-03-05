<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Student extends CI_Controller
	{
		protected $type;
		protected $account;
		
		public function _construct()
		{
			parent::_construct();
		}

		public function index()
		{
			$this->type=$this->session->type;
			$this->account=$this->session->account;

			$this->output->enable_profiler(TRUE);

			if($this->type!="student")redirect('');

			$header_data['account']=$this->account;

			$this->load->model('login_information_model');

			var_dump($this->login_information_model->get_login_information_option($this->type,$this->account,1));

			$this->load->view('student/header',$header_data);
			$this->load->view('student/main');
			$this->load->view('template/footer');

		}
	}