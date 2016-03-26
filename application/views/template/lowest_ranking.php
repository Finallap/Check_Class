          <div class="block">
            <p class="block-heading">今日到课率最低排行</p>
                <div class="block-body">
                  <p>日期：<?php echo date("Y-m-d");?></p>
                  <p>今日已录入查课信息50条，与28节课相关！其中到课率最低排行如下：</p>

                    <?php
                      if($course_list)
                      {
                        $table_header = <<<EOF
                    <table class="table-condensed" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="138"><p align="center">排名</p></td>
                      <td width="138"><p align="center">课程名称 </p></td>
                      <td width="138"><p align="center">上课时间 </p></td>
                      <td width="138"><p align="center">所上班级 </p></td>
                      <td width="138"><p align="center">应到人数 </p></td>
                      <td width="138"><p align="center">实到人数 </p></td>
                      <td width="138"><p align="center">到课率 </p></td>
                    </tr>
EOF;

                        echo $table_header;
                        $rank=1;
                        foreach ($course_list as $key => $course_detail) 
                        {
                          if ($course_detail['class_rate_min']==0)continue;

                          echo "<tr>";
                          echo '<td width="138"><p align="center">'.$rank.'</p></td>';
                          echo '<td width="138"><p align="center">'.$course_detail['course_name'].'</p></td>';
                          echo '<td width="138"><p align="center">'.'第'.$course_detail['class_time'].'大节</p></td>';
                          echo '<td width="138"><p align="center">'.$course_detail['class_list'].'</p></td>';
                          echo '<td width="138"><p align="center">'.$course_detail['choices_number'].'</p></td>';
                          echo '<td width="138"><p align="center">'.$course_detail['real_number_min'].'</p></td>';
                          echo '<td width="138"><p align="center">'.$course_detail['class_rate_min'].'</p></td>';
                          echo "</tr>";

                          $rank++;
                        }

                        echo '</table>';
                      }
                      else
                      {
                        echo '<p>未查询到该时间段内的查课信息，可能是还没录入吧(′д｀ )…彡…彡</p>'."\n";
                      }
                    ?>
                  
                </div>
          </div>