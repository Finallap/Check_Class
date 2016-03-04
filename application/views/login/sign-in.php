    <div class="navbar">
<div class="navbar-inner">
            <div class="container-fluid">
            	<a class="brand" href=""><img src="<?php echo base_url('assets/images/logo.png')?>" width="195" height="22"></a>
                <ul class="nav pull-right">
                    
              </ul>

          </div>
      </div>
    </div>


    <script type="text/javascript"> 
    function check()
    {
        if(document.getElementById("student_id").value == ""){  
            alert("账号不能为空!"); 
            return false;  
        }
        else if(document.getElementById("password").value == ""){  
            alert("密码不能为空!"); 
            return false;  
        }
        else{ 
            return true;
        }  
    }
    </script> 
    

    <div class="container-fluid">
        
        <div class="row-fluid">
    <div class="dialog span4">
        <div class="block">
            <div class="block-heading">登陆界面</div>
            <div class="block-body">
                <form action="<?php echo base_url('login/login_action')?>" method="post" onSubmit="return check()">
                    <label>账号</label>
                    <input type="text" name="account" id="account" class="span12">
                    <label>密码</label>
                    <input type="password"  name="password" id="password" class="span12">
                    <label>请选择登陆类型：</label>
                    <label>
                    <input type="radio" checked="checked" name="type" value="class" />班级
                    <input type="radio" name="type" value="teacher" />教师
                    <input type="radio" name="type" value="student" />查课员
                    <input type="radio" name="type" value="admin" />Admin
                    </label>
                    <input name="submit" type="submit" value="登陆" class="btn btn-primary pull-right">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <p>&nbsp;</p>
    </div>
</div>