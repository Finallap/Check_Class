<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>南京邮电大学查课系统———查课员版</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/bootstrap/css/bootstrap.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/theme.css'); ?>">
    <link href="http://oss.aifuwu.org/font-awesome/css/font-awesome.css" rel="stylesheet">

    <script src="<?php echo base_url('assets/lib/jquery-1.8.1.min.js'); ?>" type="text/javascript"></script>

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
      <script src="javascripts/html5.js"></script>
    <![endif]-->


  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7"> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8"> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9"> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 

    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//piwik.aifuwu.org/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 21]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <noscript><p><img src="//piwik.aifuwu.org/piwik.php?idsite=21" style="border:0;" alt="" /></p></noscript>
    <!-- End Piwik Code -->

  <body> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" href="<?php echo base_url('')?>"><img src="<?php echo base_url('assets/images/logo.png')?>" width="195" height="22"></a>
                <ul class="nav pull-right">
                  <li id="fat-menu" class="dropdown">
                      <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-user"></i> 方垣闰
                          <i class="fa fa-caret-down"></i>
                      </a>

                      <ul class="dropdown-menu">
                         <li><a tabindex="-1" href="<?php echo base_url('admin/data_entry')?>">查课情况录入</a></li>
                             <li><a tabindex="-1" href="<?php echo base_url('admin/data_query')?>">已录入信息</a></li>
                  <li><a tabindex="-1" href="<?php echo base_url('admin/login_situation')?>">登陆情况查看</a></li>
                          <li><a tabindex="-1" href="<?php echo base_url('admin/change_password')?>">个人密码修改</a></li>
                          <li class="divider"></li>
                          <li><a tabindex="-1" href="<?php echo base_url('sign_out')?>">注销</a></li>
                      </ul>
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
            <div class="span3">
                <div class="sidebar-nav">

                <div class="nav-header" data-toggle="collapse" data-target="#accounts-menu"><i class="fa fa-briefcase"></i>信息与查看与录入</div>
                <ul id="accounts-menu" class="nav nav-list collapse in">
                  <li><a tabindex="-1" href="<?php echo base_url('admin/data_entry')?>">查课情况录入</a></li>
                  <li><a tabindex="-1" href="<?php echo base_url('admin/data_query')?>">已录入信息</a></li>
                  <li><a tabindex="-1" href="<?php echo base_url('admin/login_situation')?>">登陆情况查看</a></li>
                </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#legal-menu"><i class="fa fa-wrench"></i>账号设置</div>
                <ul id="legal-menu" class="nav nav-list collapse in">
                 <li><a tabindex="-1" href="p<?php echo base_url('admin/change_password')?>">账号密码修改</a></li>
                </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu"><i class="fa fa-align-justify"></i>系统介绍</div>
                    <ul id="dashboard-menu" class="nav nav-list collapse in">
                      <li><a href="<?php echo base_url('system_description')?>">关于系统</a></li>    
                    </ul>
            </div>
        </div>