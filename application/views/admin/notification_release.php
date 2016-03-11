<div class="span9">
            <h1 class="page-title">公告发布页面</h1>

<div class="well">
    <form id="tab" action="" method="post" onSubmit="return check()">
        <label>目前时间：<?php echo date('Y-m-d H:i:s',time())?></label>     
        <label>需要发布内容：</label>
        <textarea rows="3" id="notification_content" name="notification_content" class="input-xlarge"></textarea>
        <label>选择公告发布对象：</label>
          <label>
          <input type="radio" checked="checked" name="notification_target" value="class" />班级
          <input type="radio" name="notification_target" value="teacher" />教师
          <input type="radio" name="notification_target" value="student" />查课员
          </label>
        <input name="submit" type="submit" value="发布" class="btn btn-primary pull-letf">
    </form>
</div>


        </div>
    </div>
