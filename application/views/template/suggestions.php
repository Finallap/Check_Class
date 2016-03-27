<div class="span9">
            <h1 class="page-title">建议及问题反馈</h1>

<div class="block">
    <p class="block-heading">发布反馈</p>
    <div class="block-body">
      <form id="tab" action="" method="post" onSubmit="return check()">   
          <label>需要反馈内容：</label>
          <textarea rows="4" id="suggestions_content" name="suggestions_content" class="input-xlarge"></textarea>
          <label>选择反馈类型：</label>
            <label>
            <input type="radio" checked="checked" name="suggestions_type" value="advise" />建议
            <input type="radio" name="suggestions_type" value="error" />系统错误
            <input type="radio" name="suggestions_type" value="other" />其他反馈
            </label>
          <input name="submit" type="submit" value="发布" class="btn btn-primary pull-letf" onclick= "if(confirm( '请确认是否发送反馈？ ')==false)return   false; ">
      </form>
    </div>
</div>


        </div>
    </div>
