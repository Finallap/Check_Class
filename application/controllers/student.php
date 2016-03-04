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

			if($this->session->type!="student")redirect('');

			$this->load->view('student/header');
			$this->load->view('student/main');
			$this->load->view('template/footer');

		}
	}