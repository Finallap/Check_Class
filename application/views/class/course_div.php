<div class="tab-pane active in" id="home">
    <form id="tab" action="<?php echo base_url('the_class/data_entry_action')?>" method="post" onSubmit="return check()">
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
        <label>登陆班级：<?php echo $class;?></label>
        
        <?php 
          if(empty($course))
            echo "我们班现在并没有课程，好好潇洒吧o(*////▽////*)q";
          else
          {
            echo "<label>目前课程名称：".$course[0]['course_name']."</label>\n";
            echo "<label>目前上课教室：".$course[0]['classroom']."</label>\n";
            echo "<label>班级组成：".$course[0]['class_list']."</label>\n";
            echo "<label>任课教师：".$course[0]['tercher_name']."</label>\n";
            // echo "<label>选课人数：".$course[0]['choices_number']."</label>\n";
            echo "<label>请输入实到人数:</label>";
            echo '<input type="text" name="real_number" id="real_number" value="" class="input-xlarge">';
            echo "<label>备注（选填）:</label>";
            echo '<input type="text" name="remark" id="remark" value="" class="input-xlarge">';
            echo '<label><input name="submit" type="submit" value="提交" class="btn btn-primary pull-letf"><label>';
          }
        ?>
    </form>
      </div>