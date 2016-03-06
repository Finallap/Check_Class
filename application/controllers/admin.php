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

		public function index()
		{
			$this->type=$this->session->type;
			$this->account=$this->session->account;

			$this->output->enable_profiler(TRUE);

			if($this->type!="admin")redirect('');

			$header_data['account']=$this->account;

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/main');
			$this->load->view('template/footer');
		}

		public function add_teacher()
		{
			$this->type=$this->session->type;
			$this->account=$this->session->account;

			if($this->type!="admin")redirect('');

			$this->load->model('College_information_model');

			$header_data['account']=$this->account;
			$select_data['name']='college';
			$select_data['details']=$this->College_information_model->get_college_information();

			$college_select = $this->load->view('template/select',$select_data, TRUE);

			$add_user_data['college_select']=$college_select;
			$add_user_data['account_type']='教师';
			$add_user_data['action']='admin/add_teacher_action';

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/add_user',$add_user_data);
			$this->load->view('template/footer');
		}

		public function add_student()
		{
			$this->type=$this->session->type;
			$this->account=$this->session->account;

			if($this->type!="admin")redirect('');

			$this->load->model('College_information_model');

			$header_data['account']=$this->account;
			$select_data['name']='college';
			$select_data['default_value']='——请选择——';
			$select_data['details']=$this->College_information_model->get_college_information();

			$college_select = $this->load->view('template/select',$select_data, TRUE);

			$add_user_data['college_select']=$college_select;
			$add_user_data['account_type']='查课员';
			$add_user_data['action']='admin/add_student_action';

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/add_user',$add_user_data);
			$this->load->view('template/footer');
		}

		public function teacher_manager()
		{
			$this->output->enable_profiler(TRUE);

			$this->type=$this->session->type;
			$this->account=$this->session->account;
			$college_id= $this->input->get('college_id', TRUE);

			if($this->type!="admin")redirect('');

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
			$table=$this->table->generate($this->Student_teacher_account_model->get_user_list('teacher',$college_id));

			$person_manager_data['college_select']=$college_select;
			$person_manager_data['table']=$table;
			$person_manager_data['account_type']='教师';
			$person_manager_data['all_count']=$this->Student_teacher_account_model->all_count('teacher');
			$person_manager_data['count']=$this->Student_teacher_account_model->count_user_list('teacher',$college_id);

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/person_manager',$person_manager_data);
			$this->load->view('template/footer');
		}

		public function student_manager()
		{
			$this->type=$this->session->type;
			$this->account=$this->session->account;
			$college_id= $this->input->get('college_id', TRUE);

			if($this->type!="admin")redirect('');

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
			$table=$this->table->generate($this->Student_teacher_account_model->get_user_list('student',$college_id));

			$person_manager_data['college_select']=$college_select;
			$person_manager_data['table']=$table;
			$person_manager_data['account_type']='学生';
			$person_manager_data['all_count']=$this->Student_teacher_account_model->all_count('student');
			$person_manager_data['count']=$this->Student_teacher_account_model->count_user_list('student',$college_id);

			$this->load->view('admin/header',$header_data);
			$this->load->view('admin/person_manager',$person_manager_data);
			$this->load->view('template/footer');
		}

	}