<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Teacher extends CI_Controller
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

			$this->output->enable_profiler(TRUE);

			if($this->type!="teacher")redirect('');
		}

		public function index()
		{
			$this->login_status_detection();
			$this->load->model('Notification_model');

			$header_data['account']=$this->user_name;

			$teacher_notification_array=$this->Notification_model->get_notification('teacher',3);
			$teacher_notification['notification']=$teacher_notification_array;
			$teacher_notification['notification_target']='教师';
			$main_data['notification']=$this->load->view('template/notification',$teacher_notification,TRUE);


			$this->load->view('teacher/header',$header_data);
			$this->load->view('teacher/main',$main_data);
			$this->load->view('template/footer');
		}

		public function data_entry()
		{
			$this->login_status_detection();
			$this->load->model('College_information_model');
			$this->load->model('Student_teacher_account_model');

			$header_data['account']=$this->user_name;

			$college_name=$this->College_information_model->get_user_college_name($this->type,$this->account);
			$all_class=$this->Student_teacher_account_model->teacher_get_class_id($this->account);

			$select_data['name']='class_id';
			$select_data['default_value']='请选择';
			$select_data['details']=$all_class;

			$class_select = $this->load->view('template/select',$select_data, TRUE);

			$data['college_name']=$college_name;
			$data['class_select']=$class_select;

			$this->load->view('teacher/header',$header_data);
			$this->load->view('teacher/teacher_check_class_classid_select',$data);
			$this->load->view('template/footer');
			$this->load->view('teacher/classid_select_js');
		}

		public function data_entry_middleware()
		{
			$this->login_status_detection();

			$class_id=$this->input->post('class_id');

			$header_data['account']=$this->user_name;

			$this->get_course_now($class_id);

			$data['school_year']=$this->njupt_time->get_school_year();
			$data['term']=$this->njupt_time->get_term();
			$data['odd_even']=$this->njupt_time->get_odd_even();
			$data['class_time']=$this->njupt_time->get_class_time();
			$data['week']=$this->njupt_time->get_week();
			$data['class_id']=$class_id;

			$data['course']=$this->course_now;

			$this->load->view('teacher/header',$header_data);
			$this->load->view('teacher/record_entry',$data);
			$this->load->view('template/footer');
		}

		protected function get_course_now($class_id)
		{
			$this->load->model('Course_information_model');
			$this->course_now=$this->Course_information_model->get_course_id
			(
				$this->njupt_time->get_school_year(),
				$this->njupt_time->get_term(),
				$class_id,
				$this->njupt_time->get_odd_even(),
				$this->njupt_time->get_class_time(),
				date("w"),
				$this->njupt_time->get_week(),
				NULL
			);
		}

		public function data_entry_action()
		{
			$this->login_status_detection();

			$this->load->model('Record_model');

			$class_id=$this->input->post('class_id');
			$this->get_course_now($class_id);

			if(empty($this->course_now))
			{
				$data['alert_information']="现在这班级并没有课，你在干嘛呢(｡˘•ε•˘｡)";
				$data['href']="teacher/data_entry";
			}
			else
			{
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
					$data['href']="teacher/data_entry";
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
					$data['href']="teacher/data_entry";
				}
			}	

			$this->load->view('template/alert_and_location_href',$data);
		}


		public function data_query()
		{
			$this->login_status_detection();

			$header_data['account']=$this->user_name;

			$this->load->view('teacher/header',$header_data);
			$this->load->view('teacher/data_query');
			$this->load->view('template/footer');
		}
	}