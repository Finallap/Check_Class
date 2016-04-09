    <div class="span9">
      <h1 class="page-title">课程信息管理</h1>

      <div class="block">
          <p class="block-heading">共<?php echo $all_count;?>条记录，查询导符合条件的记录<?php echo $count;?>条！可进行记录筛选：</p>
          <div class="block-body">
              <div class="row-fluid">
                  <form action="" method="get">
                   <label>教学楼编号</label>
                    <select id="teaching_building" name="teaching_building" onchange="selectschool(this);" class="input-xlarge"></select>
                    <label>教室编号</label>
                    <select id="classroom" name="classroom" class="input-xlarge"></select>
                    <br>
                    <button type="submit" name="" value="send" class="btn btn-primary" onclick="GetRequest()">检索</button> 
                  </form>
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
</div>