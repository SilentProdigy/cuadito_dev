@extends('layouts.client-main-layout')

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
<style>
    .profile_info .btn{
        background-color: rgba(211, 211, 211, 0.5);
        box-shadow: none;
    }
    .profile_info .btn:hover{
        background-color: gray;
        color: #fff;
    }
    .profile_details i{
        margin-right: 10px;
    }
    .add-project-card{
        border: dashed #dfdfdf 2px;
        box-shadow: none;
        color: #dfdfdf;
    }
    .add-project-card:hover{
        border: dashed #bababa 2px;
        color: #bababa;
    }
</style>
@endsection

@section('content')
<div class="container-fluid user-profile">
    <div class="card profile-header">
        <div class="card-header image d-flex flex-column px-5">
            <img src="{{ $client->profile_picture_url }}" class="rounded-circle position-absolute" height="150" width="150" alt="Avatar" />
        </div>
        <div class="d-flex flex-row">
            <div class="card-body mt-5 mx-3 row">
                <div class="d-flex flex-column col-md-6">
                    <span class="name mt-3">{{ $client->name }}</span>
                    <span>{{ $client->tag_line }}</span>
                    @if( auth('client')->user()->id == $client->id )
                    <span>{{ $client->email }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    @if( auth('client')->user()->id == $client->id )
                    <a href="{{ route('client.profile.change-password.form', $client) }}" class="btn btn-sm btn-warning float-end shadow-none"><i class="fa fa-lock"></i>&ensp;Change Password</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto mt-5 my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card profile_info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-bold">About</h4>
                            @if( auth('client')->user()->id == $client->id )
                            <a href="{{ route('client.profile.edit', auth('client')->user()) }}" class="btn btn-md"><i class="fa fa-pencil"></i>&ensp;Edit Information</a>
                            @endif
                        </div>
                        <div class="profile_details row mt-4">
                            <div class="company_description">
                                <p>Cuadito is an online platform designed to help companies streamline their proposal and quotation process. It allows users to submit proposals, send quotations to other companies on the platform, and build stronger connections.
                                </p>
                            </div>
                            @if( auth('client')->user()->id == $client->id )
                                <h4 class="fw-bold">Personal Information</h4>
                                @if($client->contact_number || $client->address || $client->birth_date || $client->marital_status)
                                    <!-- <div class="col-12 mt-4"><i class="fa fa-briefcase fs-5"></i>Website Developer | 1MC Digital</div> -->
                                    
                                    @if($client->contact_number)
                                        <div class="col-12 mt-4"><i class="fa fa-phone-alt fs-5"></i>{{ $client->contact_number }}</div>
                                    @endif
                                    @if($client->address)
                                        <div class="col-12 mt-4"><i class="fa fa-location-dot fs-5"></i>{{ $client->address }}</div>
                                    @endif
                                    @if($client->birth_date)
                                        <div class="col-12 mt-4"><i class="fa fa-cake-candles fs-5"></i>{{ $client->birth_date }}</div>
                                    @endif
                                    @if($client->marital_status)
                                        <div class="col-12 mt-4"><i class="fa fa-heart fs-5"></i>{{ $client->marital_status }}</div>
                                    @endif
                                @else
                                    <p class="text-center text-muter">No information available.</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>


                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold">Projects</h4>
                        <a href="javascript:void(0);" class="fw-normal text-orange">View All</a>
                    </div>
                    <div class="row">
                        @foreach ($data['projects'] as $project)
                            <div class="col-xs-12 col-md-4 gy-3">
                                <div class="card h-100 my-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                <h5>{{ $project->title }}</h5>
                                            </div>
                                        </div>
                                        @foreach ($project->categories as $category)
                                            <span class="badge rounded-pill bg-dark">{{ $category->name }}</span>
                                        @endforeach
                                        <div class="fw-normal fs-6 text-muted">
                                            <i class="fa-sharp fa-solid fa-pen-to-square"></i> {{ $project->created_at->format('M d,Y') }}
                                        </div>
                                    </div>
                                    <div class="card-body px-3">
                                        <p class="card-text">
                                            {!! $project->description_text !!}
                                        </p>
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('client.listing.show', $project) }}" class="btn btn-sm btn-orange px-3">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-xs-12 col-md-4 gy-3">
                            <div class="card add-project-card h-100 my-3">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <a href="{{ route('client.projects.create') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#billing_history_table').DataTable({
           dom: 't'
        });
    });
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
@endsection