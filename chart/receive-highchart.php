<style>
#container {
    height: 380px;
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
}
.highcharts-credits{
	display:none;
}
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    
	<div id="container"></div>
    <p class="highcharts-description"> </p>

    <table id="datatable" style="display:none">
        <thead>
            <tr>
                <th></th>
                <th>Receive</th>
                <th>Sale</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>INDONESIAN STEAM COAL CRUSHED</th>
                <td>7</td>
                <td>4</td>
            </tr>
        </tbody>
    </table>
</figure>
<script>
Highcharts.chart('container', {
    data: {
        table: 'datatable'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Yearly Overview of Receive & Sale'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Units'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    }
});
</script>