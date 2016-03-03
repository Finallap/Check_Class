<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->output->enable_profiler(TRUE);

		$this->load->model('Login_model');

		$this->load->view('login/header-sign-in');
		$this->load->view('login/sign-in');
		$this->load->view('template/footer');

	}
}
