          <div class="block">
            <p class="block-heading">今日到课率最低排行</p>
                <div class="block-body">
                  <p>日期：<?php echo date("Y-m-d");?></p>
                  <p>今日已录入<?php echo $today_data_count;?>节课查课信息！</p>

                    <?php
                      /**
                       * 指定位置插入字符串
                       * @param $str  原字符串
                       * @param $i    插入位置
                       * @param $substr 插入字符串
                       * @return string 处理后的字符串
                       */
                      function insertToStr($str, $i, $substr)
                      {
                        //指定插入位置前的字符串
                        $startstr="";
                        for($j=0; $j<$i; $j++)
                        {
                            $startstr .= $str[$j];
                        }
                          
                        //指定插入位置后的字符串
                        $laststr="";
                        for ($j=$i; $j<strlen($str); $j++){
                            $laststr .= $str[$j];
                        }
                          
                        //将插入位置前，要插入的，插入位置后三个字符串拼接起来
                        $str = $startstr . $substr . $laststr;
                          
                        //返回结果
                        return $str;
                      }

                      function class_list_process($class_list)
                      {
                        $len = strlen($class_list);
                        $i=24;
                        while ($i < $len)
                        {
                          $class_list = insertToStr($class_list, $i, "\n");
                          $i+=25;
                        }
                        return $class_list;
                      }

                      if($course_list)
                      {
                        $table_header = <<<EOF
                    <table class="table" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="50"><p align="center">排名</p></td>
                      <td width="200"><p align="center">课程名称 </p></td>
                      <td width="100"><p align="center">节数 </p></td>
                      <td width="80"><p align="center">教室 </p></td>
                      <td width="140"><p align="center">所上班级 </p></td>
                      <td width="60"><p align="center">应到人数 </p></td>
                      <td width="60"><p align="center">实到人数 </p></td>
                      <td width="80"><p align="center">到课率 </p></td>
                    </tr>
EOF;
                        echo "<p>其中到课率最低排行如下：</p>";
                        echo $table_header;
                        $rank=1;
                        foreach ($course_list as $key => $course_detail) 
                        {
                          if ($course_detail['class_rate_min']==0)continue;

                          echo "<tr>\n";
                          echo '<td width="50"><p align="center">'.$rank.'</p></td>';
                          echo '<td width="200"><p align="center">'.$course_detail['course_name'].'</p></td>'."\n";
                          echo '<td width="100"><p align="center">'.'第'.$course_detail['class_time'].'大节</p></td>'."\n";
                          echo '<td width="80"><p align="center">'.$course_detail['classroom'].'</p></td>'."\n";
                          echo '<td width="140"><p align="center">'.class_list_process($course_detail['class_list']).'</p></td>'."\n";
                          echo '<td width="60"><p align="center">'.$course_detail['choices_number'].'</p></td>'."\n";
                          echo '<td width="60"><p align="center">'.$course_detail['real_number_min'].'</p></td>'."\n";
                          echo '<td width="80"><p align="center">'.$course_detail['class_rate_min'].'</p></td>'."\n";
                          echo "</tr>\n";

                          if($rank>=20)break;
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