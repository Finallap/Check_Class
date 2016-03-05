<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Teacher extends CI_Controller
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

			if($this->type!="teacher")redirect('');

			$header_data['account']=$this->account;

			$this->load->view('teacher/header',$header_data);
			$this->load->view('teacher/main');
			$this->load->view('template/footer');
		}

	}