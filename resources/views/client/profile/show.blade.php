@extends('layouts.client-main-layout')

@section('content')
<div class="container-fluid user-profile">
    <div class="card profile-header">
        <div class="card-header image d-flex flex-column px-5">
            <img src="{{ asset($client->profile_pic) }}" class="rounded-circle position-absolute" height="150" width="150" alt="Avatar" />
        </div>
        <div class="d-flex flex-row">
            <div class="card-body mt-5 mx-3 d-flex flex-column">
                <span class="name mt-3">{{ $client->name }}</span>
                <span>{{ $client->tag_line }}</span>
                <span>{{ $client->email }}</span>
            </div>
        </div>
    </div>
    
    @if($client->have_subscription)
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Subscription Plan</h5>
                <a href="{{ route('client.products.index') }}" class="btn btn-sm btn-dark">{{ $client->active_subscription->subscription_type->name }}</a>
            </div>
            <div class="card-body">
                <div class="my-1 py-1">
                    <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">REMAINING PROJECT</h5>
                    <p class="fs-6 lh-lg" style="color: #222;">{{ $client->active_subscription->remaining_projects }}</p>
                </div>
                <div class="my-1 py-1">
                    <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">REMAINING PROPOSALS</h5>
                    <p class="fs-6 lh-lg" style="color: #222;">{{ $client->active_subscription->remaining_proposals }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Security</h5>
            <a href="{{ route('client.profile.change-password.form', $client) }}" class="btn btn-sm btn-warning">Change Password</a>            
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>About</h5>
            <a href="{{ route('client.profile.edit', auth('client')->user()) }}" class="btn btn-sm btn-info">Edit Account Info</a>
        </div>
        <div class="card-body">
            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">NAME</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $client->name }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">EMAIL</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $client->email }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">CONTACT NUMBER</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $client->contact_number }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">GENDER</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $client->gender }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">BIRTHDATE</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $client->birth_date }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">MARITAL STATUS</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $client->marital_status }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">ADDRESS</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $client->address }}</p>
            </div>
        </div>
   
    </div>
    {{-- <div class="card mt-3">
        <div class="card-header">
            <h5>Product / Services</h5>
        </div>
        <div class="card-body">
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Projects</h5>
        </div>
        <div class="card-body">
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
    </div> --}}

</div>
@endsection