@extends('layouts.client-main-layout')

@section('content')
<div class="container-fluid user-profile">
    <div class="card profile-header">
        <div class="card-header image d-flex flex-column px-5">
            <img src="{{ $client->profile_pic ? asset($client->profile_pic) : asset('images/avatar/12.png') }}" class="rounded-circle position-absolute" height="150" width="150" alt="Avatar" />
        </div>
        <div class="d-flex flex-row">
            <div class="card-body mt-5 mx-3 row">
                <div class="d-flex flex-column col-md-6">
                    <span class="name mt-3">{{ $client->name }}</span>
                    <span>{{ $client->tag_line }}</span>
                    <span>{{ $client->email }}</span>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('client.profile.change-password.form', $client) }}" class="btn btn-sm btn-warning float-end">Change Password</a>
                    <a href="{{ route('client.profile.edit', auth('client')->user()) }}" class="btn btn-sm btn-info float-end mx-3">Edit Account Info</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 my-5">
        <div class="col-md-8">
            <h5>About</h5>
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
        <div class="col-md-4">
            @if($client->have_subscription)
                <div class="mt-3 subscriptions">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Subscription Plan</h4>
                        <!-- <a href="{{ route('client.products.index') }}" class="btn btn-sm btn-orange">{{ $client->active_subscription->subscription_type->name }}</a>
                         -->
                        <button type="button" class="btn btn-sm btn-orange" data-bs-toggle="modal" data-bs-target="#subscriptionModal">
                            {{ $client->active_subscription->subscription_type->name }}
                        </button>
                    </div>
                    <div>
                        <div class="my-1 py-1">
                            <p class="counters" style="color: #222;">{{ $client->active_subscription->remaining_projects }}</p>
                            <h5 class="text-uppercase text-secondary fw-bold">REMAINING PROJECT</h5>
                        </div>
                        <div class="my-1 py-1">
                            <p class="counters" style="color: #222;">{{ $client->active_subscription->remaining_proposals }}</p>
                            <h5 class="text-uppercase text-secondary fw-bold">REMAINING PROPOSALS</h5>
                        </div>
                    </div>
                </div>
            @endif
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