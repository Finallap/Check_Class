<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		//$this->output->enable_profiler(TRUE);

		if(!isset($this->session->type))
		{
			switch ($this->session->type) 
			{
				case 'class':
					redirect('/the_class/');
					break;
				case 'teacher':
					redirect('/teacher/');
					break;
				case 'student':
					redirect('/student/');
					break;
				case 'admin':
					redirect('/admin/');
					break;
				default:
					redirect('/login/');
					break;
			}
		}
		else
		{
			redirect('/login/');
		}	

	}
}
