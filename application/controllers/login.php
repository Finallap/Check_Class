<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller
	{
		
		public function _construct()
		{
			parent::_construct();
		}

		public function index()
		{
			$this->output->enable_profiler(TRUE);

			$this->load->view('login/header-sign-in');
			$this->load->view('login/sign-in');
			$this->load->view('template/footer');
		}

		public function login_action()
		{
			$this->load->model('Login_model');

			$account = $this->input->post('account', TRUE);
			$password = $this->input->post('password', TRUE);
			$type = $this->input->post('type', TRUE);

			$real_password=$this->Login_model->get_password($type,$account);

			if(!empty($real_password))
				$real_password=$real_password['0']['password'];
					
			if(empty($real_password))
			{
				$data['alert_information']="账号不存在";
				$data['href']="";
			}
				
			elseif ($real_password!=$password) 
			{
				$data['alert_information']="密码不正确";
				$data['href']="";
			}
			elseif($real_password==$password)
			{
				$data['alert_information']="登陆成功";
				$data['href']="";

				$this->Login_model->add_login_record($type,$account);//增加登陆记录

				$session_data = array(
								    'account'  => $account,
								    'type'     =>  $type
								);
				$this->session->set_userdata($session_data);//设置session
			}
			else
			{
				$data['alert_information']="未知错误";
				$data['href']="";	
			}

			$this->load->view('template/alert_and_location_href',$data);
		}

	}