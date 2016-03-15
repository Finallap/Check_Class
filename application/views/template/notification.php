    <div class="block">
              <p class="block-heading">目前<?php echo $notification_target?>最新公告</p>
                <div class="block-body">
                <div class="row-fluid">
                <?php
                  $notification_count = count($notification);
                  $count = 0;
                	foreach ($notification as $key => $value) 
                	{
                  		echo '<p>'.$value['rownum'].'.'.$value['notification_content'].'</p>'."\n";
          						echo '<p class="pull-right">'.$value['release_account'].'发布于'.$value['release_time'].'</p>'."\n";
                      $count++;
                      if($count<$notification_count)
          						    echo '<br><hr/>'."\n";
                	}
                ?>
                  </div>
                </div>
            </div>