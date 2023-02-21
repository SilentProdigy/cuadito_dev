@extends('layouts.dashboard-layout')

@section('content')
<div class="container px-5" id="data-container" data-chart-info='@json($chart_data)'>
  <div class="row">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Overview</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-blue">
            <div class="inner">
                <h3> {{ $projects_count }} </h3>
                <p> Projects </p>
            </div>
            <div class="icon">
                <i class="fa fa-clipboard-list" aria-hidden="true"></i>
            </div>
            <a href="{{ route('admin.projects.index') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-green">
            <div class="inner">
                <h3>@money($payment_total)</h3>
                <p> Total Sales </p>
            </div>
            <div class="icon">
                <i class="fa fa-money" aria-hidden="true"></i>
            </div>
            <a href="{{ route('admin.payments.index') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-orange">
            <div class="inner">
                <h3> {{ $biddings_count }} </h3>
                <p> Bids </p>
            </div>
            <div class="icon">
                <i class="fa fa-handshake" aria-hidden="true"></i>
            </div>
            <a href="{{ route('admin.proposals.index') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-red">
            <div class="inner">
                <h3> {{ $clients_count }} </h3>
                <p> Total Clients </p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('admin.clients.index') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row d-align-items-center justify-content-center">
            <span class="table-titles">List of Projects</span>
            <div class="col d-flex justify-content-end">
                <a href="{{ route('admin.projects.index') }}" class="btn">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>  
          </div>
          
        </div>
        <ul class="list-group list-group-flush">
          @foreach ($projects as $item)
            <li class="d-flex justify-content-between list-group-item">
              <div class="col-2 dashboard-proj-img">
                <img src="{{ asset('images/company_logo/cov.png') }}">
              </div>
              <div class="col-10 p-2">
                <span class="dashboard-proj-name">{{ $item->title }}</span><br>
                <span class="dashboard-proj-company text-muted">{{ $item->company->name }}</span>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="col-md-8">
      <div class="rounded-lg overflow-hidden">
        <div class="py-3 px-5 bg-gray-50 table-titles">Projects Analytics</div>
        <canvas class="p-10" id="chartBar"></canvas>
      </div>
    </div>
  </div>
</div>
    {{-- <div class="row m-5">
                <div class="col-md-4">
                    <div class="shadow-lg rounded-lg overflow-hidden">
                    <div class="py-3 px-5 bg-gray-50">Projects Analytics</div>
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
            </div> --}}
@endsection

@section('script')
<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart doughnut -->
<script>
  const dataDoughnut = {
    labels: ["JavaScript", "Python", "Ruby"],
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

  let chart_data = document.getElementById('data-container');
  chart_data = chart_data.getAttribute('data-chart-info');   
  chart_data = JSON.parse(chart_data);


  const labelsBarChart = chart_data.map(item => item.month_str);

  const data = chart_data.map(item => item.data);

  const dataBarChart = {
    labels: labelsBarChart,
    datasets: [
      {
        label: "Projects",
        backgroundColor: "#f96b23",
        borderColor: "hsl(252, 82.9%, 67.8%)",
        data,
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