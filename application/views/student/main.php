<div class="span9">
            <div class="faq-content">
    <h1 class="page-title">欢迎进入查课系统（查课员版）</h1>
    <div class="row-fluid">
        <div class="span9">

          <?php echo $notification;?>
          
          
           <div class="block">
              <p class="block-heading">快速录入</p>
                <div class="block-body">
                      <div class="tab-pane active in" id="home">
                       <p>请选择教室查询课程并录入：</p>
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

           
            <div class="block">
              <p class="block-heading">一些关于查课系统的使用提示</p>
                <div class="block-body">
                    <h3>很高兴大家能使用线上查课系统（查课员版），接下来我们一起阅读一些系统使用提醒吧~</h3>
                    <p>1.查课员版本可以录入所有教师的查课信息。根据现在的时间和选择的教室，系统将会自动检索出目前课程信息，查课员只需填写实到人数和备注即可。</p>

                    <p>2.本系统录入后数据无法更改，请各位查课员在录入之前确保数据输入无误，并确保输入课程能和实际课程对应。</p>

                    <p>3.由于本系统开发仓促，虽然经过了大量测试，任然可能出现bug，请各位及时反映。</p>
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
    
