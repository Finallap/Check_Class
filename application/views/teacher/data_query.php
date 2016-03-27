 <div class="span9">
            <h1 class="page-title">到课率统计</h1>

            <div class="block">
              <p class="block-heading">共<?php echo $all_count?>条记录，查询导符合条件的记录<?php echo $data_count?>条！可进行记录筛选：</p>
                <div class="block-body">
                <div class="row-fluid">
                  <form action="<?php echo current_url();?>" method="get">
                      <label>查询起始日期选择</label>
                      <input type="text" id="datepicker" name="start_day" value="<?php echo $start_day;?>" class="input-xlarge">
                      <br>
                      <label>查询结束日期选择</label>
                      <input type="text" id="datepicker_end" name="end_day" value="<?php echo $end_day;?>" class="input-xlarge">
                      <br>
                      <label>年级选择</label>
                      <?php echo $grade_select;?>
                      <br>
                      <button type="submit" name="" value="send" class="btn btn-primary" onclick="GetRequest()">检索</button>
                  </form>
                  </div>
                </div>
            </div>

            <?php 
              if($course_list)
              {
                foreach ($course_list as $key => $course_detail) 
                {
                  echo '<div class="sidebar-nav">'."\n";
                  echo '<div class="nav-header" data-toggle="collapse" data-target="#course'.$course_detail['rownum'].'"><i class="fa fa-arrow-circle-down"></i>&nbsp&nbsp'.$course_detail['class_date'].'&nbsp&nbsp'.$course_detail['weekday'].'&nbsp&nbsp第'.$course_detail['class_time'].'大节&nbsp&nbsp'.$course_detail['course_name'].'&nbsp&nbsp'.$course_detail['class_list'].'&nbsp&nbsp应到人数：'.$course_detail['choices_number'].'&nbsp&nbsp实到人数：'.$course_detail['real_number_min'].'&nbsp&nbsp到课率：'.$course_detail['class_rate_min'].'</div>'."\n";

                  echo '<ul id=course'.$course_detail['rownum'].' class="nav nav-list collapse in">'."\n";
                  echo '<div class="block-body">'."\n";
                  // echo '<p>课程名称：'.$course_detail['course_name'].'</p>'."\n";
                  // echo '<p>上课时间：'.$course_detail['class_date'].'&nbsp&nbsp'.$course_detail['weekday'].'&nbsp&nbsp第'.$course_detail['class_time'].'大节&nbsp&nbsp</p>'."\n";
                  // echo '<p>上课教室：'.$course_detail['classroom'].'</p>'."\n";
                  // echo '<p>任课教师：'.$course_detail['tercher_name'].'</p>'."\n";
                  // echo '<p>所上班级：'.$course_detail['class_list'].'</p>'."\n";
                  // echo '<p>应到人数：'.$course_detail['choices_number'].'</p>'."\n";

                  echo '<p>上课教室：'.$course_detail['classroom'].'&nbsp&nbsp任课教师：'.$course_detail['tercher_name'].'</p>'."\n";
                  echo '<p>具体录入情况：</p>'."\n";

                  $table_header = <<<EOF
                    <table class="table-condensed" border="1" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="138"><p align="center">账号类型</p></td>
                        <td width="138"><p align="center">录入账号</p></td>
                        <td width="138"><p align="center">实到人数 </p></td>
                        <td width="138"><p align="center">到课率 </p></td>
                        <td width="138"><p align="center">备注 </p></td>
                        <td width="160"><p align="center">录入时间 </p></td>
                      </tr>
EOF;

                  echo $table_header;
                  foreach ($course_detail['detail'] as $key => $detail)
                  {
                    echo ' <tr>'."\n";
                    echo ' <td width="120"><p align="center"> '.$detail['account_type'].' </p></td>'."\n";
                    echo ' <td width="120"><p align="center"> '.$detail['account_id'].' </p></td>'."\n";
                    echo ' <td width="120"><p align="center"> '.$detail['real_number'].' </p></td>'."\n";
                    echo ' <td width="120"><p align="center"> '.$detail['class_rate'].' </p></td>'."\n";
                    echo ' <td width="138"><p align="center"> '.$detail['remark'].' </p></td>'."\n";
                    echo ' <td width="160"><p align="center"> '.$detail['recording_time'].' </p></td>'."\n";
                    echo ' </tr>'."\n";
                  }
                  echo '</table>'."\n";

                  echo '</div>'."\n";
                  echo '</ul>'."\n";
                  echo '</div>'."\n";
                } 
              }
              else
              {
                echo '<div  class="block">'."\n";
                echo '<p class="block-heading">未查询到该时间段内的查课信息，抱歉(′д｀ )…彡…彡</p>'."\n";
                echo '</div>'."\n";
              }



            ?>
      <div class="pagination">
        <?php echo $pagination?>
      </div>


        </div>
    </div>