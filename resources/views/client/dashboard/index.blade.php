@extends('layouts.client-main-layout')

@section('style')
<style>
    .proposal-label{
        font-size: 15px;
    }
</style>
@endsection

@section('content')
<div class="container px-5">
    <div class="row">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Overview</li>
          </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-6">
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
    
        <div class="col-lg-4 col-sm-6">
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
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> {{ $data['biddings_count'] }} </h3>
                    <p> Biddings </p>
                </div>
                <div class="icon">
                    <i class="fa fa-handshake" aria-hidden="true"></i>
                </div>
                <a href="{{ route('client.proposals.index') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($data['projects'] as $project)
                <div class="col-xs-4 {{ $data['projects_count'] >=3 ? 'col-md-4' : 'col-md-12' }}">
                    <div class="card my-3">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ $project->title }}</h5>
                                </div>
                                <div class="col d-flex justify-content-end proposal-label">
                                    <span class="text-muted">Proposals:</span>&nbsp;
                                    <span>
                                        {{ $project->proposals_count }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-3">
                            <p class="fw-bold fs-6 text-start">
                                <span class="px-1">{{ $project->company->name }}</span><br>
                                <span class="px-1">{{ $project->created_at->format('M d,Y') }} - {{ $project->max_active_date }}</span>
                            </ul>
                            <p class="card-text">
                                {!! $project->description_text !!}
                            </p>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('client.listing.show', $project) }}" class="btn btn-sm btn-outline-success px-3">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
</div>
@endsection

@section('script')

@endsection