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

			$this->output->enable_profiler(TRUE);

			if($this->type!="admin")redirect('');
		}

		public function index()
		{
			$this->login_status_detection();

			$header_data['account']=$this->account;

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/main');
			$this->load->view('template/footer');
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
			$this->add_operation('teacher',"老师");
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
			$password=$this->encrypt->encode($id);

			$this->load->model('Student_teacher_account_model');

			if($this->Student_teacher_account_model->add_accout($type,$id,$name,$college_id,$password))
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
	}