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

		protected function login_status_detection()
		{
			$this->type=$this->session->type;
			$this->account=$this->session->account;

			// $this->output->enable_profiler(TRUE);

			if($this->type!="admin")redirect('');
		}

		public function index()
		{
			$this->login_status_detection();
			$this->load->model('Record_model');

			$header_data['account']=$this->account;

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

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/main',$main_data);
			$this->load->view('template/footer');
			$this->load->view('template/pie_chart',$pie_chart_data);
		}

		protected function add_operation($operation_type,$operation_type_cn)
		{
			$this->login_status_detection();

			$this->load->model('College_information_model');

			$header_data['account']=$this->account;
			$select_data['name']='college_id';
			$select_data['default_value']='——请选择——';
			$select_data['details']=$this->College_information_model->get_college_information();

			$college_select = $this->load->view('template/select',$select_data, TRUE);

			$add_user_data['college_select']=$college_select;
			$add_user_data['account_type']=$operation_type_cn;
			$add_user_data['action']="admin/add_".$operation_type."_action";

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/add_user',$add_user_data);
			$this->load->view('template/footer');
		}

		public function add_teacher()
		{
			$this->add_operation('teacher',"教师");
		}

		public function add_student()
		{
			$this->add_operation('student',"查课员");
		}

		protected function manager($operation_type,$operation_type_cn)
		{
			$this->login_status_detection();

			$college_id= $this->input->get('college_id', TRUE);
			$per_page=$this->input->get('per_page', TRUE);
			if(is_null($college_id))$college_id=-1;
			if(is_null($per_page))$per_page=1;
			$base_url=current_url()."?college_id=$college_id";

			$header_data['account']=$this->account;

			$this->load->model('College_information_model');
			$this->load->model('Student_teacher_account_model');
			$this->load->library('table');

			$header_data['account']=$this->account;
			$select_data['name']='college_id';
			$select_data['default_value']='不限';
			$select_data['select_key']=$college_id;
			$select_data['details']=$this->College_information_model->get_college_information();

			$college_select = $this->load->view('template/select',$select_data, TRUE);

			$template = array('table_open'  => ' <table width="563" class="table">');
			$this->table->set_template($template);
			$this->table->set_heading('登陆账户', '学院', '姓名','上次登陆时间','操作');
			$table=$this->table->generate($this->Student_teacher_account_model->get_user_list($operation_type,$college_id,10,($per_page-1)*10));

			$person_manager_data['college_select']=$college_select;
			$person_manager_data['table']=$table;
			$person_manager_data['type']=$operation_type;
			$person_manager_data['account_type']=$operation_type_cn;
			$person_manager_data['all_count']=$this->Student_teacher_account_model->all_count($operation_type);
			$person_manager_data['count']=$this->Student_teacher_account_model->count_user_list($operation_type,$college_id);
			$person_manager_data['pagination']=$this->admin_pagination($person_manager_data['count'],10,3,$base_url);

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/person_manager',$person_manager_data);
			$this->load->view('template/footer');
		}

		public function teacher_manager()
		{
			$this->manager('teacher',"教师");
		}

		public function student_manager()
		{
			$this->manager('student',"查课员");
		}

		protected function admin_pagination($total_rows,$per_page,$num_links,$base_url)
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

		protected function add_action($type)
		{
			$this->login_status_detection();

			$id= $this->input->post('account', TRUE);
			$name= $this->input->post('account_name', TRUE);
			$college_id= $this->input->post('college_id', TRUE);
			$telephone= $this->input->post('telephone', TRUE);
			$password=$this->encrypt->encode($id);

			$this->load->model('Student_teacher_account_model');

			if($this->Student_teacher_account_model->add_accout($type,$id,$name,$college_id,$telephone,$password))
			{
				$data['alert_information']="添加成功";
				$data['href']="admin/$type"."_manager";
			}
			else
			{
				$data['alert_information']="账户已存在，添加失败！";
				$data['href']="admin/add_$type";
			}
			$this->load->view('template/alert_and_location_href',$data);
		}

		public function add_teacher_action()
		{
			$this->add_action('teacher');
		}

		public function add_student_action()
		{
			$this->add_action('student');
		}

		public function change_system_option()
		{
			$this->login_status_detection();
			$this->load->model('System_option_model');

			if($this->input->post('school_year', TRUE))
			{
				$school_year= str_replace(' ','',$this->input->post('school_year', TRUE));
				$term= str_replace(' ','',$this->input->post('term', TRUE));
				$start_day= str_replace(' ','',$this->input->post('start_day', TRUE));

				$this->System_option_model->update_system_option($school_year,$term,$start_day);

				$data['alert_information']="修改系统时间完成！";
				$data['href']="admin";

				$this->load->view('template/alert_and_location_href',$data);
			}
			else
			{
				$header_data['account']=$this->account;

				$data=$this->System_option_model->get_system_option();

				$this->load->view('admin/header',$header_data);
				$this->load->view('admin/change_system_option',$data);
				$this->load->view('template/footer');
				$this->load->view('template/datepicker_js');
			}
		}

		public function notification_release()
		{
			$this->login_status_detection();
			$this->load->model('Notification_model');

			if($this->input->post('submit', TRUE))
			{
				$notification_target= str_replace(' ','',$this->input->post('notification_target', TRUE));
				$notification_content= $this->input->post('notification_content', TRUE);

				$this->Notification_model->add_notification($notification_target,$this->account,$notification_content);

				$data['alert_information']="公告发布成功！";
				$data['href']="admin/notification_release";

				$this->load->view('template/alert_and_location_href',$data);
			}
			else
			{
				$header_data['account']=$this->account;

				$class_notification_array=$this->Notification_model->get_notification('class',3);
				$teacher_notification_array=$this->Notification_model->get_notification('teacher',3);
				$student_notification_array=$this->Notification_model->get_notification('student',3);

				$class_notification['notification']=$class_notification_array;
				$class_notification['notification_target']='班级';

				$teacher_notification['notification']=$teacher_notification_array;
				$teacher_notification['notification_target']='教师';

				$student_notification['notification']=$student_notification_array;
				$student_notification['notification_target']='查课员';

				$notification_release_data['class_notification']=$this->load->view('template/notification',$class_notification,TRUE);
				$notification_release_data['teacher_notification']=$this->load->view('template/notification',$teacher_notification,TRUE);
				$notification_release_data['student_notification']=$this->load->view('template/notification',$student_notification,TRUE);

				$this->load->view('admin/header',$header_data);
				$this->load->view('admin/notification_release',$notification_release_data);
				$this->load->view('template/footer');
			}
		}

		protected function account_operation($operation_type,$operation_id)
		{
			$this->login_status_detection();

			$this->check_account_exist($operation_type,$operation_id);

			$this->load->model('login_information_model');
			$this->load->model('College_information_model');
			$this->load->model('Account_information_model');
			$this->load->model('Student_teacher_account_model');
			$this->load->library('table');

			$college_name=$this->College_information_model->get_user_college_name($operation_type,$operation_id);
			$user_name=$this->Account_information_model-> get_user_name($operation_type,$operation_id);
			$telephone=$this->Account_information_model-> get_user_telephone($operation_type,$operation_id);

			$current_login_time=$this->Student_teacher_account_model->get_login_information_option($operation_type,$operation_id);
			$current_login=$this->login_information_model->get_login_information_option($operation_type,$operation_id);
			$login_count=$this->login_information_model->get_login_information_count($operation_type,$operation_id);

			$template = array('table_open'  => ' <table class="table">');
			$this->table->set_template($template);
			$this->table->set_heading('#', '登陆时间');
			$table=$this->table->generate($current_login);

			$header_data['account']=$this->account;

			$situation_data['account']=$operation_id;
			$situation_data['account_type']=$operation_type;
			switch ($operation_type) 
			{
				case 'admin':
					$situation_data['type']='admin';
					break;
				case 'teacher':
					$situation_data['type']='教师';
					break;
				case 'student':
					$situation_data['type']='查课员';
					break;
				case 'class':
					$situation_data['type']='班级';
					break;
				default:
					$situation_data['type']='';
					break;
			}
			$situation_data['college_name']=$college_name;
			$situation_data['telephone']=$telephone;
			$situation_data['current_login_time']=$current_login_time;
			$situation_data['login_count']=$login_count;
			$situation_data['user_name']=$user_name;
			$situation_data['table']=$table;

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/account_operation',$situation_data);
			$this->load->view('template/footer');
		}

		protected function check_account_exist($type,$id)
		{
			$this->load->model('Account_information_model');

			if(!$this->Account_information_model->check_account_exist($type,$id))
				redirect('');
		}

		public function operation_teacher()
		{
			$teacher_id=$this->input->get('teacher_id', TRUE);
			if(is_null($teacher_id))$teacher_id=NULL;
			$this->account_operation('teacher',$teacher_id);
		}

		public function operation_student()
		{
			$student_id=$this->input->get('student_id', TRUE);
			if(is_null($student_id))$student_id=NULL;
			$this->account_operation('student',$student_id);
		}

		protected function delete_account($type)
		{
			$this->login_status_detection();

			$id=$this->input->get($type.'_id', TRUE);
			if(is_null($id))$id=NULL;
			$this->check_account_exist($type,$id);

			$this->load->model('Student_teacher_account_model');
			$this->Student_teacher_account_model->delete_account($type,$id);

			$data['alert_information']="删除账号完成！";
			$data['href']="admin/".$type."_manager";

			$this->load->view('template/alert_and_location_href',$data);
		}

		public function delete_teacher()
		{
			$this->delete_account('teacher');
		}

		public function delete_student()
		{
			$this->delete_account('student');
		}

		protected function reset_password($type)
		{
			$this->login_status_detection();

			$id=$this->input->get($type.'_id', TRUE);
			if(is_null($id))$id=NULL;
			$this->check_account_exist($type,$id);

			$new_password=$this->encrypt->encode($id);

			$this->load->model('Change_password_model');

			$this->Change_password_model->change_password($type,$id,$new_password);

			$data['alert_information']="重置密码完成！";
			$data['href']="admin/".$type."_manager";

			$this->load->view('template/alert_and_location_href',$data);
		}

		public function reset_password_teacher()
		{
			$this->reset_password('teacher');
		}

		public function reset_password_student()
		{
			$this->reset_password('student');
		}

		public function data_query()
		{
			$this->login_status_detection();
			$this->load->model('Record_model');
			$this->load->model('Student_teacher_account_model');

			$header_data['account']=$this->account;

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
			$select_data['select_key']=$grade;
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

			$data['pagination'] = $this->admin_pagination($data_count,10,3,$pagination_url);

			$this->load->view('admin/header',$header_data);
			$this->load->view('teacher/data_query',$data);
			$this->load->view('template/footer');
			$this->load->view('template/datepicker_js');
			$this->load->view('template/datepicker_end_js');
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

	    public function suggestions()
		{
			$this->login_status_detection();
			$this->load->model('Suggestions_model');

			$per_page=$this->input->get('per_page', TRUE);
			if(is_null($per_page))$per_page=1;

			$header_data['account']=$this->account;

			$suggestions_display_data['all_count']=$this->Suggestions_model->count_suggestions();
			$suggestions_display_data['suggestions_array']=$this->Suggestions_model->get_suggestions(10,($per_page-1)*10);
			$suggestions_display_data['pagination']=$this->admin_pagination($suggestions_display_data['all_count'],10,3,current_url());

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/suggestions_display',$suggestions_display_data);
			$this->load->view('template/footer');
		}

		public function excel_out()
		{
			$this->login_status_detection();
			$this->load->model('Record_model');
			$this->load->model('Student_teacher_account_model');

			$header_data['account']=$this->account;

			$data['account_type'] = 'admin';
			$data['all_count'] = $this->Record_model->record_query_count($this->account,$this->njupt_time->get_school_year(),$this->njupt_time->get_term(),'','',-1);

			$select_data['name']='grade';
			$select_data['default_value']='——不限——';
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
					$result_array[$count]['Numberofleave'] = $value['Numberofleave'];//请假人数
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

		public function change_course_information()
		{
			$this->login_status_detection();
			$this->load->model('Course_information_model');
			$this->load->model('Classroom_model');
			$this->load->library('table');

			$data['teaching_building_array'] = $this->Classroom_model->get_teaching_building_number();
			$data['classroom_array'] = $this->Classroom_model->get_classroom_number();

			$header_data['account']=$this->account;

			if($this->input->get('teaching_building'))$teaching_building=$this->input->get('teaching_building', TRUE);else$teaching_building=-1;
			if($this->input->get('classroom'))$classroom=$this->input->get('classroom', TRUE);else$classroom=-1;
			$per_page=$this->input->get('per_page', TRUE);
			if(is_null($per_page))$per_page=1;

			$classroom_array = $this->Classroom_model-> get_classroom_list($teaching_building,$classroom);
			$query_course_list = $this->Course_information_model->get_course_list($this->njupt_time->get_school_year(),$this->njupt_time->get_term(),$classroom_array,10,($per_page-1)*10);

			$data['all_count'] = $this->Course_information_model->count_course_list($this->njupt_time->get_school_year(),$this->njupt_time->get_term());
			$data['count'] = $this->Course_information_model->count_course_list($this->njupt_time->get_school_year(),$this->njupt_time->get_term(),$classroom_array);

			$template = array('table_open'  => ' <table width="563" class="table">');
			$this->table->set_template($template);
			$this->table->set_heading('教室', '星期', '时间','课程名称','任课教师','应到人数','操作');
			$table=$this->table->generate($query_course_list);
			
			$data['table'] = $table;

			$pagination_url=current_url().'?';
			if($this->input->get('teaching_building'))$pagination_url=$pagination_url."teaching_building=$teaching_building&";
			if($this->input->get('classroom'))$pagination_url=$pagination_url."classroom=$classroom&";
			if(substr($pagination_url, -1)=='&')$pagination_url=substr($pagination_url, 0, -1);
			if(substr($pagination_url, -1)=='?')$pagination_url=substr($pagination_url, 0, -1);

			$data['pagination']=$this->admin_pagination($data['count'],10,3,$pagination_url);

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/change_course_information',$data);
			$this->load->view('template/footer');
			$this->load->view('student/two_select_js',$data);
		}

		public function change_course_information_middleware()
		{
			$this->login_status_detection();
			$this->load->model('Course_information_model');

			$header_data['account']=$this->account;

			if($this->input->get('course_id'))$course_id=$this->input->get('course_id', TRUE);else$course_id=NULL;

			if($course_id==NULL)
			{
				$data['alert_information']="请填写课程号后再进行查询(｡˘•ε•˘｡)";
				$data['href']="admin/change_course_information";
				$this->load->view('template/alert_and_location_href',$data);
			}

			$course_information = $this->Course_information_model->get_course_information($course_id);
			if($course_information==NULL)
			{
				$data['alert_information']="没有查询到对应该课程号的课程信息，出错了(｡˘•ε•˘｡)";
				$data['href']="admin/change_course_information";
				$this->load->view('template/alert_and_location_href',$data);
			}
	
			$data = $course_information;

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/change_course_information_middleware',$data);
			$this->load->view('template/footer');
		}


		public function change_course_information_action()
		{
			$this->login_status_detection();
			
			$course_id= $this->input->post('course_id', TRUE);
			$choices_number= $this->input->post('choices_number', TRUE);

			$this->load->model('Course_information_model');

			$this->Course_information_model->update_course_information($course_id,$choices_number);

			$data['alert_information']="修改课程信息成功！";
			$data['href']="admin/change_course_information";

			$this->load->view('template/alert_and_location_href',$data);
		}


		public function login_situation()
		{
			$this->login_status_detection();

			$this->load->model('Login_information_model');
			$this->load->model('Account_information_model');
			$this->load->library('table');

			$log = $this->Login_information_model->get_login_information_option('student', null, 50);

			$info = [];
			foreach($log as $l)
			{
				$stu_id = $l['student_id'];
				$info += [
					'id' => $stu_id,
					'username' =>  $this->Account_information_model-> get_user_name('student', $stu_id),
					'time' => $l['login_time']
				];
			}


			$template = array('table_open'  => ' <table class="table">');
			$this->table->set_template($template);
			$this->table->set_heading('登陆账号', '用户姓名', '登陆时间');
			$table=$this->table->generate($info);

			$situation_data['table']=$table;

			$this->load->view($this->type.'/header');
			$this->load->view('template/account-situation',$situation_data);
			$this->load->view('template/footer');
		}
	}