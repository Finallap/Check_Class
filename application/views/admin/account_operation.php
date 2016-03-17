<div class="span9">
            <div class="faq-content">
    <h1 class="page-title">账号信息修改</h1>
    <div class="row-fluid">
        <div class="span9">
          <div class="block">
            <p class="block-heading">账号信息</p>
                <div class="block-body">
                  <p>登陆账号：<?php echo $account;?></p>
                  <p>账号类型：<?php echo $type;?></p>
                  <p>使用者姓名：<?php echo $user_name;?></p>
                  <p>所属学院：<?php echo $college_name;?></p>
                  <p>累计登陆次数：<?php echo $login_count;?></p>
                  <p>上次登陆时间：<?php echo $current_login_time;?></p>
                </div>
          </div>

             <div class="block">
              <p class="block-heading">账号操作</p>
                <div class="block-body">

                <table class="table">
                  <thead>
                    <tr>
                      <th>操作动作</th>
                      <th>面试情况</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>密码重置</td>
                      <td>
                       <a href="<?php echo base_url('admin/reset_password_'.$account_type.'?id='.$account); ?>" class="btn btn-primary" onclick= "if(confirm( '是否确定重置该账号密码？ ')==false)return   false; ">重置</a>
                      </tr>

                    <tr>
                      <td>删除注册</td>
                      <td>
                        <a href="<?php echo base_url('admin/delete_'.$account_type.'?id='.$account); ?>" class="btn btn-primary" onclick= "if(confirm( '是否确定删除该账号？ ')==false)return   false; ">删除</a>
                      </td>
                      </tr>
                  </tbody>
                </table>

                </div>
            </div>

             <div class="block">
              <p class="block-heading">最近十次登陆信息</p>
                <div class="block-body">
                <div class="row-fluid">
                  <?php echo $table;?>
                  </div>
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
    
