<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class The_class extends CI_Controller
	{
		
		public function _construct()
		{
			parent::_construct();
		}

		public function index()
		{
			$this->output->enable_profiler(TRUE);

			$this->load->view('class/header');
			$this->load->view('class/main');
			$this->load->view('template/footer');
		}

	}