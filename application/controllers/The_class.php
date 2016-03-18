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

			// $this->output->enable_profiler(TRUE);

			if($this->type!="class")redirect('');
		}

		public function index()
		{
			$this->login_status_detection();
			$this->load->model('Notification_model');

			$header_data['account']=$this->account;

			$class_notification_array=$this->Notification_model->get_notification('class',3);
			$class_notification['notification']=$class_notification_array;
			$class_notification['notification_target']='班级';

			$main_data['notification']=$this->load->view('template/notification',$class_notification,TRUE);
			$main_data['course_information']=$this->get_course_div();

			$this->load->view('class/header',$header_data);
			$this->load->view('class/main',$main_data);
			$this->load->view('template/footer');
			$this->load->view('class/record_js');
		}

		public function data_entry()
		{
			$this->login_status_detection();

			$header_data['account']=$this->account;

			$data['course_information']=$this->get_course_div();

			$this->load->view('class/header',$header_data);
			$this->load->view('class/check_class_information_record_page',$data);
			$this->load->view('template/footer');
			$this->load->view('class/record_js');
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
				$this->njupt_time->get_week(),
				NULL
			);
		}

		public function data_entry_action()
		{
			$this->login_status_detection();

			$this->load->model('Record_model');
			$this->get_course_now();

			if(empty($this->course_now))
			{
				$data['alert_information']="现在并没有课，你在干嘛呢(｡˘•ε•˘｡)";
				$data['href']="the_class/data_entry";
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
			}	

			$this->load->view('template/alert_and_location_href',$data);
		}

		public function data_query()
		{
			$this->login_status_detection();

			$header_data['account']=$this->account;

			$per_page=$this->input->get('per_page', TRUE);
			if(is_null($per_page))$per_page=1;

			$base_url=current_url();

			$this->load->model('Record_model');
			$this->load->library('table');
			if($this->Record_model->count_record_list($this->type,$this->account)==0)
			{
				$table="<label>抱歉，未查找到本账号录入的查课信息(╯3╰)</label>";
			}
			else
			{
				$template = array('table_open'  => ' <table class="table">');
				$this->table->set_template($template);
				$this->table->set_heading('周数', '课程名称', '教室','任课教师','星期几','应到人数','实到人数','到课率','录入时间');
				$query_result=$this->Record_model->get_record_list($this->type,$this->account,10,($per_page-1)*10);

				foreach ($query_result as $key => $value) 
				{
					$this->table->add_row($value['week'], $value['course_name'], $value['classroom'],$value['tercher_name'],$value['weekday'],$value['choices_number'],$value['real_number'],$value['students_attendance'],$value['recording_time']);
				}

				$table=$this->table->generate();
			}

			$record_data['all_count']=$this->Record_model->count_record_list($this->type,$this->account);
			$record_data['table']=$table;
			$record_data['pagination']=$this->add_pagination($record_data['all_count'],10,3,$base_url);;

			$this->load->view('class/header',$header_data);
			$this->load->view('template/record_data_query',$record_data);
			$this->load->view('template/footer');
		}

		protected function add_pagination($total_rows,$per_page,$num_links,$base_url)
		{
			$this->load->library('pagination');

			$config['base_url'] = $base_url;
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $per_page;
			$config['num_links'] = $num_links;
			$config['use_page_numbers'] = TRUE;
			$config['page_query_string']=TRUE;
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = '首页';
			$config['last_link'] = '尾页';
			$config['next_link'] = '下一页';
			$config['prev_link'] = '上一页';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['attributes']['rel'] = FALSE;

			$this->pagination->initialize($config);

			return $this->pagination->create_links();
		}

		protected function get_course_div()
		{
			$this->get_course_now();

			$data['school_year']=$this->njupt_time->get_school_year();
			$data['term']=$this->njupt_time->get_term();
			$data['odd_even']=$this->njupt_time->get_odd_even();
			$data['class_time']=$this->njupt_time->get_class_time();
			$data['week']=$this->njupt_time->get_week();
			$data['class']=$this->account;

			$data['course']=$this->course_now;

			return $this->load->view('class/course_div',$data,TRUE);

		}

	}