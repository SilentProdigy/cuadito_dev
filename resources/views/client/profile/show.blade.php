@extends('layouts.client-main-layout')

@section('style')
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
                    <span>{{ $client->email }}</span>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('client.profile.change-password.form', $client) }}" class="btn btn-sm btn-warning float-end shadow-none"><i class="fa fa-lock"></i>&ensp;Change Password</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto mt-5 my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card profile_info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-bold">About</h4>
                            <a href="{{ route('client.profile.edit', auth('client')->user()) }}" class="btn btn-md"><i class="fa fa-pencil"></i>&ensp;Edit Profile</a>
                        </div>
                        <div class="profile_details row mt-4">
                            @if($client->contact_number && $client->address && $client->birth_date && $client->marital_status)
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @if($client->have_subscription)
                            <div class="mt-3 subscriptions">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="fw-bold">Subscription Plan</h4>
                                    <!-- <a href="{{ route('client.products.index') }}" class="btn btn-sm btn-orange">{{ $client->active_subscription->subscription_type->name }}</a>
                                    -->
                                    <button type="button" class="btn btn-sm btn-warning shadow-none" data-bs-toggle="modal" data-bs-target="#subscriptionModal">
                                        {{ $client->active_subscription->subscription_type->name }}
                                    </button>
                                </div>
                                <div>
                                    <div class="my-1 py-1">
                                        <p class="counters fw-bold">{{ $client->active_subscription->remaining_projects }}</p>
                                        <h5 class="text-uppercase text-muted">Remaining Projects</h5>
                                    </div>
                                    <div class="my-1 py-1">
                                        <p class="counters fw-bold">{{ $client->active_subscription->remaining_proposals }}</p>
                                        <h5 class="text-uppercase text-muted">Remaining Proposals</h5>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection