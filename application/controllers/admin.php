<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends CI_Controller
	{
		
		public function _construct()
		{
			parent::_construct();
		}

		public function index()
		{
			$this->output->enable_profiler(TRUE);

			if($this->session->type!="admin")redirect('');

			$this->load->view('admin/header');
			$this->load->view('admin/main');
			$this->load->view('template/footer');
		}

	}