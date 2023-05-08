@extends('layouts.admin-layout')
@section('page_title', 'Administrators')

@section('style')
<style>
    .right-elements{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card img{
        border-radius: 100%;
        width: 130px;
    }
    .page-item.active .page-link{background-color: #F96B23;}
    .clients-cards{padding: 20px;}
    .card-text{font-size: 12px;}
    .card .rounded-pill{padding: 3px 20px;}
    .card-footer{padding-top: 5%; padding-bottom: 5%}
    .client-info{display: flex; align-items: center;}
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-breadcrumbs">
        <div class="page-title">Administrators</div>
    </div>
    
    <div class="container mt-5" id="clients-grid">
        <div class="row">
            @foreach($users as $user)
            <div class="col-xs-12 col-md-6 clients-cards">
                <div class="card h-100 p-3">
                    <div class="card-body d-flex justify-content-between">
                        <div class="client-img cold-xs-6 col-md-6">
                            <img src="{{ asset('images/avatar/12.png') }}" alt="Client Image"/>
                        </div>
                        <div class="client-info cold-xs-6 col-md-6">
                            <div class="client-info-container">
                                <h5 class="client-name text-black">{{ $user->name }}</h5>
                                <p class="client-company">{{ ucfirst(trans($user->role)) }}</p>
                                <!-- Facebook -->
                                <a class="btn btn-orange btn-sm" href="#!" role="button"><i class="fa fa-phone-alt"></i></a>

                                <!-- Twitter -->
                                <a class="btn btn-orange btn-sm" href="#!" role="button"><i class="fa fa-envelope"></i></a>

                                <!-- Google -->
                                <a class="btn btn-orange btn-sm" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                                <!-- Instagram -->
                                <a class="btn btn-orange btn-sm" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
    

    <!-- <div class="card mb-3 p-3 container-fluid">
        <div class="d-flex flex-row">
            <div class="image">
                <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle" height="150" width="150" alt="Avatar" />
            </div>
            <div class="p-3">
                <div class="mt-3 d-flex flex-column">
                    <span class="profile-labels"><h3>{{ auth()->user()->name }}</h3></span>
                    <span>{{ ucfirst(auth()->user()->role) }}</span>
                    <span class="profile-labels">Current User</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid mb-3">
        <div class="d-flex flex-row d-align-items-center justify-content-center">
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary header-btn" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fa fa-plus"></i>&ensp;Add user
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-3">
        <div class="d-flex flex-row d-align-items-center justify-content-center">
            <div class="table-titles">System Users</div>
            <div class="col d-flex justify-content-end">
                <form action="{{ route('admin.users.index') }}" method="get" class="d-flex justify-content-between align-items-center">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control " placeholder="Search User ..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-warning" type="submit">
                            <span class="fa fa-search"></span>
                        </button>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="p-2">Clear</a>
                </form>
            </div>
        </div>

        @if(request('search'))
            <h5>Found {{ $users->count() }} results ...</h5>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-md user-listing-table">
                <thead>
                    <th>Name</th>
                    <th>Role</th>
                    <th class="col-span-2">Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="d-flex flex-row">
                                <div class="image user-listing-images">
                                    <img src="{{ asset('images/avatar/12.png') }}" 
                                        class="rounded-circle" 
                                        height="50" 
                                        width="50" 
                                        alt="Avatar" />
                                </div>
                                <div class="d-flex flex-column user-listing-details px-3">
                                    <a href="{{ route('admin.profile.show', $user) }}">
                                        {{$user->name}}
                                    </a>
                                    <span>{{ $user->email }}</span>
                                </div>
                            </td>
                            <td class="">
                                <span>{{ ucfirst($user->role) }}</span>
                            </td>
                            <td>
                                {!! $user->statusBadge !!}
                            </td>
                            <td class="user-actions">
                                <a href="#" data-user="{{ json_encode($user) }}"  class="btn btn-sm btn-warning btn-edit-user">
                                    <i class="fa fa-pencil"></i>          
                                </a>
                                <a href="#" data-user="{{ json_encode($user) }}"  class="btn btn-sm btn-danger btn-delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a href="#" data-user="{{ json_encode($user) }}"  class="btn btn-sm btn-outline-primary btn-set-user-status">
                                  <i class="fa fa-check"></i>         
                                </a>
                                <a href="#" data-user="{{ json_encode($user) }}"  class="btn btn-sm btn-outline-dark btn-change-password">
                                    <i class="fa fa-unlock"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> -->

    <section class="mt-3 d-flex justify-content-center">
        {{ $users->links() }}
    </section>

    @include('admin.users.modals.add_user_modal')
    @include('admin.users.modals.set_status_modal')
    @include('admin.users.modals.confirm_delete_modal')
    @include('admin.users.modals.edit_user_modal')
    @include('admin.users.modals.change_password_modal')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let set_status_buttons = document.querySelectorAll('.btn-set-user-status');

            set_status_buttons.forEach(button => {
                button.addEventListener('click', function(e) {  
                    e.preventDefault;
                    let data = button.getAttribute('data-user');   
                    data = JSON.parse(data);
    
                    let myModal = new bootstrap.Modal(document.getElementById('set-user-status-modal'), {keyboard: false})
                    myModal.show()

                    let form = document.querySelector('#set-user-status-form');
                    form.setAttribute('action', `/admin/users/set-status/${ data.id }`);

                    // document.querySelector('#area-name').innerHTML = data.name;
                });
            });

            let delete_buttons = document.querySelectorAll('.btn-delete');

            delete_buttons.forEach(button => {
                button.addEventListener('click', function(e) {  
                    e.preventDefault;
                    let data = button.getAttribute('data-user');   
                    data = JSON.parse(data);
    
                    let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-modal'), {keyboard: false})
                    myModal.show()

                    document.querySelector('#user-fullname').innerHTML = data.name;
    
                    let form = document.querySelector('#delete-user-form');
                    form.setAttribute('action', `/admin/users/${ data.id }`);

                });
            });

            let edit_buttons = document.querySelectorAll('.btn-edit-user');

            edit_buttons.forEach(button => {
                button.addEventListener('click', function(e) {  
                    e.preventDefault;
                    let data = button.getAttribute('data-user');   
                    data = JSON.parse(data);
    
                    let myModal = new bootstrap.Modal(document.getElementById('edit-user-modal'), {keyboard: false})
                    myModal.show()

                    // document.querySelector('#user-fullname').innerHTML = data.name;
    
                    let form = document.querySelector('#edit-user-form');
                    form.setAttribute('action', `/admin/users/${ data.id }`);

                    $('#edit-name-text').val(data.name);
                    $('#edit-email-text').val(data.email);
                    $('#edit-role-text').val(data.role);
                });
            });

            let change_password_buttons = document.querySelectorAll('.btn-change-password');

            change_password_buttons.forEach(button => {
                button.addEventListener('click', function(e) {  
                    e.preventDefault;
                    let data = button.getAttribute('data-user');   
                    data = JSON.parse(data);
    
                    let myModal = new bootstrap.Modal(document.getElementById('change-user-password-modal'), {keyboard: false})
                    myModal.show()

                    // document.querySelector('#user-fullname').innerHTML = data.name;
    
                    let form = document.querySelector('#change-password-form');
                    form.setAttribute('action', `/admin/users/change-password/${ data.id }`);
                });
            });

        });
    </script>
@endsection