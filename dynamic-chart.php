<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<br/><!-- Just so that JSFiddle's Result label doesn't overlap the Chart -->
<select class="dropdown" id="dd">
    <option value="" selected="selected">Select Serial Number</option>
    <option value="dps1">DataPoints 1</option>
    <option value="dps2">DataPoints 2</option>
    <option value="dps3">DataPoints 3</option>
    <option value="dps4">DataPoints 4</option>
    <option value="dps5">DataPoints 5</option>
</select>
<div id="chartContainer" style="height: 360px; width: 100%;"></div>
<script>
var jsonData = {
"dps1": [
    { "x": "2016-6-25 12:58:52", "y": 10.22 },
    { "x": "2016-7-25 13:33:23", "y": 11.14 },
    { "x": "2016-8-25 13:49:18", "y": 85.58 },
    { "x": "2016-9-25 13:55:01", "y": 15.25 },
    { "x": "2016-10-25 14:00:15", "y": 17.25 },
],
"dps2": [
     { "x": "2016-6-25 12:58:52", "y": 19.99 },
     { "x": "2016-7-25 13:33:23", "y": 21.78 },
     { "x": "2016-8-25 13:49:18", "y": 23.45 },
     { "x": "2016-9-25 13:55:01", "y": 24.73 },
     { "x": "2016-10-25 14:00:15", "y": 26.58 }
],
"dps3": [
    { "x": "2016-6-25 12:58:52", "y": 27.66 },
    { "x": "2016-7-25 13:33:23", "y": 28.68 },
    { "x": "2016-8-25 13:49:18", "y": 30.73 },
    { "x": "2016-9-25 13:55:01", "y": 32.46 },
    { "x": "2016-10-25 14:00:15", "y": 34.79 }
],
"dps4": [
    { "x": "2016-6-25 12:58:52", "y": 10.22 },
    { "x": "2016-7-25 13:33:23", "y": 11.14 },
    { "x": "2016-8-25 13:49:18", "y": 15.25 },
    { "x": "2016-9-25 13:55:01", "y": 19.99 },
    { "x": "2016-10-25 14:00:15", "y": 21.78 }
],
"dps5": [
    { "x": "2016-6-25 12:58:52", "y": 24.73 },
    { "x": "2016-7-25 13:33:23", "y": 26.58 },
    { "x": "2016-8-25 13:49:18", "y": 27.66 },
    { "x": "2016-9-25 13:55:01", "y": 28.68 },
    { "x": "2016-10-25 14:00:15", "y": 32.46 }
]}
var dataPoints = [];
var chart = new CanvasJS.Chart("chartContainer",
{
	axisX: {
  	valueFormatString: "D/MM h:mm",
    intervalType: 'month',
    interval: 1
  },
	data: [{
    showInLegend: true,
    type: 'column',
    //xValueFormatString:"D MM h:mm",
    xValueType: "dateTime",
    showInLegend: true,
    name: "series1",
    legendText: "EnergykWh",
    dataPoints: dataPoints // this should contain only specific serial number data

	}]
});

$( ".dropdown" ).change(function() {
	chart.options.data[0].dataPoints = [];
  var e = document.getElementById("dd");
	var selected = e.options[e.selectedIndex].value;
  dps = jsonData[selected];
  for(var i in dps) {
  	var xVal = dps[i].x;
    chart.options.data[0].dataPoints.push({x: new Date(xVal), y: dps[i].y});
  }
  chart.render();
});
</script>