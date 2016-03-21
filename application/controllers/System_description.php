<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_description extends CI_Controller {

	public function index()
	{
		$this->load->view('template/system_description');
		$this->load->view('template/footer');	
	}
}
