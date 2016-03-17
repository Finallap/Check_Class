<script>

$(document).ready(function(){
$( "#datepicker_end" ).datepicker({  
            dateFormat:'yy-mm-dd',  //更改时间显示模式  
            showAnim:"slide",       //显示日历的效果slide、fadeIn、show等  
            changeMonth:true,       //是否显示月份的下拉菜单，默认为false  
            changeYear:true,        //是否显示年份的下拉菜单，默认为false  
            showButtonPanel:true,   //是否显示取消按钮，并含有today按钮，默认为false  
            closeText:'清除',      //设置关闭按钮的值   
            clearStatus:'清除已选日期',
            closeText:'关闭',
            closeStatus:'不改变当前选择',
            prevText:'<上月',
            prevStatus:'显示上月',
            prevBigText:'<<',
            prevBigStatus:'显示上一年',
            nextText:'下月>',
            nextStatus:'显示下月',
            nextBigText:'>>',
            nextBigStatus:'显示下一年',
            currentText:'今天',
            currentStatus:'显示本月',
            monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            monthNamesShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            monthStatus:'选择月份',
            yearStatus:'选择年份',
            weekHeader:'周',
            weekStatus:'年内周次',
            dayNames:['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
            dayNamesShort:['周日','周一','周二','周三','周四','周五','周六'],
            dayNamesMin:['日','一','二','三','四','五','六'],
            dayStatus:'设置DD为一周起始',
            dateStatus:'选择m月d日，DD',
            firstDay:1,
            initStatus:'请选择日期',
            isRTL:false
            });
});
</script>