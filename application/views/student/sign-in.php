    <div class="navbar">
<div class="navbar-inner">
            <div class="container-fluid">
            	<a class="brand" href=""><img src="<?php echo base_url('assets/images/logo.png')?>" width="195" height="22"></a>
                <ul class="nav pull-right">
                
                <li id="fat-menu" class="dropdown">
                    <a href="<?php echo base_url('')?>" id="drop3" role="button" class="dropdown-toggle">
                        返回首页
                    </a>
                </li>
                    
              </ul>

          </div>
      </div>
    </div>


    <script type="text/javascript"> 
    function check()
    {
        if(document.getElementById("student_id").value == ""){  
            alert("学号不能为空!"); 
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
                <form action="<?php echo base_url('student_login')?>" method="post" onSubmit="return check()">
                    <label>学生学号</label>
                    <input type="text" name="student_id" id="student_id" class="span12">
                    <label>密码</label>
                    <input type="password"  name="password" id="password" class="span12">
                    <input name="submit" type="submit" value="登陆" class="btn btn-primary pull-right">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <p>&nbsp;</p>
    </div>
</div>