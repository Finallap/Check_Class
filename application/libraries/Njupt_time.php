<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Njupt_time{

	protected $CI;

	public function __construct()
    {
        $this->CI =& get_instance();
    }

	public function get_school_year()
	{
		$this->CI->load->model('system_option_model');
		$result=$this->CI->system_option_model->get_system_option();
		return $result['school_year'];
	}

	public function get_term()
	{
		$this->CI->load->model('system_option_model');
		$result=$this->CI->system_option_model->get_system_option();
		return $result['term'];
	}

	public function get_start_day()
	{
		$this->CI->load->model('system_option_model');
		$result=$this->CI->system_option_model->get_system_option();
		return $result['start_day'];
	}

	public function get_week()
	{
		$firstDate=$this->get_start_day();
    	$firstDate=empty($firstDate)?strtotime(date('Y').'-01-01'):(is_numeric($firstDate)?$firstDate:strtotime($firstDate));
   		//开学第一天的时间戳
    	list($year,$month,$day)=explode('-',date('Y-n-j',$firstDate));
    	$time_chuo_of_first_day=mktime(0,0,0,$month,$day,$year);
    	//今天的时间戳
    	list($year,$month,$day)=explode('-',date('Y-n-j'));
    	$time_chuo_of_current_day=mktime(0,0,0,$month,$day,$year);
    	$zhou=intval(($time_chuo_of_current_day-$time_chuo_of_first_day)/60/60/24/7)+1;
   		return $zhou;
	}

	public function get_odd_even()
    {
    	$week=$this->get_week();
 		if($week%2==0)
 			return "even";
 		else
 			return "odd";
    }

    public function get_class_time()
    {
    	$now_time  = date('H:i');

    	$start_time_1 = '7:45';
    	$end_time_1  = '9:40';

    	$start_time_2 = '9:41';
    	$end_time_2  = '12:20';

    	$start_time_3 = '13:35';
    	$end_time_3  = '15:25';

    	$start_time_4 = '15:26';
    	$end_time_4  = '17:20';

    	$start_time_5 = '18:20';
    	$end_time_5  = '21:10';

    	if( $start_time_1<=$now_time && $end_time_1>=$now_time )
    	{
		     return 1;
		}
		elseif( $start_time_2<=$now_time && $end_time_2>=$now_time )
    	{
		     return 2;
		}
		elseif( $start_time_3<=$now_time && $end_time_3>=$now_time )
    	{
		     return 3;
		}
		elseif( $start_time_4<=$now_time && $end_time_4>=$now_time )
    	{
		     return 4;
		}
		elseif( $start_time_5<=$now_time && $end_time_5>=$now_time )
    	{
		     return 5;
		}
		else
		{
		     return 0;
		}
    }
}