<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Student extends CI_Controller
	{
		
		public function _construct()
		{
			parent::_construct();
		}

		public function index()
		{
			$this->output->enable_profiler(TRUE);

			$this->load->model('Login_model');

			var_dump($this->Login_model->get_user('student_login_information','1') );

			$this->load->view('student/header-sign-in');
			$this->load->view('student/sign-in');
			$this->load->view('student/footer');
		}

		public function main()
		{
			$this->output->enable_profiler(TRUE);

			$this->load->view('student/header');
			$this->load->view('student/main');
			$this->load->view('student/footer');
		}
	}