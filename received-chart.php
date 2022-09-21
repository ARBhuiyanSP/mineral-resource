
<!------------------chart content start----------------->
<!------------------chart content start----------------->
<!------------------chart content start----------------->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style>
.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    /* max-width: 800px; */
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	/* max-width: 500px; */
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
.highcharts-credits{
	display:none;
}
</style>
<figure class="highcharts-figure">
    <div id="container"></div>
</figure>
<script>
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Materials Received in Chart. 2021'
    },
    subtitle: {
        text: 'Click the columns to view details.'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Qty of Materials'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
    },

    series: [
        {
            name: "Materials",
            colorByPoint: true,
            data: [
          
				<?php $sql	=	"SELECT category_id FROM `qry_inv_receive`  GROUP BY `category_id`"; $result = mysqli_query($conn, $sql); while($row=mysqli_fetch_array($result)) { ?>
				
				{
                    name: "<?php $dataresult =   getDataRowByTableAndId('inv_materialcategorysub', $row['category_id']); echo (isset($dataresult) && !empty($dataresult) ? $dataresult->category_description : ''); ?>",
                    y: 550,
                    drilldown: "<?php $dataresult =   getDataRowByTableAndId('inv_materialcategorysub', $row['category_id']); echo (isset($dataresult) && !empty($dataresult) ? $dataresult->category_description : ''); ?>"
                },
                <?php } ?>
            ]
        }
    ],
    drilldown: {
        series: [
            <?php $sqlcat	=	"SELECT category_id FROM `qry_inv_receive`  GROUP BY `category_id`"; $resultcat = mysqli_query($conn, $sqlcat); while($rowcat=mysqli_fetch_array($resultcat)) { ?>
			
			{
                name: "<?php $dataresult =   getDataRowByTableAndId('inv_materialcategorysub', $rowcat['category_id']); echo (isset($dataresult) && !empty($dataresult) ? $dataresult->category_description : ''); ?>",
                id: "<?php $dataresult =   getDataRowByTableAndId('inv_materialcategorysub', $rowcat['category_id']); echo (isset($dataresult) && !empty($dataresult) ? $dataresult->category_description : ''); ?>",
                data: [
                    <?php 
					$category_id =$rowcat['category_id']; 
					$sqlmat	=	"SELECT * FROM `qry_inv_receive` WHERE `category_id`='$category_id'"; 
					$resultmat = mysqli_query($conn, $sqlmat); 
					while($rowmat=mysqli_fetch_array($resultmat)) { 
					?>
					
					[
                        "OPC",
                        250
                    ],
					<?php } ?>
                ]
            },
			
			<?php } ?>
			
        ]
    }
});
</script>
<!------------------chart content end----------------->
<!------------------chart content end----------------->
<!------------------chart content end----------------->
