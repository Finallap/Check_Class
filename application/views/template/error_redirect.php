
<script language="JavaScript">
 function ok(){
    window.parent.parent.location.href="<?php echo base_url('')?>";
 }
 window.setTimeout("ok();",3000);
 function countDown(secs){
       jump.innerText=secs;
       if(--secs>0)
          setTimeout( "countDown(" +secs+ ")" ,1000);
    }
    countDown(3);
</script>    

    <div class="container-fluid">
        
        <div class="row-fluid">
    <div class="http-error">
        <h1><?php echo $information?></h1>
        <p class="info">3秒后返回首页</p>
        <p><i class="icon-home"></i></p>
        <p><a href="<?php echo base_url('')?>">点此立即返回</a></p>
    </div>
</div>