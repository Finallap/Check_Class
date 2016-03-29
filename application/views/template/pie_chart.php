<script>
$(function () {
    $('<?php echo '#'.$chart_id;?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '<?php echo $title;?>'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        credits: {
             enabled: false
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
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