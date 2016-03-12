<div class="span9">
            <div class="faq-content">
    <h1 class="page-title">欢迎进入查课系统（查课员版）</h1>
    <div class="row-fluid">
        <div class="span9">

          <?php echo $notification;?>
          
          
           <div class="block">
              <p class="block-heading">想导出报名汇总表了？</p>
                <div class="block-body">
                <div class="row-fluid">
                  <p>好多小鲜肉，快来戳这里导出信息总表吧~</p>
                <form action="summary_output.php" method="post">
                <label>导出志愿选择：</label>
                <select name="choice" id="choice">
                 	<option value="1">第一志愿</option>
          			<option value="2">第二志愿</option>
                </select>
                <input type="submit" value="导出签到表" class="btn btn-primary"/>
                </form> 
                  </div>
                </div>
            </div>
            

            <div class="block">
              <p class="block-heading">想录取小鲜肉了？</p>
                <div class="block-body">
                <div class="row-fluid">
                  <p>小鲜肉速速到碗里来，想让小鲜肉速速进入部门快来戳这里吧~</p>
                  <a href="interview_situation_input.php" class="btn btn-primary"><i class="icon-hand-right"></i> 面试情况录入</a>
                    <div class="clearfix"></div>
                  </div>
                </div>
            </div>
            
            
            
           
            <div class="block">
              <p class="block-heading">一些关于线上招新系统的使用提示</p>
                <div class="block-body">
                    <h3>很高兴大家能使用线上招新系统后台管理系统，接下来我们一起阅读一些系统使用提醒吧~</h3>
                    <p>1.本后台管理系统部门登陆后只能看到本部门报名人员的信息，且必须该同学已经确认提交报名信息。</p>

                    <p>2.本后台管理系统在录入面试信息的时候可以无限次修改，且有未录入选项，但请大家本着负责的态度来填写了~</p>

                    <p>3.本后台管理系统的信息查看和报名录入是分开的，在信息查看页面中有报名表导出，打开网页后在浏览器点击“打印”即可打印报名表。</p>
                </div>
            </div>
        </div>
        <div class="span3">
          <div class="well toc">
          <h3>联系我们</h3>
          <h4>微信公众号：</h4>
           <p>njuptservice</p>
                <h4>网址：</h4>
                <p><a href="http://www.aifuwu.org">http://www.aifuwu.org</a></p>
                <h4>E-mail：</h4>
                <p>aifuwu@aifuwu.org</p>
                <h4>地址：</h4>
                <address>
江苏省南京市栖霞区<br>
南京邮电大学仙林校区<br>
图书馆一楼学生事务中心大厅
</address>
                <div style="text-align: center;">
                    <a class="btn" href=""><img src="<?php echo base_url('assets/images/wechat.png')?>" width="25" height="25"></a>
                    <a class="btn" href="http://weibo.com/njuptaifuwu"><img src="<?php echo base_url('assets/images/sina.png')?>" width="25" height="25"></a>
                    <a class="btn" href="http://page.renren.com/601861848"><img src="<?php echo base_url('assets/images/renren.png')?>" width="25"></a>
                </div>
          </div>
        </div>
</div>
</div>

        </div>
    </div>
    
