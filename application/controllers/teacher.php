<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Teacher extends CI_Controller
	{
		
		public function _construct()
		{
			parent::_construct();
		}

		public function index()
		{
			$this->output->enable_profiler(TRUE);

			if($this->session->type!="teacher")redirect('');

			$this->load->view('teacher/header');
			$this->load->view('teacher/main');
			$this->load->view('template/footer');
		}

	}