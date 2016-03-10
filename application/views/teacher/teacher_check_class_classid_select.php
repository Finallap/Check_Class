 <div class="span9">
            <h1 class="page-title">查课信息录入</h1>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">班级选择</a></li>
      <li><a href="<?php echo base_url('student/')?>">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form id="tab" action="<?php echo base_url('teacher/data_entry_middleware')?>" method="post" onSubmit="return check()">
        <label>所属学院：<?php echo $college_name;?></label>
        <label>行政班班号</label>
        <?php echo $class_select;?>
        <br>
        <input name="submit" type="submit" value="查询课程，并进行录入" class="btn btn-primary">
    </form>
      </div>
  </div>

</div>


        </div>
    </div>