<div class="span9">
            <h1 class="page-title">目前反馈情况</h1>

<div class="block">
    <p class="block-heading">共<?php echo $all_count;?>条记录！可进行查看：</p>
    <div class="block-body">
      <div class="row-fluid">
      <?php
        function type_process($type_name)
        {
          switch ($type_name) {
            case 'advise':
              return '建议';
              break;
            case 'error':
              return '系统错误';
              break;
            case 'other':
              return '其他反馈';
              break;
            default:
              return '其他反馈';
              break;
          }
        }

        $suggestions_count = count($suggestions_array);
        $count = 0;
        foreach ($suggestions_array as $key => $value) 
        {
            $type = type_process($value['suggestions_type']);
            echo '<p>'.$value['rownum'].'.'.$value['suggestions_content'].'</p>'."\n";
            echo '<p class="pull-right">'.'类型：'.$type.'<br>发布人：'.$value['release_account'].'<br>发布于：'.$value['release_time'].'</p>'."\n";
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