<div class="span9">
            <div class="faq-content">
    <h1 class="page-title"><?php echo $account_type;?>账户管理页面</h1>
    <div class="row-fluid">
        <div class="span9">
          
<div class="block">
      <p class="block-heading">可进行账户添加：</p>
                <div class="block-body">
                <div class="row-fluid">
                点此进行添加：
                <a href="<?php echo base_url("admin/add_$type")?>"><button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>添加</button></a>
                    <div class="clearfix"></div>
                  </div>
      </div>
          </div>
                   
<div class="block">
      <p class="block-heading">共<?php echo $all_count;?>条记录，查询导符合条件的记录<?php echo $count;?>条！可进行记录筛选：</p>
                <div class="block-body">
                <div class="row-fluid">
                  <form action="" method="get">
                
    &emsp;学院：
        <?php echo $college_select;?>
          <button type="submit" name="" value="send" class="btn btn-primary" onclick="GetRequest()">检索</button>
                
                  </form>
                    <div class="clearfix"></div>
                  </div>
      </div>
          </div>
            
      <div class="well">
          <?php echo $table;?>
      </div>


      <div class="pagination">
            <?php echo $pagination?>
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
    
