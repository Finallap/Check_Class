<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends CI_Controller
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

			echo $this->njupt_time->get_class_time();

			$this->output->enable_profiler(TRUE);

			if($this->type!="admin")redirect('');

			$header_data['account']=$this->account;

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/main');
			$this->load->view('template/footer');
		}

	}