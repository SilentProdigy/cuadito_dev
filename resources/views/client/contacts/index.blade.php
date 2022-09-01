@extends('layouts.client-main-layout')

@section('content')

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Your Contacts</div>
        <div class="col d-flex justify-content-end">
            <a href="{{ route('client.contacts.create') }}" class="btn btn-primary header-btn">
                <i class="fa fa-plus"></i>&ensp;Add Contact
            </a>
        </div>
    </div>
</div>

<div class="container-fluid mb-3 d-flex flex-row">
    <div class="bg-white">
        <div class="row">
            <div class="col-xl-6 mb-4">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img
                        src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
                        <div class="ms-3">
                        <p class="fw-bold mb-1">John Doe</p>
                        <p class="text-muted mb-0">john.doe@gmail.com</p>
                        </div>
                    </div>
                    <span class="badge rounded-pill badge-success">Active</span>
                    </div>
                </div>
                <div
                    class="card-footer border-0 bg-light p-2 d-flex justify-content-around"
                >
                    <a
                    class="btn btn-link m-0 text-reset"
                    href="#"
                    role="button"
                    data-ripple-color="primary"
                    >Message<i class="fas fa-envelope ms-2"></i
                    ></a>
                    <a
                    class="btn btn-link m-0 text-reset"
                    href="#"
                    role="button"
                    data-ripple-color="primary"
                    >Call<i class="fas fa-phone ms-2"></i
                    ></a>
                </div>
                </div>
            </div>
            <div class="col-xl-6 mb-4">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img
                        src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
                        <div class="ms-3">
                        <p class="fw-bold mb-1">Alex Ray</p>
                        <p class="text-muted mb-0">alex.ray@gmail.com</p>
                        </div>
                    </div>
                    <<span class="badge rounded-pill badge-success">Active</span>
                    </div>
                </div>
                <div
                    class="card-footer border-0 bg-light p-2 d-flex justify-content-around"
                >
                    <a
                    class="btn btn-link m-0 text-reset"
                    href="#"
                    role="button"
                    data-ripple-color="primary"
                    >Invite<i class="fas fa-paper-plane ms-2"></i
                    ></a>
                </div>
                </div>
            </div>
            <div class="col-xl-6 mb-4">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img
                        src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
                        <div class="ms-3">
                        <p class="fw-bold mb-1">Kate Hunington</p>
                        <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                        </div>
                    </div>
                    <span class="badge rounded-pill badge-danger">Away</span>
                    </div>
                </div>
                <div
                    class="card-footer border-0 bg-light p-2 d-flex justify-content-around"
                >
                <a
                    class="btn btn-link m-0 text-reset"
                    href="#"
                    role="button"
                    data-ripple-color="primary"
                    >Invite<i class="fas fa-paper-plane ms-2"></i
                    ></a>
                </div>
                </div>
            </div>
            <div class="col-xl-6 mb-4">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img
                        src="https://mdbootstrap.com/img/new/avatars/3.jpg"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
                        <div class="ms-3">
                        <p class="fw-bold mb-1">Michael Bale</p>
                        <p class="text-muted mb-0">michael.bale@gmail.com</p>
                        </div>
                    </div>
                    <span class="badge rounded-pill badge-danger">Away</span>
                    </div>
                </div>
                <div
                    class="card-footer border-0 bg-light p-2 d-flex justify-content-around"
                >
                    <a
                    class="btn btn-link m-0 text-reset"
                    href="#"
                    role="button"
                    data-ripple-color="primary"
                    >Message<i class="fas fa-envelope ms-2"></i
                    ></a>
                    <a
                    class="btn btn-link m-0 text-reset"
                    href="#"
                    role="button"
                    data-ripple-color="primary"
                    >Call<i class="fas fa-phone ms-2"></i
                    ></a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>
                <th>NAME</th>
                <th>EMAIL ADDRESS</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>
                @forelse ($contacts as $item)
                    <tr>
                        <td>
                            <span>{{ $item->name }}</span>
                        </td>
                        <td><span>{{ $item->email }}</span></td>
                        <td class="user-actions">
                            @if(!$item->contact)
                                <a href="#" class="btn btn-sm btn-info">
                                    <i class="fa fa-send"></i> Send Invitation
                                </a>
                            @endif 
                            <a href="#" class="btn btn-sm btn-danger btn-delete" data-contact="{{ json_encode($item) }}">
                                <i class="fa fa-trash"></i>
                            </a> 
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No contact records here!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div> -->

@endsection

@section('script')

@endsection