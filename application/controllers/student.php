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
			$this->load->helper('url');

			$this->load->view('student/header-sign-in');
			$this->load->view('student/sign-in');
			$this->load->view('student/footer');
		}

		public function main()
		{
			$this->load->helper('url');

			$this->load->view('student/header');
			$this->load->view('student/main');
			$this->load->view('student/footer');
		}
	}	