<?php include 'header.php' ?>
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Chart View</a>
        </li>
        <li class="breadcrumb-item active">Total Received in Chart</li>
		
    </ol>
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
    max-width: 800px;
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
	max-width: 500px;
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
    <p class="highcharts-description"> </p>
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
        text: 'Click the columns to view sub materials details.'
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
                {
                    name: "Cement",
                    y: 550,
                    drilldown: "Cement"
                },
                {
                    name: "Rod",
                    y: 800,
                    drilldown: "Rod"
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "Cement",
                id: "Cement",
                data: [
                    [
                        "OPC",
                        250
                    ],
                    [
                        "PCC",
                        300
                    ]
                ]
            },
            {
                name: "Rod",
                id: "Rod",
                data: [
                    [
                        "60W",
                        550
                    ],
                    [
                        "70G",
                        250
                    ]
                ]
            }
        ]
    }
});
</script>
<!------------------chart content end----------------->
<!------------------chart content end----------------->
<!------------------chart content end----------------->
</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>