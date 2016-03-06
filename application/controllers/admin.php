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

			$header_data['account']=$this->account;

			$this->load->model('College_information_model');
			$this->load->model('Student_teacher_account_model');
			$this->load->library('table');

			$header_data['account']=$this->account;
			$select_data['name']='college_id';
			$select_data['default_value']='不限';
			$select_data['details']=$this->College_information_model->get_college_information();

			$college_select = $this->load->view('template/select',$select_data, TRUE);

			$template = array('table_open'  => ' <table width="563" class="table">',);
			$this->table->set_template($template);
			$this->table->set_heading('登陆账户', '学院', '姓名','上次登陆时间','操作');
			$table=$this->table->generate($this->Student_teacher_account_model->get_user_list($operation_type,$college_id));

			$person_manager_data['college_select']=$college_select;
			$person_manager_data['table']=$table;
			$person_manager_data['account_type']=$operation_type_cn;
			$person_manager_data['all_count']=$this->Student_teacher_account_model->all_count($operation_type);
			$person_manager_data['count']=$this->Student_teacher_account_model->count_user_list($operation_type,$college_id);

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/person_manager',$person_manager_data);
			$this->load->view('template/footer');
		}

		public function teacher_manager()
		{
			$this->manager('teacher',"老师");
		}

		public function student_manager()
		{
			$this->manager('student',"查课员");
		}
	}