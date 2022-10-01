<style>
#container {
    height: 400px;
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
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
    <form action="" method="post" name="add_name" id="add_name" enctype="multipart/form-data">
		<div class="row" id="div1" style="">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="id">Month</label>
					<select class="form-control" id="supplier_name" name="supplier_name" required onchange="">
						<option value="">Select</option>
					</select>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="id">Year</label>
					<select class="form-control" id="supplier_name" name="supplier_name" required onchange="">
						<option value="">Select</option>
					</select>
				</div>
			</div>
		</div>
	</form>
	<div id="container"></div>
    <p class="highcharts-description"> </p>

    <table id="datatable" style="display:none">
        <thead>
            <tr>
                <th></th>
                <th>Received</th>
                <th>Consumed</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Rod</th>
                <td>7</td>
                <td>4</td>
            </tr>
            <tr>
                <th>Cement</th>
                <td>2</td>
                <td>1</td>
            </tr>
            <tr>
                <th>Paint</th>
                <td>25</td>
                <td>11</td>
            </tr>
            <tr>
                <th>Bricks</th>
                <td>6</td>
                <td>1</td>
            </tr>
            <tr>
                <th>Sand</th>
                <td>8</td>
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
        text: 'Yearly Overview of Received & Consumed'
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