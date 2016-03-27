<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Suggestions extends CI_Controller
	{
		protected $type;
		protected $account;
		protected $user_name;

		public function _construct()
		{
			parent::_construct();
		}

		protected function login_status_detection()
		{
			$this->type=$this->session->type;
			$this->account=$this->session->account;

			$this->load->model('Account_information_model');
			$this->user_name=$this->Account_information_model-> get_user_name($this->type,$this->account);

			if($this->session->type==NULL)redirect('');
			if($this->session->type=='admin')redirect('');
		}

		public function index()
		{
			$this->login_status_detection();

			if($this->input->post('submit', TRUE))
			{
				$this->load->model('Suggestions_model');

				$account_type=$this->type;
				$account=$this->account;
				$suggestions_type=$this->input->post('suggestions_type', TRUE);
				$suggestions_content=$this->input->post('suggestions_content', TRUE);

				$this->Suggestions_model->add_suggestions($account_type,$account,$suggestions_type,$suggestions_content);

				$data['alert_information']="反馈成功！";
				$data['href']="suggestions";

				$this->load->view('template/alert_and_location_href',$data);
			}
			else
			{
				$view_name=$this->type.'/header';
				$header_data['account']=$this->user_name;

				$this->load->view($view_name,$header_data);
				$this->load->view('template/suggestions');
				$this->load->view('template/footer');
			}
		}
	}