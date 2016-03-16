 <div class="span9">
            <h1 class="page-title">到课率统计</h1>

            <div class="block">
              <p class="block-heading">共<?php echo $all_count?>条记录，查询导符合条件的记录<?php echo $all_count?>条！可进行记录筛选：</p>
                <div class="block-body">
                <div class="row-fluid">
                  <form action="" method="get">
                      <button type="submit" name="" value="send" class="btn btn-primary" onclick="GetRequest()">检索</button>
                  </form>
                    <div class="clearfix"></div>
                  </div>
                </div>
            </div>

            <?php 
              foreach ($course_list as $key => $course_detail) 
              {
                echo '<div class="sidebar-nav">'."\n";
                echo '<div class="nav-header" data-toggle="collapse" data-target="#course'.$course_detail['rownum'].'"><i class="fa fa-arrow-circle-down"></i>&nbsp&nbsp'.$course_detail['class_date'].'&nbsp&nbsp'.$course_detail['weekday'].'&nbsp&nbsp第'.$course_detail['class_time'].'大节&nbsp&nbsp'.$course_detail['course_name'].'&nbsp&nbsp'.$course_detail['class_list'].'&nbsp&nbsp最低到课人数：'.$course_detail['real_number_min'].'</div>'."\n";

                echo '<ul id=course'.$course_detail['rownum'].' class="nav nav-list collapse in">'."\n";
                echo '<div class="block-body">'."\n";
                echo '<p>课程名称：'.$course_detail['course_name'].'</p>'."\n";
                echo '<p>上课时间：'.$course_detail['class_date'].'&nbsp&nbsp'.$course_detail['weekday'].'&nbsp&nbsp第'.$course_detail['class_time'].'大节&nbsp&nbsp</p>'."\n";
                echo '<p>上课教室：'.$course_detail['classroom'].'</p>'."\n";
                echo '<p>任课教师：'.$course_detail['tercher_name'].'</p>'."\n";
                echo '<p>所上班级：'.$course_detail['class_list'].'</p>'."\n";
                echo '<p>应到人数：'.$course_detail['choices_number'].'</p>'."\n";
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
                  echo ' <td width="120"><p align="center"> '.$detail['real_number'].' </p></td>'."\n";
                  echo ' <td width="138"><p align="center"> '.$detail['remark'].' </p></td>'."\n";
                  echo ' <td width="160"><p align="center"> '.$detail['recording_time'].' </p></td>'."\n";
                  echo ' </tr>'."\n";
                }
                echo '</table>'."\n";

                echo '</div>'."\n";
                echo '</ul>'."\n";
                echo '</div>'."\n";
              }


              echo $pagination;
            ?>
          
<!-- 
             <div class="sidebar-nav">
              <div class="nav-header" data-toggle="collapse" data-target="#menu1"><i class="fa fa-arrow-circle-down"></i>&nbsp&nbsp2016-03-15&nbsp&nbsp周二&nbsp&nbsp第3大节&nbsp&nbsp高等数学（下）&nbsp&nbspB130108，B130109，B130110&nbsp&nbsp最低到课率：85.30%</div>
                <ul id="menu1" class="nav nav-list collapse in">
                <div class="block-body">
                  <p>课程名称：高等数学（下）</p>
                  <p>上课时间：2016-03-15&nbsp&nbsp周二&nbsp&nbsp第3大节</p>
                  <p>周数情况：第4周（双周）</p>
                  <p>上课教室：2-102</p>
                  <p>任课教师：方垣闰</p>
                  <p>所上班级：B130108，B130109，B130110</p>
                  <table class="table-condensed" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="138"><p align="center">账号类型</p></td>
                      <td width="138"><p align="center">录入账号</p></td>
                      <td width="138"><p align="center">实到人数 </p></td>
                      <td width="138"><p align="center">到课率 </p></td>
                      <td width="160"><p align="center">录入时间 </p></td>
                    </tr>
                    <tr>
                      <td width="138"><p align="center">班级 </p></td>
                      <td width="138"><p align="center">B130108 </p></td>
                      <td width="138"><p align="center">30</p></td>
                      <td width="138"><p align="center">60%</p></td>
                      <td width="160"><p align="center">2016-03-15 20:35:41</p></td>
                    </tr>
                    <tr>
                      <td width="138"><p align="center">查课员 </p></td>
                      <td width="138"><p align="center">B13010812 </p></td>
                      <td width="138"><p align="center">30</p></td>
                      <td width="138"><p align="center">60%</p></td>
                      <td width="160"><p align="center">2016-03-15 20:35:41</p></td>
                    </tr>
                  </table>
                </div>
                </ul>
             </div> -->


        </div>
    </div>