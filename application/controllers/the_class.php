<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class The_class extends CI_Controller
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

			if($this->type!="class")redirect('');

			$header_data['account']=$this->account;

			$this->load->view('class/header',$header_data);
			$this->load->view('class/main');
			$this->load->view('template/footer');
		}

	}