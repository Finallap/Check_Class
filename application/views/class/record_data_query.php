<div class="span9">
            <h1 class="page-title">已录入查课信息查看</h1>

<div class="block">
      <p class="block-heading">截止<?php echo date('Y-m-d H:i:s',time());?>，本账号共录入<?php echo $all_count;?>条查课信息，具体如下：</p>
                <div class="block-body">
                <div class="row-fluid">
                  <?php echo $table;?>
                    <div class="clearfix"></div>
                  </div>
      </div>
          </div>

<div class="pagination">
   <?php echo $pagination?>
</div>

        </div>
    </div>
