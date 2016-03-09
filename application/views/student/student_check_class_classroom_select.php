   <div class="span9">
            <h1 class="page-title">查课信息录入</h1>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">教室选择</a></li>
      <li><a href="<?php echo base_url('student/')?>">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form id="tab" action="<?php echo base_url('student/data_entry_middleware')?>" method="post" onSubmit="return check()">
        <label>教学楼编号</label>
        <select id="teaching_building" name="teaching_building" onchange="selectschool(this);" class="input-xlarge"></select>
        <label>教室编号</label>
        <select id="classroom" name="classroom" class="input-xlarge"></select>
        <br>
        <button type="submit" name="" value="send" class="btn btn-primary">查询课程，并进行录入</button>
    </form>
      </div>
  </div>

</div>


        </div>
    </div>