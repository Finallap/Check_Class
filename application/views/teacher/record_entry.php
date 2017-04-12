    <script type="text/javascript">   
    function check()
    {
          var reg = new RegExp("^[0-9]*$");
          if(!/^[0-9]*$/.test(document.getElementById("real_number").value))
          {
              alert("请在实到人数框内输入数字!");
              return false;
          }
          else
          {
            if(document.getElementById("real_number").value == "")
            {  
                alert("请填写实到人数!"); 
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
            <h1 class="page-title">查课信息录入</h1>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">信息录入</a></li>
      <li><a href="<?php echo base_url('teacher/data_entry')?>">返回班级选择页面</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form id="tab" action="<?php echo base_url('teacher/data_entry_action')?>" method="post" onSubmit="return check()">
        <label>现在时间：<?php echo date('Y-m-d H:i:s',time());?></label>
        <label>目前学年：<?php echo $school_year;?></label>
        <label>目前学期：<?php echo $term;?></label>
        <label>目前周数：<?php echo $week;?></label>

        <label>
        <?php 
          if($odd_even=="even")echo "单双周情况：双周";
          else echo "单双周情况：单周";
        ?>
        </label>
        
        <label>
        <?php 
          if($class_time==0)echo "不在上课时间";
          else echo "现在第".$class_time."大节";
        ?>
        </label>

        <hr />
        <label>选择班级：<?php echo $class_id;?></label>
        <input type="hidden" name="class_id" value="<?php echo $class_id;?>">
         
        <?php 
          if(empty($course))
            echo "这个班级现在并没有课程，咱们换个班吧o(*////▽////*)q";
          else
          {
            echo "<label>目前课程名称：".$course[0]['course_name']."</label>\n";
            echo "<label>上课教室：".$course[0]['classroom']."</label>\n";
            echo "<label>班级组成：".$course[0]['class_list']."</label>\n";
            echo "<label>任课教师：".$course[0]['tercher_name']."</label>\n";
            echo "<label>选课人数：".$course[0]['choices_number']."</label>\n";
            echo "<label>请输入实到人数:</label>";
            echo '<input type="text" name="real_number" id="real_number" value="" class="input-xlarge">';
            echo "<label>请输入请假人数:</label>";
            echo '<input type="text" name="numberofleave" id="numberofleave" value="" class="input-xlarge">';
            echo "<label>备注（选填）:</label>";
            echo '<input type="text" name="remark" id="remark" value="" class="input-xlarge">';
            echo '<label><input name="submit" type="submit" value="提交" class="btn btn-primary pull-letf"><label>';
          }
        ?>
    </form>
      </div>
  </div>

</div>


        </div>
    </div>