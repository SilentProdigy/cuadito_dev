@extends('layouts.client-layout')

@section('page_title', $client->name)

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
<style>
    .profile-header{width: 80%;}
    .profile-actions{display: inline-flex; align-items: center;}
    .profile-actions .btn-blue{
        font-size: 11px;
        padding: 5px 15px 5px 15px;
        vertical-align: middle;
        display: inline-flex;
        align-items: center;
        height: 30px;
    }
    #profile-tabs .nav-link.active{background-color: #F96B23; color: #fff; font-weight: bold;}
    #profile-tabs .nav-link:hover{color: #000}
    #profile-tabs .nav-link{
        height: 10px;
        vertical-align: middle;
        display: inline-flex;
        align-items: center;
    }
    .tab-pane{padding-top: 20px;}
    .btn-dark-gray{font-size: 11px; padding: 5px 15px;vertical-align: middle; display: inline-flex; align-items: center; height: 30px;align-self: center;}
</style>
@endsection

@section('content')
<!-- Start of Revamp Design -->
<!-- <div class="container-fluid my-3">
    <div class="page-breadcrumbs">
        <div class="page-title">Profile</div>
        <div class="right-elements">
            <div>Profile</div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="card-body py-5">
            <div class="container profile-header py-5">
                <div class="row">
                    <div class="col-md-3 col-lg-3 d-flex">
                        <img src="{{ $client->profile_picture_url }}" class="rounded-circle" height="120" width="120" alt="Avatar" />
                    </div>
                    <div class="col-md-9 col-lg-9">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <span class="fs-2 fw-bold">{{ $data['projects_count'] }}</span>
                                <small class="fs-4"> project posts</small>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <span class="fs-2 fw-bold">{{ $data['projects_count'] }}</span>
                                <small class="fs-4"> project proposals</small>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <span class="fs-2 fw-bold">{{ $data['projects_count'] }}</span>
                                <small class="fs-4"> project wins</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 col-lg-4">
                                <h3>{{ $client->name }}</h3>
                                <small>{{ $client->address }}</small>
                            </div>
                            <div class="col-md-8 col-lg-8">
                                <div class="profile-actions d-flex">
                                    @if( auth('client')->user()->id == $client->id )
                                    <a href="{{ route('client.profile.edit', auth('client')->user()) }}" class="btn btn-blue">Edit Profile</a>
                                    @endif
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center" style="margin-top: 20px;">
                <ul class="nav nav-tabs nav-justified mb-3" id="profile-tabs" role="tablist" style="width: 50%;">
                    <li class="nav-item" role="presentation">
                    <a
                        class="nav-link active"
                        id="ex2-tab-1"
                        data-mdb-toggle="tab"
                        href="#profile-tabs-1"
                        role="tab"
                        aria-controls="profile-tabs-1"
                        aria-selected="true"
                        >My Company</a
                    >
                    </li>
                    <li class="nav-item" role="presentation">
                    <a
                        class="nav-link"
                        id="ex2-tab-2"
                        data-mdb-toggle="tab"
                        href="#profile-tabs-2"
                        role="tab"
                        aria-controls="profile-tabs-2"
                        aria-selected="false"
                        >My Wins</a
                    >
                    </li>
                    <li class="nav-item" role="presentation">
                    <a
                        class="nav-link"
                        id="ex2-tab-3"
                        data-mdb-toggle="tab"
                        href="#profile-tabs-3"
                        role="tab"
                        aria-controls="profile-tabs-3"
                        aria-selected="false"
                        >My Connections</a
                    >
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link"
                            id="ex2-tab-4"
                            data-mdb-toggle="tab"
                            href="#profile-tabs-4"
                            role="tab"
                            aria-controls="profile-tabs-4"
                            aria-selected="false"
                            >Reviews</a
                        >
                    </li>
                </ul>
                <div class="tab-content" id="profile-tabs-content" style="width: 80%;">
                    <div
                    class="tab-pane fade show active"
                    id="profile-tabs-1"
                    role="tabpanel"
                    aria-labelledby="profile-tabs-1"
                    >
                    <div class="d-flex">
                        <img src="{{ $client->profile_picture_url }}" class="rounded" height="120" width="120" alt="Avatar" />
                        <div class="mt-auto" style="margin-left: 20px;">
                            <div class="d-flex">
                                <h1 class="display-7" style="margin-right: 10px;">{{ $company->name }}</h1>
                                <a href="{{ route('client.companies.edit', $company) }}" class="btn btn-dark-gray">Update Company</a>
                            </div>
                            <small>{{ $client->tag_line }}</small>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
                        </p>
                    </div>

                    <div class="row">
                        <h5 class="fw-bold">Location</h5>
                        <smal>{{ $company->address }}</smal>
                    </div>
                        
                    </div>
                    <div
                    class="tab-pane fade"
                    id="profile-tabs-2"
                    role="tabpanel"
                    aria-labelledby="profile-tabs-2"
                    >
                    Tab 2 content
                    </div>
                    <div
                    class="tab-pane fade"
                    id="profile-tabs-3"
                    role="tabpanel"
                    aria-labelledby="profile-tabs-3"
                    >
                    @forelse ($contacts as $item)
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img
                                        src="{{ $item->contact_profile_picture }}"
                                        alt="profile picture"
                                        style="width: 45px; height: 45px"
                                        class="rounded-circle"
                                        />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{ $item->contact_name }}</p>
                                            <p class="text-muted mb-0">{{ $item->contact_email }}</p>
                                        </div>
                                    </div>
                                    @if($item->is_existing_client)
                                        <span class="badge rounded-pill badge-success">Active</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer border-0 bg-light p-2 d-flex justify-content-around">
                                @if($item->is_existing_client)
                                    <a
                                        class="btn btn-link m-0 text-reset"
                                        href="{{ route('client.conversations.create', ['email' => $item->contact_email]) }}"
                                        role="button"
                                        data-ripple-color="primary"
                                    >Message<i class="fas fa-envelope ms-2"></i
                                    ></a>
                                    <a class="btn btn-link m-0 text-reset btn-delete-contact"
                                        href="#"
                                        role="button"
                                        data-ripple-color="primary"
                                        data-contact='@json($item)'>Delete<i class="fas fa-trash ms-2"></i>
                                    </a>
                                @else 
                                    <a class="btn btn-link m-0 text-reset" 
                                        href="{{ route('client.contacts.invite', $item) }}" 
                                        role="button" 
                                        data-ripple-color="primary">
                                        Invite<i class="fas fa-paper-plane ms-2"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>You don't have any contacts yet!</p>
                @endforelse
                    </div>
                    <div
                    class="tab-pane fade"
                    id="profile-tabs-4"
                    role="tabpanel"
                    aria-labelledby="profile-tabs-4"
                    >
                    Tab 3 content
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- End of Revamp Design -->

<!-- <div class="container-fluid user-profile">
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
</div> -->
@endsection

@section('script')
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
></script>
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