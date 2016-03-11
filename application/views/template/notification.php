    <div class="block">
              <p class="block-heading">目前<?php echo $notification_target?>最新公告</p>
                <div class="block-body">
                <div class="row-fluid">
                <?php
                	foreach ($notification as $key => $value) 
                	{
                		echo '<p>'.$value['notification_content'].'</p>'."\n";
						echo '<p class="pull-right">'.$value['release_account'].'发布于'.$value['release_time'].'</p>'."\n";
						echo '<br><hr/>'."\n";
                	}
                ?>
                  <br><hr/>
                  </div>
                </div>
            </div>