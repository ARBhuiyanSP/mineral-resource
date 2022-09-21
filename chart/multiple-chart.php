
<style>

</style>

<div class="col-xl-4 col-sm-4 mb-4">
	<div class="" id="container1"></div>
</div>
<div class="col-xl-4 col-sm-4 mb-4">
	<div class="" id="container2"></div>
</div>
<div class="col-xl-4 col-sm-4 mb-4">
	<div class="" id="container3"></div>
</div>







<select name="" id="select">
  <option value="Jan">January</option>
  <option value="Feb">February</option>
  <option value="Mar">March</option>
  <option value="Apr">April</option>
  <option value="May">May</option>
  <option value="Jun">June</option>
</select>

<pre id="data">Rod,1,2,3,9,12,33
Cement,5,6,7,4,23,8
Bricks,7,8,9,2,21,14</pre>

<script>
var csv = Papa.parse(document.getElementById('data').innerHTML);

Highcharts.chart('container1', {
	xAxis: {
	type: 'category'
	},
	title: {
		text: 'Material Received in 2021'
	},
	series: [{
	type: 'bar',
	name: 'Received',
	data: [
	  ['Rod', 35],
	  ['Cement', 45],
	  ['Bricks', 29]
	],
	keys: ['name', 'y']
	}],
});

Highcharts.chart('container2', {
  xAxis: {
    type: 'category'
  },
	title: {
		text: 'Material Issued in 2021'
	},
  series: [{
    type: 'pie',
    name: 'Issued',
    data: [
      ['Rod', 35],
      ['Cement', 45],
      ['Bricks', 70]
    ],
    keys: ['name', 'y']
  }],
});

Highcharts.chart('container3', {
  xAxis: {
    type: 'category'
  },
	title: {
		text: 'Material Stock in 2021'
	},
  series: [{
    type: 'line',
    name: 'Instock',
    data: [
      ['Rod', 35],
      ['Cement', 45],
      ['Bricks', 29]
    ],
    keys: ['name', 'y']
  }],
});


var select = document.getElementById('select');

select.addEventListener('change', (e) => {
  var month = e.target.value;
  var monthsArr = Highcharts.defaultOptions.lang.shortMonths;
  var monthIndex = monthsArr.indexOf(month) + 1;
  var data = [];

  for (var j = 0; j < csv.data.length; j++) {
    data.push([
      csv.data[j][0], +csv.data[j][monthIndex]
    ]);
  }

  Highcharts.charts.forEach((chart) => {
    chart.series[0].update({
      data: data
    }, false, false, false);

    chart.redraw();
  });
});

</script>