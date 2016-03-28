<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>密码修改页面</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="Shortcut Icon" href="<?php echo base_url('assets/images/icon.png')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/bootstrap/css/bootstrap.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/theme.css'); ?>">
    <link href="http://oss.aifuwu.org/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/lib/jquery-ui-1.11.4.custom/jquery-ui.min.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/lib/jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/lib/jquery-ui-1.11.4.custom/jquery-ui.min.js'); ?>"></script>

    <!-- Demo page code -->
    
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    
  <!-- Piwik -->
      <script type="text/javascript">
        var _paq = _paq || [];
        _paq.push(["setDomains", ["*.checkclass.aifuwu.org"]]);
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
          var u="//piwik.aifuwu.org/";
          _paq.push(['setTrackerUrl', u+'piwik.php']);
          _paq.push(['setSiteId', 24]);
          var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
          g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
      </script>
      <noscript><p><img src="//piwik.aifuwu.org/piwik.php?idsite=24" style="border:0;" alt="" /></p></noscript>
      <!-- End Piwik Code -->  

<script type="text/javascript">    
        function check()
        {
            if(document.getElementById("old_password").value == ""){  
                alert("请输入旧密码!"); 
                return false;  
            }
            else if(document.getElementById("password").value == ""){  
                alert("新密码不能为空!"); 
                return false;  
            }
            else if(document.getElementById("confirm_password").value == ""){  
                alert("确认密码不能为空!"); 
                return false;  
            }
            else if((document.getElementById("password").value.length<6)||(document.getElementById("password").value.length>16)){  
                alert("密码过长或过短，请介于6-16位之间!"); 
                return false;  
            }
            else if(document.getElementById("confirm_password").value != document.getElementById("password").value){  
                alert("两次输入密码不相同!"); 
                return false;  
            }
            else{ 
               return true;
            }  
        }
 </script>
    
  </head>

  <body> 
  <!--<![endif]-->

  <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" href="index.php"><img src="<?php echo base_url('assets/images/logo.png')?>" width="195" height="22"></a>
                <ul class="nav pull-right">
                <li id="fat-menu" class="dropdown">
                        <a href="<?php echo base_url('')?>" id="drop3" role="button" class="dropdown-toggle">
                             返回首页
                        </a>
                    </li>
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="<?php echo base_url('sign_out')?>" id="drop3" role="button" class="dropdown-toggle">
                             注销
                        </a>
                    </li>
                    
              </ul>

          </div>
        </div>
    </div>
    

    <div class="container-fluid">
        
        <div class="row-fluid">
    <div class="span4 offset4 dialog">
        <div class="block">
            <div class="block-heading">密码修改界面</div>
            <div class="block-body">
                <form action="<?php echo base_url('change_password/change_password_action')?>" method="post" onSubmit="return check()">
                    旧密码
                  <input type="password" name="old_password" id="old_password" class="span12">
                    <label>新密码</label>
                    <input type="password" name="password" id="password" class="span12">
                    <label>确认密码</label>
                    <input type="password" id="confirm_password" class="span12">
                    <input name="submit" type="submit" value="修改密码" class="btn btn-primary pull-right">
                    <a href="index.php"><input type="button" value="返回首页" class="btn pull-right"></input></a>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
       
    </div>
</div>
