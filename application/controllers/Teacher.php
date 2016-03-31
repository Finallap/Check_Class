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

			// $this->output->enable_profiler(TRUE);

			if($this->type!="teacher")redirect('');
		}

		public function index()
		{
			$this->login_status_detection();
			$this->load->model('Notification_model');
			$this->load->model('Record_model');

			$header_data['account']=$this->user_name;

			$teacher_notification_array=$this->Notification_model->get_notification('teacher',3);
			$teacher_notification['notification']=$teacher_notification_array;
			$teacher_notification['notification_target']='教师';
			$main_data['notification']=$this->load->view('template/notification',$teacher_notification,TRUE);

			$today_data_count = $this->Record_model->record_query_count($this->account,$this->njupt_time->get_school_year(),$this->njupt_time->get_term(),date("Y-m-d"),date("Y-m-d"),-1);
			$lowest_ranking_array=$this->Record_model->lowest_ranking($this->account,$this->njupt_time->get_school_year(),$this->njupt_time->get_term(),date("Y-m-d"),date("Y-m-d"),-1);
			$lowest_ranking['today_data_count']=$today_data_count;
			$lowest_ranking['course_list']=$lowest_ranking_array;
			$main_data['today_data_count']=$today_data_count;
			$main_data['lowest_ranking']=$this->load->view('template/lowest_ranking',$lowest_ranking,TRUE);


			$pie_chart_data['chart_id'] = 'container';
			$pie_chart_data['title'] = '到课率统计图';
			$pie_chart_data['name'] = '到课率统计';
			$pie_chart_data['data_array'] = $this->index_count_class_rate_array($lowest_ranking_array);

			$this->load->view('teacher/header',$header_data);
			$this->load->view('teacher/main',$main_data);
			$this->load->view('template/footer');
			$this->load->view('template/pie_chart',$pie_chart_data);
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
			$this->load->model('Record_model');
			$this->load->model('Student_teacher_account_model');

			$header_data['account']=$this->user_name;

			if($this->input->get('start_day'))$start_day=$this->input->get('start_day', TRUE);else$start_day=NULL;
			if($this->input->get('end_day'))$end_day=$this->input->get('end_day', TRUE);else$end_day=NULL;
			if($this->input->get('grade'))$grade=$this->input->get('grade', TRUE);else$grade='-1';
			$per_page=$this->input->get('per_page', TRUE);
			if(is_null($per_page))$per_page=1;

			$start_time=strtotime($start_day);
			$end_time=strtotime($end_day);
			if($start_time>$end_time){$temp=$start_day;$start_day=$end_day;$end_day=$temp;}

			if($this->input->get('start_day'))
				$data['start_day'] = $start_day;
			else
				$data['start_day'] = date("Y-m-d",strtotime("-1 week"));

			if($this->input->get('end_day'))
				$data['end_day'] = $end_day;
			else
				$data['end_day'] = date("Y-m-d");

			$select_data['name']='grade';
			$select_data['default_value']='——请选择——';
			$select_data['details']=$this->Student_teacher_account_model->get_grade_list();
			$grade_select = $this->load->view('template/select',$select_data, TRUE);

			$data_all_count = $this->Record_model->record_query_count($this->account,$this->njupt_time->get_school_year(),$this->njupt_time->get_term(),'','',-1);
			$data_count = $this->Record_model->record_query_count($this->account,$this->njupt_time->get_school_year(),$this->njupt_time->get_term(),$start_day,$end_day,$grade);

			$data['grade_select'] = $grade_select;
			$data['all_count'] = $data_all_count;
			$data['data_count'] = $data_count;
			$data['course_list'] = $this->Record_model->record_query($this->account,$this->njupt_time->get_school_year(),$this->njupt_time->get_term(),$start_day,$end_day,$grade,10,($per_page-1)*10);

			$pagination_url=current_url().'?';
			if($this->input->get('start_day'))$pagination_url=$pagination_url."start_day=$start_day&";
			if($this->input->get('end_day'))$pagination_url=$pagination_url."end_day=$end_day&";
			if($this->input->get('grade'))$pagination_url=$pagination_url."grade=$grade&";
			if(substr($pagination_url, -1)=='&')$pagination_url=substr($pagination_url, 0, -1);
			if(substr($pagination_url, -1)=='?')$pagination_url=substr($pagination_url, 0, -1);

			$data['pagination'] = $this->teacher_pagination($data_count,10,3,$pagination_url);

			$this->load->view('teacher/header',$header_data);
			$this->load->view('teacher/data_query',$data);
			$this->load->view('template/footer');
			$this->load->view('template/datepicker_js');
			$this->load->view('template/datepicker_end_js');
		}

		protected function teacher_pagination($total_rows,$per_page,$num_links,$base_url)
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

		protected function count_class_rate($query_array,$max_rate=100,$min_rate=0)
	    {
	    	$result = NULL;
	    	if($query_array==NULL)return 0;
	    	foreach ($query_array as $key => $value)
	    	{
	    		if(($value['class_rate_min_number']>=$min_rate)&&($value['class_rate_min_number']<$max_rate))
	    			$result[]=$value;
	    	}
			return count($result);
	    }

	    protected function count_class_rate_array($query_array,$data_name,$max_rate=100,$min_rate=0)
	    {
	    	$result = NULL;
	    	$result['data_name']=$data_name;
	    	$result['data']=$this->count_class_rate($query_array,$max_rate,$min_rate);

	    	return $result;
	    }

	    protected function index_count_class_rate_array($query_array)
	    {
	    	$result = NULL;
	    	$result[] = $this->count_class_rate_array($query_array,'90%以上',101,90);
	    	$result[] = $this->count_class_rate_array($query_array,'80%-90%',90,80);
	    	$result[] = $this->count_class_rate_array($query_array,'70%-80%',80,70);
	    	$result[] = $this->count_class_rate_array($query_array,'60%-70%',70,60);
	    	$result[] = $this->count_class_rate_array($query_array,'50%-60%',60,50);
	    	$result[] = $this->count_class_rate_array($query_array,'50%以下',50,0.001);
	    	return $result;
	    }

	    public function excel_out()
		{
			$this->login_status_detection();
			$this->load->model('Record_model');
			$this->load->model('Student_teacher_account_model');

			$header_data['account']=$this->user_name;

			$data['account_type'] = 'teacher';
			$data['all_count'] = $this->Record_model->record_query_count($this->account,$this->njupt_time->get_school_year(),$this->njupt_time->get_term(),'','',-1);

			$select_data['name']='grade';
			$select_data['default_value']='——请选择——';
			$select_data['details']=$this->Student_teacher_account_model->get_grade_list();
			$data['grade_select'] = $this->load->view('template/select',$select_data, TRUE);

			if($this->input->get('start_day'))$start_day=$this->input->get('start_day', TRUE);else$start_day=NULL;
			if($this->input->get('end_day'))$end_day=$this->input->get('end_day', TRUE);else$end_day=NULL;
			if($this->input->get('grade'))$grade=$this->input->get('grade', TRUE);else$grade='-1';

			$start_time=strtotime($start_day);
			$end_time=strtotime($end_day);
			if($start_time>$end_time){$temp=$start_day;$start_day=$end_day;$end_day=$temp;}

			if($this->input->get('start_day'))
				$data['start_day'] = $start_day;
			else
				$data['start_day'] = date("Y-m-d",strtotime("-1 week"));

			if($this->input->get('end_day'))
				$data['end_day'] = $end_day;
			else
				$data['end_day'] = date("Y-m-d");

			$this->load->view('admin/header',$header_data);
			$this->load->view('template/excel_out',$data);
			$this->load->view('template/footer');
			$this->load->view('template/datepicker_js');
			$this->load->view('template/datepicker_end_js');
		}

		public function excel_out_action()
		{
			$this->login_status_detection();
			$this->load->library('Excel_out_library');
			$this->load->model('Record_model');
			$this->load->model('Student_teacher_account_model');

			if($this->input->get('start_day'))$start_day=$this->input->get('start_day', TRUE);else$start_day=$this->njupt_time->get_start_day();
			if($this->input->get('end_day'))$end_day=$this->input->get('end_day', TRUE);else$end_day=$end_day = date("Y-m-d");
			if($this->input->get('grade'))$grade=$this->input->get('grade', TRUE);else$grade='-1';

			$start_time=strtotime($start_day);
			$end_time=strtotime($end_day);
			if($start_time>$end_time){$temp=$start_day;$start_day=$end_day;$end_day=$temp;}

			$class_array=$this->Record_model->get_class_rate_list($this->account,$this->njupt_time->get_school_year(),$this->njupt_time->get_term(),$start_day,$end_day,$grade);

			if($class_array)
			{
				$result_array = NULL;
				$count = 0;

				foreach ($class_array as $key => $value)
				{
					$result_array[$count]['record_id'] = $count+1;
					$result_array[$count]['date'] = $value['class_date'];
					$result_array[$count]['week'] = $value['week'];
					$result_array[$count]['weekday'] = $value['weekday'];
					$result_array[$count]['class_time'] = '第'.$value['class_time'].'大节';
					$result_array[$count]['classroom'] = $value['classroom'];
					$result_array[$count]['college'] = $value['college'];
					$result_array[$count]['class_list'] = $value['class_list'];
					$result_array[$count]['course_name'] = $value['course_name'];
					$result_array[$count]['teacher_name'] = $value['tercher_name'];
					$result_array[$count]['choice_number'] = $value['choices_number'];
					$result_array[$count]['real_number'] = $value['real_number_min'];
					$result_array[$count]['class_rate'] = $value['class_rate_min'];

					$count++;
				}

				$this->excel_out_library->class_rate_out($result_array,'查课数据统计表（'.$start_day.'至'.$end_day.'）',$start_day,$end_day);
				
				$data['alert_information']="导出成功！";
				$data['href']="admin/excel_out";
				$this->load->view('template/alert_and_location_href',$data);
			}
			else
			{
				$data['alert_information']="该时间段未查询到数据，导出失败(｡˘•ε•˘｡)";
				$data['href']="admin/excel_out";
				$this->load->view('template/alert_and_location_href',$data);
			}
		}
	}