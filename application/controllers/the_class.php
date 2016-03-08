<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class The_class extends CI_Controller
	{
		protected $type;
		protected $account;
		protected $course_now;

		public function _construct()
		{
			parent::_construct();
		}

		protected function login_status_detection()
		{
			$this->type=$this->session->type;
			$this->account=$this->session->account;

			$this->output->enable_profiler(TRUE);

			if($this->type!="class")redirect('');
		}

		public function index()
		{
			$this->login_status_detection();

			$header_data['account']=$this->account;

			$this->load->view('class/header',$header_data);
			$this->load->view('class/main');
			$this->load->view('template/footer');
		}

		public function data_entry()
		{
			$this->login_status_detection();

			$header_data['account']=$this->account;

			$this->get_course_now();

			$data['school_year']=$this->njupt_time->get_school_year();
			$data['term']=$this->njupt_time->get_term();
			$data['odd_even']=$this->njupt_time->get_odd_even();
			$data['class_time']=$this->njupt_time->get_class_time();
			$data['week']=$this->njupt_time->get_week();
			$data['class']=$this->account;

			$data['course']=$this->course_now;

			$this->load->view('class/header',$header_data);
			$this->load->view('class/check_class_information_record_page',$data);
			$this->load->view('template/footer');
		}

		protected function get_course_now()
		{
			$this->load->model('Course_information_model');
			$this->course_now=$this->Course_information_model->get_course_id
			(
				$this->njupt_time->get_school_year(),
				$this->njupt_time->get_term(),
				$this->account,
				$this->njupt_time->get_odd_even(),
				$this->njupt_time->get_class_time(),
				date("w"),
				$this->njupt_time->get_week()
			);
		}

		public function data_entry_action()
		{
			$this->login_status_detection();

			$this->load->model('Record_model');
			$this->get_course_now();

			$real_number=$this->input->post('real_number');
			$remark=$this->input->post('remark');

			$school_year=$this->njupt_time->get_school_year();
			$term=$this->njupt_time->get_term();
			$week=$this->njupt_time->get_week();
			$class=$this->account;

			$course_id=$this->course_now[0]['course_id'];

			$select_data = array('school_year' => $school_year,
								'term' => $term,
								'account_type' => $this->type,
								'account_id' => $this->account,
								'week' => $week,
								'course_id' => $course_id
								 );

			if($this->Record_model->exist_record($select_data))
			{
				$data['alert_information']="已经进行过本节课的信息录入，请不要再次尝试录入(｡˘•ε•˘｡)";
				$data['href']="the_class/data_entry";
			}
			else
			{
				$input_data = array('school_year' => $school_year,
									'term' => $term,
									'account_type' => $this->type,
									'account_id' => $this->account,
									'week' => $week,
									'course_id' => $course_id,
									'real_number' => $real_number,
									'recording_time' => date('Y-m-d H:i:s',time()),
									'remark' => $remark
									 );
				$this->Record_model->record_input($input_data);

				$data['alert_information']="信息录入成功！ o(*￣▽￣*)ブ";
				$data['href']="the_class/data_entry";
			}

			$this->load->view('template/alert_and_location_href',$data);
		}

	}