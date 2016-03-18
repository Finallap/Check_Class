<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Change_password extends CI_Controller
	{
		
		public function _construct()
		{
			parent::_construct();
		}

		public function index()
		{
			if($this->session->type==NULL)redirect('');

			$this->load->view('template/change_password');
			$this->load->view('template/footer');
		}


		public function change_password_action()
		{
			$this->load->model('Change_password_model');
			$this->load->model('Login_model');

			$type=$this->session->type;
			$account=$this->session->account;

			$old_password = $this->input->post('old_password', TRUE);
			$new_password = $this->encrypt->encode($this->input->post('password', TRUE));

			$real_password=$this->Login_model->get_password($type,$account);

			if(!empty($real_password))
				$real_password=$this->encrypt->decode($real_password['0']['password']);

			if(empty($real_password))
			{
				$data['alert_information']="账号不存在";
				$data['href']="change_password";
			}	
			elseif ($real_password!=$old_password) 
			{
				$data['alert_information']="原密码不正确";
				$data['href']="change_password";
			}
			elseif($real_password==$old_password)
			{
				$this->Change_password_model->change_password($type,$account,$new_password);

				$after_change_password=$this->Login_model->get_password($type,$account);
				$after_change_password=$after_change_password['0']['password'];

				if($after_change_password==$new_password)
				{
					$data['alert_information']="修改成功";
					$data['href']="";
				}
				else
				{
					$this->Change_password_model->change_password($type,$account,$this->encrypt->encode($real_password));
					$data['alert_information']="修改失败";
					$data['href']="change_password";
				}

			}
			else
			{
				$data['alert_information']="未知错误";
				$data['href']="change_password";	
			}

			$this->load->view('template/alert_and_location_href',$data);
		}
	}