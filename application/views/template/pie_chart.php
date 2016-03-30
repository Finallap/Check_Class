<script>
$(function () {
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
    return {
        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
        stops: [
            [0, color],
            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
        ]
    };
});
    $('<?php echo '#'.$chart_id;?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        credits:{
                enabled:false // 禁用版权信息
        },
        title: {
            text: '<?php echo $title;?>'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    // distance: -100,
                    connectorColor: '#000000',
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: '<?php echo $name;?>',
            data: [
                <?php
                    $output = NULL;
                    foreach ($data_array as $key => $value)
                    {
                        if($value['data']==0)
                            continue;
                        else
                            $output .= "['".$value['data_name']."',".$value['data']."],";
                    }
                    echo substr($output,0,strlen($output)-1); 
                ?>
            ]
        }]
    });
});	
</script>