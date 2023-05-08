@extends('layouts.admin-layout')
@section('page_title', $user->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<!-- <div class="container-fluid user-profile">
    <div class="card profile-header">
        <div class="card-header image d-flex flex-column px-5">
            <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle position-absolute" height="150" width="150" alt="Avatar" />
        </div>
        <div class="d-flex flex-row">
            <div class="card-body mt-5 mx-3 d-flex flex-column">
                <span class="name mt-3">{{ $user->name }}</span>
                <span>CEO | LOPEZ DIGITAL INDUSTRY</span>
                <span>{{ $user->email }}</span>
            </div>
        </div>
    </div>
    
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Security</h5>
            <a href="{{ route('admin.profile.change-password.form', $user) }}" class="btn btn-sm btn-warning">Change Password</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>About</h5>
            <a href="{{ route('admin.profile.edit', $user) }}" class="btn btn-sm btn-info">Edit Account Info</a>
        </div>
        <div class="card-body">
            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">NAME</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $user->name }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">EMAIL</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $user->email }}</p>
            </div>

            <div class="my-1 py-1">
                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-1">ROLE</h5>
                <p class="fs-6 lh-lg" style="color: #222;">{{ $user->role }}</p>
            </div>
        </div>
    </div>
</div> -->
@endsection