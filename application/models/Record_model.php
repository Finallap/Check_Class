<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record_model extends CI_Model{

	public function __construct() 
	{	
		parent::__construct();
	}

	public function record_input($input_data) 
	{
		$this->db->insert('check_class_record', $input_data);
	}

	public function exist_record($select_data) 
	{
		$this->db->select('*');
		$this->db->from('check_class_record');

		$this->db->where('school_year',$select_data['school_year']);
		$this->db->where('term',$select_data['term']);
		$this->db->where('account_type',$select_data['account_type']);
		$this->db->where('account_id',$select_data['account_id']);
		$this->db->where('week',$select_data['week']);
		$this->db->where('course_id',$select_data['course_id']);

		$query=$this->db->get();
		$query=$query->result_array();

		if(empty($query))
			return false;
		else
			return true;
	}

	public function get_record_list($account_type=NULL,$account_id=NULL,$count=10,$offset=0)
	{
		$this->db->select("*");
		$this->db->from('check_class_record');

		$this->db->where("account_type",$account_type);
		$this->db->where("account_id",$account_id);

		$this->db->limit($count,$offset);
		$this->db->order_by('recording_time','ASC');
		$query=$this->db->get();
		$query=$query->result_array();

		foreach ($query as $key => $value) 
		{
			$this->db->reset_query();
			$this->db->select("*");
			$this->db->where("course_id",$value["course_id"]);
			$this->db->from('course_information');
			$query1=$this->db->get();
			$query1=$query1->result_array();

			$query[$key]['course_name']=$query1[0]['course_name'];
			$query[$key]['weekday']=$query1[0]['weekday'];
			$query[$key]['classroom']=$query1[0]['classroom'];
			$query[$key]['tercher_name']=$query1[0]['tercher_name'];
			$query[$key]['choices_number']=$query1[0]['choices_number'];

			$query[$key]['students_attendance']=$this->calculation_class_rate($value["real_number"],$query1[0]['choices_number']);
		}

		return $query;
	}

	public function count_record_list($account_type=NULL,$account_id=NULL)
	{
		$this->db->select("COUNT(*)");
		$this->db->from('check_class_record');
		$this->db->where("account_type",$account_type);
		$this->db->where("account_id",$account_id);

		return $this->db->count_all_results();
	}

	public function record_query($account_id,$school_year,$term,$start_time=NULL,$end_time=NULL,$grade=-1,$count=10000,$offset=0)
	{
		$course_id_list=$this->college_course_query($account_id,$school_year,$term,$grade);
		if($course_id_list==NULL)return NULL;

		$this->db->select('@rownum:=@rownum+1 AS rownum', FALSE);
		$this->db->select_min('check_class_record.real_number');
		$this->db->select('check_class_record.course_id');
		$this->db->select('check_class_record.recording_time');
		$this->db->from("(SELECT @rownum:=0) r", FALSE);
		$this->db->from('check_class_record');

		$time_array=$this->query_time_process($start_time,$end_time);
		if($time_array['start_time'])$this->db->where("check_class_record.recording_time>=",$time_array['start_time']);
		if($time_array['end_time'])$this->db->where("check_class_record.recording_time<=",$time_array['end_time']);
			
		$course_id_list_array = NULL;
		foreach ($course_id_list as $key => $value)
		{
			$course_id_list_array[] = $value['course_id'];
		}
		$this->db->where_in('check_class_record.course_id', $course_id_list_array);

		$this->db->group_by("check_class_record.course_id");
		$this->db->group_by("check_class_record.week");
		$this->db->limit($count,$offset);
		$this->db->order_by("check_class_record.recording_time","DESC");
		$query=$this->db->get();

		$query=$query->result_array();

		$result=NULL;

		foreach ($query as $key => $value)
		{
			$rownum=$value['rownum'];
			$result[$rownum]['rownum']=$rownum;
			$result[$rownum]['real_number_min']=$value['real_number'];
			$result[$rownum]['recording_time']=$value['recording_time'];

			$result[$rownum]['class_date']= date('Y-m-d',strtotime($value['recording_time']));

			$this->db->select('*');
			$this->db->from('course_information');
			$this->db->where('course_id',$value['course_id']);
			$course_query=$this->db->get();
			$course_query=$course_query->result_array();

			$course_query[0]['weekday']=$this->weekday_chinese($course_query[0]['weekday']);//星期几转换为中文

			//查询该课程所上班级号
			$course_id=$course_query[0]['course_id'];
			$class_array=$this->get_all_class_id($school_year,$term,$course_id);
			$class_list=NULL;
			foreach ($class_array as $key => $class_value) 
			{
				$class_list.=$class_value['class_id'].",";
			}
			$class_list=substr($class_list, 0, -1);
			$course_query[0]['class_list']=$class_list;
			$course_query[0]['class_rate_min']=$this->calculation_class_rate($result[$rownum]['real_number_min'],$course_query[0]['choices_number']);
			$course_query[0]['class_rate_min_number']=$this->calculation_class_rate_number($result[$rownum]['real_number_min'],$course_query[0]['choices_number']);

			//合并数组，课程信息和最低到课率
			$result[$rownum] = array_merge($result[$rownum], $course_query[0]);

			//查询具体的查课记录，就是多条查询记录
			$this->db->select('@rownum:=@rownum+1 AS rownum', FALSE);
			$this->db->select('check_class_record.*');
			$this->db->from("(SELECT @rownum:=0) r", FALSE);
			$this->db->from('check_class_record');
			$this->db->where('check_class_record.course_id',$value['course_id']);

			$detail_query=$this->db->get();
			$detail_query=$detail_query->result_array();

			//把账户类型转换为中文并计算每条的最低到课率
			foreach ($detail_query as $key => $detail_query_value)
			{
				$detail_query[$key]['account_type']=$this->account_type_chinese($detail_query_value['account_type']);
				$detail_query[$key]['class_rate']=$this->calculation_class_rate($detail_query_value['real_number'],$course_query[0]['choices_number']);
			}

			$result[$rownum]['detail']=$detail_query;
		}

		return $result;
	}

	public function college_course_query($account_id,$school_year,$term,$grade)
	{
		if($account_id=='admin')
			$class_id_list=$this->admin_get_class_id($grade);
		else
			$class_id_list=$this->teacher_get_class_id($account_id,$grade);

		$this->db->select('course_id');
		$this->db->from('course_class_information');

		$this->db->where_in('class_id', $class_id_list);

		$this->db->where('school_year',$school_year);
		$this->db->where('term',$term);

		$this->db->group_by("course_id");
		$query=$this->db->get();
		$query=$query->result_array();

		return $query;
	}

	public function teacher_get_class_id($id,$grade)
	{
		$this->db->select('college_id');
		$this->db->from('teacher_information');
		$this->db->where('teacher_id',$id);
		$query=$this->db->get();
		$query=$query->result_array();

		$college_id=$query[0]['college_id'];

		$this->db->select('class_id');
		$this->db->from('class_information');
		$this->db->where('college_id',$college_id);
		if($grade!='-1')$this->db->where('grade',$grade);
		$query=$this->db->get();
		$query=$query->result_array();

		foreach ($query as $key => $value)
		{
			$id=$value['class_id'];
			$result[$id]=$value['class_id'];
		}

		return $result;
	}

	public function admin_get_class_id($grade)
	{

		$this->db->select('class_id');
		$this->db->from('class_information');
		if($grade!='-1')$this->db->where('grade',$grade);
		$query=$this->db->get();
		$query=$query->result_array();

		$result=NULL;
		foreach ($query as $key => $value)
		{
			$id=$value['class_id'];
			$result[$id]=$value['class_id'];
		}

		return $result;
	}

	protected function weekday_chinese($weekday)
	{
		switch ($weekday) {
			case '1':
				return "周一";
				break;
			case '2':
				return "周二";
				break;
			case '3':
				return "周三";
				break;
			case '4':
				return "周四";
				break;
			case '5':
				return "周五";
				break;
			case '6':
				return "周六";
				break;
			case '0':
				return "周日";
				break;
			default:
				return "周日";
				break;
		}
	}

	public function get_all_class_id($school_year,$term,$course_id)
	{
		$this->db->select('class_id');
		$this->db->from('course_class_information');
		$this->db->where('school_year',$school_year);
		$this->db->where('term',$term);
		$this->db->where('course_id',$course_id);

		$query=$this->db->get();
		$query=$query->result_array();

		return $query;
	}

	public function record_query_count($account_id,$school_year,$term,$start_time=NULL,$end_time=NULL,$grade=-1)
	{
		$course_id_list=$this->college_course_query($account_id,$school_year,$term,$grade);
		if($course_id_list==NULL)return 0;

		$this->db->select_min('real_number');
		$this->db->select('course_id');
		$this->db->select('recording_time');
		$this->db->from('check_class_record');

		$time_array=$this->query_time_process($start_time,$end_time);
		if($time_array['start_time'])$this->db->where("check_class_record.recording_time>=",$time_array['start_time']);
		if($time_array['end_time'])$this->db->where("check_class_record.recording_time<=",$time_array['end_time']);

		$course_id_list_array = NULL;
		foreach ($course_id_list as $key => $value)
		{
			$course_id_list_array[] = $value['course_id'];
		}
		$this->db->where_in('course_id', $course_id_list_array);

		$this->db->group_by("course_id");
		$this->db->group_by("week");

		$query=$this->db->get();
		$query=$query->result_array();

		return count($query);
	}

	protected function account_type_chinese($type)
	{
		switch ($type) {
			case 'teacher':
				return "教师";
				break;
			case 'student':
				return "查课员";
				break;
			case 'admin':
				return "超级管理员";
				break;
			case 'class':
				return "班级";
				break;
			default:
				return "类型未知";
				break;
		}
	}

	protected function calculation_class_rate($real_number,$choices_number)
	{
		if($choices_number)
		{
			$result = round($real_number/$choices_number,4)*100;
			$result.="%";
			return $result;
		}
		else
			return "无";
	}

	protected function calculation_class_rate_number($real_number,$choices_number)
	{
		if($choices_number)
		{
			$result = round($real_number/$choices_number,4)*100;
			return $result;
		}
		else
			return "0";
	}

	public function lowest_ranking($account_id,$school_year,$term,$start_time=NULL,$end_time=NULL,$grade=-1)
	{
		$result = $this->get_class_rate_list($account_id,$school_year,$term,$start_time,$end_time,$grade);
		$result = $this->my_sort($result,'class_rate_min_number',SORT_ASC,SORT_NUMERIC);

		return $result;
	}

	protected function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC)
	{   
        if(is_array($arrays)){   
            foreach ($arrays as $array){   
                if(is_array($array)){   
                    $key_arrays[] = $array[$sort_key];   
                }else{   
                    return false;   
                }   
            }   
        }else{   
            return false;   
        }  
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);   
        return $arrays;   
    } 

    protected function query_time_process($start_time=NULL,$end_time=NULL)
    {
    	if(($start_time!=NULL)&&($end_time!=NULL))
    	{
    		$start_time_unix=strtotime($start_time);
			$end_time_unix=strtotime($end_time);
			if($start_time_unix>$end_time_unix)
				{$temp=$start_time;$start_time=$end_time;$end_time=$temp;}
    	}	

    	if(($start_time==$end_time)&&($start_time!=NULL))
		{
			$end_time_unix=strtotime($end_time);
			$end_time_unix=$end_time_unix+86400;
			$end_time=date("Y-m-d",$end_time_unix);
		}
		else
		{
			if($end_time)
			{
				$end_time_unix=strtotime($end_time);
				$end_time_unix=$end_time_unix+86400;
				$end_time=date("Y-m-d",$end_time_unix);
			}
		}

		$result['start_time']=$start_time;
		$result['end_time']=$end_time;

		return $result;
    }

    public function get_class_rate_list($account_id,$school_year,$term,$start_time=NULL,$end_time=NULL,$grade=-1)
    {
    	$course_id_list=$this->college_course_query($account_id,$school_year,$term,$grade);
		if($course_id_list==NULL)return NULL;

		$this->db->select('@rownum:=@rownum+1 AS rownum', FALSE);
		$this->db->select_min('check_class_record.real_number');
		$this->db->select('check_class_record.course_id');
		$this->db->select('check_class_record.recording_time');
		$this->db->from("(SELECT @rownum:=0) r", FALSE);
		$this->db->from('check_class_record');

		$time_array=$this->query_time_process($start_time,$end_time);
		if($time_array['start_time'])$this->db->where("check_class_record.recording_time>=",$time_array['start_time']);
		if($time_array['end_time'])$this->db->where("check_class_record.recording_time<=",$time_array['end_time']);
			
		$course_id_list_array = NULL;
		foreach ($course_id_list as $key => $value)
		{
			$course_id_list_array[] = $value['course_id'];
		}
		$this->db->where_in('check_class_record.course_id', $course_id_list_array);

		$this->db->group_by("check_class_record.course_id");
		$this->db->group_by("check_class_record.week");
		$this->db->order_by("check_class_record.recording_time","DESC");
		$query=$this->db->get();

		$query=$query->result_array();

		$result=NULL;

		foreach ($query as $key => $value)
		{
			$rownum=$value['rownum'];
			$result[$rownum]['rownum']=$rownum;
			$result[$rownum]['real_number_min']=$value['real_number'];
			$result[$rownum]['recording_time']=$value['recording_time'];

			$result[$rownum]['class_date']= date('Y-m-d',strtotime($value['recording_time']));

			$this->db->select('*');
			$this->db->from('course_information');
			$this->db->where('course_id',$value['course_id']);
			$course_query=$this->db->get();
			$course_query=$course_query->result_array();

			$course_query[0]['weekday']=$this->weekday_chinese($course_query[0]['weekday']);//星期几转换为中文

			//查询该课程所上班级号
			$course_id=$course_query[0]['course_id'];
			$class_array=$this->get_all_class_id($school_year,$term,$course_id);
			$class_list=NULL;
			foreach ($class_array as $key => $class_value) 
			{
				$class_list.=$class_value['class_id'].",";
			}
			$class_list=substr($class_list, 0, -1);
			$course_query[0]['class_list']=$class_list;
			$course_query[0]['class_rate_min']=$this->calculation_class_rate($result[$rownum]['real_number_min'],$course_query[0]['choices_number']);
			$course_query[0]['class_rate_min_number']=$this->calculation_class_rate_number($result[$rownum]['real_number_min'],$course_query[0]['choices_number']);

			//合并数组，课程信息和最低到课率
			$result[$rownum] = array_merge($result[$rownum], $course_query[0]);
		}

		return $result;
    }

    public function count_class_rate($query_array,$max_rate=100,$min_rate=0)
    {
    	$result = NULL;
    	foreach ($query_array as $key => $course)
    	{
    		if(($course['class_rate_min_number']>$min_rate)&&($course['class_rate_min_number']<$max_rate))
    			$result[]=$course;
    	}
		return count($result);
    }
}