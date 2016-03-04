<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sign_out extends CI_Controller
	{
		
		public function _construct()
		{
			parent::_construct();
		}

		public function index()
		{
			$this->session->sess_destroy();

			$this->load->view('login/header-sign-in');
			$this->load->view('login/sign-out');
			$this->load->view('template/footer');
		}

	}