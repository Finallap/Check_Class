<div class="span9">
            <div class="faq-content">
    <h1 class="page-title">欢迎进入查课系统（教师版）</h1>
    <div class="row-fluid">
        <div class="span9">
          
          <?php echo $lowest_ranking;?>

          <?php echo $notification;?>
            
          <div class="block">
            <p class="block-heading">今日到课率统计</p>
              <div class="block-body">
                <div class="row-fluid">
                    <?php
                      if($today_data_count!=0)
                        echo '<div id="container" style="min-width:300px;height:300px"></div>'."\n";
                      else
                       echo '<p>今天还没有课程录入，抱歉(′д｀ )…彡…彡</p>'."\n";
                    ?>
                </div>
              </div>
          </div>
           
            <div class="block">
              <p class="block-heading">一些关于查课系统（教师版）的使用提示</p>
                <div class="block-body">
                    <h3>很高兴大家能使用查课系统（教师版），接下来我们一起阅读一些系统使用提醒吧~</h3>
                    <p>1.教师版本既可以录入到课信息，也可以查询导出到课信息（仅能查询所在学院的到课率信息）。</p>

                    <p>2.本系统录入后数据无法更改，请各位教师在录入之前确保数据输入无误，并确保输入课程能和实际课程对应。</p>

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
    
