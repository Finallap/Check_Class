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

			$data['alert_information']="注销成功！";
			$data['href']="";

			$this->load->view('template/alert_and_location_href',$data);
		}

	}