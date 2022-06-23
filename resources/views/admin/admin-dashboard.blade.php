@extends('layouts.dashboard-layout')

@section('content')
<div class="row m-5">
	<div class="col-md-4">
		<div class="shadow-lg rounded-lg overflow-hidden">
		  <div class="py-3 px-5 bg-gray-50">Projects</div>
		  <canvas class="p-10" id="chartDoughnut"></canvas>
		</div>
	</div>
	<div class="col-md-8">
		<div class="shadow-lg rounded-lg overflow-hidden">
		  <div class="py-3 px-5 bg-gray-50">Bar chart</div>
		  <canvas class="p-10" id="chartBar"></canvas>
		</div>
	</div>
</div>
<div class="row mx-5">
	<div class="col-md-12">
		<div class="shadow-lg rounded-lg overflow-hidden">
		  <div class="py-3 px-5 bg-gray-50">Line chart</div>
		  <canvas class="p-10" id="chartLine"></canvas>
		</div>
	</div>
</div>
@endsection

@section('script')
<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart doughnut -->
<script>
  const dataDoughnut = {
    labels: ["Sample", "Python", "Ruby"],
    datasets: [
      {
        label: "My First Dataset",
        data: [300, 50, 100],
        backgroundColor: [
          "#d34807",
          "#ffdc2c",
          "#f96b23",
        ],
        hoverOffset: 4,
      },
    ],
  };

  const configDoughnut = {
    type: "doughnut",
    data: dataDoughnut,
    options: {},
  };

  var chartBar = new Chart(
    document.getElementById("chartDoughnut"),
    configDoughnut
  );
</script>
<!-- Label bar -->
<script>
  const labelsBarChart = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
  ];
  const dataBarChart = {
    labels: labelsBarChart,
    datasets: [
      {
        label: "My First dataset",
        backgroundColor: "#f96b23",
        borderColor: "hsl(252, 82.9%, 67.8%)",
        data: [0, 10, 5, 2, 20, 30, 45],
      },
    ],
  };

  const configBarChart = {
    type: "bar",
    data: dataBarChart,
    options: {},
  };

  var chartBar = new Chart(
    document.getElementById("chartBar"),
    configBarChart
  );
</script>

<!--Line Chart-->
<script>
  const labels = ["January", "February", "March", "April", "May", "June"];
  const data = {
    labels: labels,
    datasets: [
      {
        label: "My First dataset",
        backgroundColor: "#f96b23",
        borderColor: "#f96b23",
        data: [0, 10, 5, 2, 20, 30, 45],
      },
    ],
  };

  const configLineChart = {
    type: "line",
    data,
    options: {},
  };

  var chartLine = new Chart(
    document.getElementById("chartLine"),
    configLineChart
  );
</script>
@endsection