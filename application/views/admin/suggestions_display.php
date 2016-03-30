<div class="span9">
            <h1 class="page-title">目前反馈情况</h1>

<div class="block">
    <p class="block-heading">共<?php echo $all_count;?>条记录！可进行查看：</p>
    <div class="block-body">
      <div class="row-fluid">
      <?php
        $suggestions_count = count($suggestions_array);
        $count = 0;
        foreach ($suggestions_array as $key => $value) 
        {
            echo '<p>'.$value['rownum'].'.'.$value['suggestions_content'].'</p>'."\n";
            echo '<p class="pull-right">'.$value['release_account'].'发布于'.$value['release_time'].'</p>'."\n";
            $count++;
            if($count<$suggestions_count)
                echo '<br><hr/>'."\n";
        }
      ?>
      </div>
    </div>
</div>


<div class="pagination">
      <?php echo $pagination?>
</div>

        </div>
    </div>