    <script type="text/javascript"> 	
		function check()
		{
            if(document.getElementById("college").value == "-1"){  
                alert("请选择学院!"); 
				return false;  
            }
			else if(document.getElementById("account").value == ""){  
                alert("登陆账号不能为空!"); 
				return false;  
            }
			else if(document.getElementById("account_name").value == ""){  
                alert("用户姓名!"); 
				return false;  
            }
			else{ 
               return true;
            }  
        }
    </script>  

        <div class="span9">
            <h1 class="page-title">添加<?php echo $account_type;?>账户</h1>
<div class="btn-toolbar">
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">信息填写</a></li>
      <li><a href="<?php echo base_url('')?>">返回首页</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form id="tab" action="<?php echo base_url($action)?>" method="post" onSubmit="return check()">
        <label>登陆账号</label>
        <input type="text" name="account" id="account" value="" class="input-xlarge">
        <label>用户姓名</label>
        <input type="text" name="account_name" id="account_name" value="" class="input-xlarge">
        <label>选择学院</label>
        <?php echo $college_select;?>
        <label>增加账户类型：<?php echo $account_type;?></label>
        <label><input name="submit" type="submit" value="增加" class="btn btn-primary pull-letf"><label>

    </form>
      </div>
  </div>

</div>


        </div>
    </div>
