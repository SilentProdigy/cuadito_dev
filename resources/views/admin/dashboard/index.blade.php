@extends('layouts.admin-layout')
@section('page_title', 'Dashboard')

@section('content')
<div class="container px-5">
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