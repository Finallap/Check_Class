<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class  Excel_out_library
	{
		public function __construct() 
		{
			/*导入phpExcel核心类*/
			include_once('PHPExcel.php');
	    }

	    public function class_rate_out($data,$name='Excel',$start_day,$end_day)
	    {
	    	$objPHPExcel = new PHPExcel();
	        /*以下是一些设置 ，什么作者  标题啊之类的*/
	         $objPHPExcel->getProperties()->setCreator("爱·服务公益社团")
	                               ->setLastModifiedBy("爱·服务公益社团")
	                               ->setTitle("数据EXCEL导出")
	                               ->setSubject("南京邮电大学查课系统到课率统计表")
	                               ->setDescription("南京邮电大学查课系统到课率统计表")
	                               ->setKeywords("check_class")
	                               ->setCategory("check_class");

	         /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
	        $objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
	        $objPHPExcel->getActiveSheet()->mergeCells('A2:N2');
	        $objPHPExcel->getActiveSheet()->mergeCells('A3:N3');

	        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(11);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(28);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(28);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);

	         $objPHPExcel->setActiveSheetIndex(0)
	                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
	                          ->setCellValue('A1', '南京邮电大学查课系统到课率统计表')    
	                          ->setCellValue('A2', '导出时间范围：'.$start_day.'至'.$end_day)
	                          ->setCellValue('A3', '导出时间：'.date('Y-m-d H:i:s',time()));

	         $objPHPExcel->setActiveSheetIndex(0)
	                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
	                          ->setCellValue('A4', '记录编号')
	                          ->setCellValue('B4', '日期')
	                          ->setCellValue('C4', '周数')
	                          ->setCellValue('D4', '星期')
	                          ->setCellValue('E4', '时间')
	                          ->setCellValue('F4', '教室')
	                          ->setCellValue('G4', '所在学院')
	                          ->setCellValue('H4', '所上班级')
	                          ->setCellValue('I4', '课程名称')
	                          ->setCellValue('J4', '任课老师')
	                          ->setCellValue('K4', '应到人数')
	                          ->setCellValue('L4', '实到人数')
	                          ->setCellValue('M4', '到课率')
	                          ->setCellValue('N4', '备注');

	        foreach($data as $k => $v)
	        {
	             $num=$k+5;
	             $objPHPExcel->setActiveSheetIndex(0)
	                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
	                          ->setCellValue('A'.$num, $v['record_id'])    
	                          ->setCellValue('B'.$num, $v['date'])
	                          ->setCellValue('C'.$num, $v['week'])
	                          ->setCellValue('D'.$num, $v['weekday'])
	                          ->setCellValue('E'.$num, $v['class_time'])
	                          ->setCellValue('F'.$num, $v['classroom'])
	                          ->setCellValue('G'.$num, $v['college'])
	                          ->setCellValue('H'.$num, $v['class_list'])
	                          ->setCellValue('I'.$num, $v['course_name'])
	                          ->setCellValue('J'.$num, $v['teacher_name'])
	                          ->setCellValue('K'.$num, $v['choice_number'])
	                          ->setCellValue('L'.$num, $v['real_number'])
	                          ->setCellValue('M'.$num, $v['class_rate'])
	                          ->setCellValue('N'.$num, $v['remark']);
	        }
	        $objPHPExcel->getActiveSheet()->setTitle('到课率统计');
	        $objPHPExcel->setActiveSheetIndex(0);
	        header('Content-Type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
	        header('Cache-Control: max-age=0');
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	        $objWriter->save('php://output');
	    }
	}