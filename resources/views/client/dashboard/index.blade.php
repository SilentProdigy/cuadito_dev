@extends('layouts.client-main-layout')

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
                    <h3>{{ $data['projects_count'] }}</h3>
                    <p> Projects </p>
                </div>
                <div class="icon">
                    <i class="fa fa-clipboard-list" aria-hidden="true"></i>
                </div>
                <a href="{{ route('client.projects.index') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-green">
                <div class="inner">
                    <h3>{{ $data['companies_count'] }}</h3>
                    <p> Companies </p>
                </div>
                <div class="icon">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
                <a href="{{ route('client.companies.index') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> {{ $data['biddings_count'] }} </h3>
                    <p> Biddings </p>
                </div>
                <div class="icon">
                    <i class="fa fa-handshake" aria-hidden="true"></i>
                </div>
                <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection