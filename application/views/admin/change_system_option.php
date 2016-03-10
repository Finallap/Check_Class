<div class="span9">
            <h1 class="page-title">更改系统设置</h1>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">系统设置</a></li>
      <li><a href="<?php echo base_url('')?>">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form id="tab" action="<?php echo base_url('admin/change_system_option')?>" method="post" onSubmit="return check()">
        <label>目前学年（输入格式为：2015-16）</label>
        <input type="text" name="school_year" id="school_year" value="<?php echo $school_year?>" class="input-xlarge">
        <label>目前学期（输入格式为：1或2）</label>
        <input type="text" name="term" id="term" value="<?php echo $term?>" class="input-xlarge">
        <label>开学日期（输入格式为：2016-02-22）（请确保开学日期为第一周的周一）</label>
        <input type="text" id="datepicker" name="start_day" value="<?php echo $start_day?>" class="input-xlarge">
        <br>
        <input type="submit" value="修改系统时间" class="btn btn-primary pull-letf" onclick= "if(confirm( '错误的修改会导致系统崩溃，是否确定修改系统时间设置？')==false)return   false;" >
    </form>
      </div>
  </div>

</div>


        </div>
    </div>
