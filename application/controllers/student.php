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

			$this->load->view('login/header-sign-in');
			$this->load->view('login/sign-in');
			$this->load->view('template/footer');

		}

		public function main()
		{
			$this->output->enable_profiler(TRUE);

			$this->load->view('student/header');
			$this->load->view('student/main');
			$this->load->view('template/footer');
		}
	}