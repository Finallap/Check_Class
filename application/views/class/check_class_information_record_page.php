        <div class="span9">
            <h1 class="page-title">查课信息录入</h1>
<div class="btn-toolbar">
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">信息录入</a></li>
      <li><a href="<?php echo base_url('')?>">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form id="tab" action="" method="post" onSubmit="return check()">
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
          if(!is_null($course))
            echo "我们班现在并没有课程，好好潇洒吧o(*////▽////*)q";
          else
          {
            echo "<label>目前课程名称：".$course[0]['course_name']."</label>\n";
            echo "<label>目前上课教室：".$course[0]['class_room']."</label>\n";
            echo "<label>任课教师：".$course[0]['tercher_name']."</label>\n";
            echo "<label>选课人数：".$course[0]['choices_number']."</label>\n";
          }
        ?>
    </form>
      </div>
  </div>

</div>


        </div>
    </div>