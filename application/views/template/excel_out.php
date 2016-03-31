 <div class="span9">
            <h1 class="page-title">查课数据Excel导出</h1>

            <div class="block">
              <p class="block-heading">截止<?php echo date('Y-m-d H:i:s',time());?>，共<?php echo $all_count?>条查课记录！可进行Excel导出：</p>
                <div class="block-body">
                <div class="row-fluid">
                  <form action="<?php echo base_url($account_type.'/excel_out_action');?>" method="get">
                      <label>查询起始日期选择</label>
                      <input type="text" id="datepicker" name="start_day" value="<?php echo $start_day;?>" class="input-xlarge">
                      <br>
                      <label>查询结束日期选择</label>
                      <input type="text" id="datepicker_end" name="end_day" value="<?php echo $end_day;?>" class="input-xlarge">
                      <br>
                      <label>年级选择</label>
                      <?php echo $grade_select;?>
                      <br>
                      <button type="submit" name="" value="send" class="btn btn-primary" onclick="GetRequest()">导出Excel</button>
                  </form>
                  </div>
                </div>
            </div>

        </div>
    </div>