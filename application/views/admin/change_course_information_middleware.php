    <script type="text/javascript">   
    function check()
    {
          var reg = new RegExp("^[0-9]*$");
          if(!/^[0-9]*$/.test(document.getElementById("choices_number").value))
          {
              alert("请在实到人数框内输入数字!");
              return false;
          }
          else
          {
            if(document.getElementById("choices_number").value == "")
            {  
                alert("请填写应到人数!"); 
                return false;  
            }
            else
            { 
                if(confirm( '提交之后无法修改，请确定是否提交？ ')==false)
                  return   false;
                else
                  return true;
            }  
          }
            
    }
    </script>        

        <div class="span9">
          <h1 class="page-title">课程信息操作</h1>

          <div class="well">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">信息修改</a></li>
                <li><a href="<?php echo base_url('admin/change_course_information')?>">返回课程信息管理页面</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
              <form id="tab" action="<?php echo base_url('admin/change_course_information_action')?>" method="post" onSubmit="return check()">
                  <label>课程编号：<?php echo $course_id;?></label>
                  <input type="hidden" name="course_id" value="<?php echo $course_id;?>">

                  <label>课程学年：<?php echo $school_year;?></label>
                  <label>课程学期：<?php echo $term;?></label>
                  <label>课程名称：<?php echo $course_name;?></label>
                  <label>课程教室：<?php echo $classroom;?></label>
                  <label>开始周数：第<?php echo $start_week;?>周</label>
                  <label>结束周数：第<?php echo $end_week;?>周</label>
                  <label>单双周情况：<?php echo odd_even_chinese($odd_even);?></label>
                  <label>每周上课时间：<?php echo weekday_chinese($weekday);?></label>
                  <label>上课节数:第<?php echo $class_time;?>大节</label>
                  <label>任课教师：<?php echo $tercher_name;?></label>

                  <label>应到人数：</label>
                  <input type="text" name="choices_number" id="choices_number" value="<?php echo $choices_number;?>" class="input-xlarge"> 

                  <br>
                  <input name="submit" type="submit" value="提交" class="btn btn-primary pull-letf">
                   
              </form>
                </div>
            </div>
          </div>


        </div>
    </div>

    <?php
      function weekday_chinese($weekday)
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

      function odd_even_chinese($odd_even)
      {
        switch ($odd_even) {
          case '0':
            return "不分单双周课程";
            break;
          case '1':
            return "单周课程";
            break;
          case '2':
            return "双周课程";
            break;
          default:
            return "不分单双周课程";
            break;
        }
      }
    ?>