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
          <h3>联系方式</h3>
          <h4>联系人：</h4>
           <p>王晶</p>
                <h4>联系电话：</h4>
                <p>18951810421</p>
                <h4>E-mail：</h4>
                <p>wjing@njupt.edu.cn</p>
                <h4>办公室地址：</h4>
                <address>
                学生事务服务中心大楼<br>
                三楼323室
                </address>
          </div>
        </div>
        
        
</div>
</div>

        </div>
    </div>
    
