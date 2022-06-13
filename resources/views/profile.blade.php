@extends('layouts.dashboard-layout')

@section('content')
<div class="container-fluid user-profile">
    <div class="card profile-header">
        <div class="card-header image d-flex flex-column px-5">
            <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle position-absolute" height="150" width="150" alt="Avatar" />
        </div>
        <div class="d-flex flex-row">
            <div class="card-body mt-5 mx-3 d-flex flex-column">
                <span class="name mt-3">{{ $user['name'] }}</span>
                <span>CEO | LOPEZ DIGITAL INDUSTRY</span>
                <span>{{ $user['email'] }}</span>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h5>About the Company</h5>
        </div>
        <div class="card-body">
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
    </div>
    <div class="card mt-3">
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
    </div>
    <!-- <div class="image d-flex flex-column justify-content-center align-items-center">
        <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle" height="150" width="150" alt="Avatar" />
        <span class="name mt-3">{{ $user['name'] }}</span>
        <span>
            {{ $user['email'] }}
        </span>
        <div class="gap-3 icons mt-3 d-flex flex-row justify-content-center align-items-center">
            <span>
                <i class="fa fa-twitter"></i>
            </span>
            <span>
                <i class="fa fa-facebook-f"></i>
            </span>
            <span>
                <i class="fa fa-instagram"></i>
            </span>
            <span>
                <i class="fa fa-linkedin"></i>
            </span>
        </div>
        <div class="mt-5 d-flex container-fluid">
            <div class="col align-items-center justify-content-center d-flex flex-column">
                <span class="profile-labels">Current Role</span>
                <span>
                    <i class="fa fa-user"></i>
                    @if ($user->role == 'admin')
                    Administrator
                    @endif
                    @if ($user->role == 'user')
                    User
                    @endif
                </span>
            </div>
            <div class="col d-flex align-items-center justify-content-center flex-column">
                <span class="profile-labels">History</span>
                <span><i class="fa fa-desktop"></i>&nbsp;Logged in a moment ago</span>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column">
        <span class="profile-labels mt-5">Has access to</span>
        <div class="mt-5 d-align-items-center justify-content-center d-flex flex-column container-fluid">
            <ul class="nav nav-pills nav-justified" id="access-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">Admin</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="standard-tab" data-bs-toggle="tab" data-bs-target="#standard" type="button" role="tab" aria-controls="standard" aria-selected="false">Standard</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab" aria-controls="sales" aria-selected="false">Sales</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="purchasing-tab" data-bs-toggle="tab" data-bs-target="#purchasing" type="button" role="tab" aria-controls="purchasing" aria-selected="false">Purchasing</button>
                </li>
            </ul>
            <div class="tab-content container mt-5" id="access-tab-contents">
                <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                    <span class="profile-labels">Best for business ownders and staffs</span>
                    <div class="mt-5 d-flex container-fluid">
                        <div class="col d-flex flex-column">
                            <span>Customers & Suppliers</span>
                            <span>Quotes & Sales</span>
                            <span>Purchases</span>
                            <span>Products</span>
                            <span>Reports</span>
                            <span>Settings</span>
                            <span>Visibility</span>
                        </div>
                        <div class="col d-flex flex-column">
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i>&nbsp;Entire Company</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="standard" role="tabpanel" aria-labelledby="standard-tab">
                    <span class="profile-labels">Best for staff who need full access but don't need to update business settings</span>
                    <div class="mt-5 d-flex container-fluid">
                        <div class="col d-flex flex-column">
                            <span>Customers & Suppliers</span>
                            <span>Quotes & Sales</span>
                            <span>Purchases</span>
                            <span>Products</span>
                            <span>Reports</span>
                            <span>Settings</span>
                            <span>Visibility</span>
                        </div>
                        <div class="col d-flex flex-column">
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" disabled>
                                </div>
                            </span>
                            <span>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Entire Company</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                    <span class="profile-labels">Best for staffs who quote and sell</span>
                    <div class="mt-5 d-flex container-fluid">
                        <div class="col d-flex flex-column">
                            <span>Customers & Suppliers</span>
                            <span>Quotes & Sales</span>
                            <span>Purchases</span>
                            <span>Products</span>
                            <span>Reports</span>
                            <span>Settings</span>
                            <span>Visibility</span>
                        </div>
                        <div class="col d-flex flex-column">
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i>&emsp;View Only</span>
                            <span><i class="fa fa-check"></i></span>
                            <span>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" disabled>
                                </div>
                            </span>
                            <span>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" disabled>
                                </div>
                            </span>
                            <span>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Entire Company</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="purchasing" role="tabpanel" aria-labelledby="purchasing-tab">
                    <span class="profile-labels">Best for staffs who quote and sell</span>
                    <div class="mt-5 d-flex container-fluid">
                        <div class="col d-flex flex-column">
                            <span>Customers & Suppliers</span>
                            <span>Quotes & Sales</span>
                            <span>Purchases</span>
                            <span>Products</span>
                            <span>Reports</span>
                            <span>Settings</span>
                            <span>Visibility</span>
                        </div>
                        <div class="col d-flex flex-column">
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i>&emsp;View Only</span>
                            <span><i class="fa fa-check"></i></span>
                            <span><i class="fa fa-check"></i></span>
                            <span>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" disabled>
                                </div>
                            </span>
                            <span>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" disabled>
                                </div>
                            </span>
                            <span>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Entire Company</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection