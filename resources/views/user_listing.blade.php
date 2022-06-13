@extends('layouts.dashboard-layout')

@section('content')
<div class="container-fluid mb-3">
  <div class="d-flex flex-row d-align-items-center justify-content-center">
    <div class="col d-flex justify-content-end">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="fa fa-plus"></i>&ensp;Add user
      </button>
    </div>
  </div>
</div>

<div class="card mb-3 p-3 container-fluid">
  <div class="d-flex flex-row">
    <div class="image">
      <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle" height="150" width="150" alt="Avatar" />
    </div>
    <div class="p-3">
      <div class="mt-3 d-flex flex-column">
        <span class="profile-labels">
         <h3>{{ $current_user->name }}</h3>
        </span>
         <span>Administrator</span>
         <span class="profile-labels">
          Current User
        </span>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <span class="profile-labels">Active Users</span>
  </div>
  <div class="card-body">
    <table class="table table-borderless table-md user-listing-table">
        <thead>
          <th>User</th>
          <th>Role</th>
          <th class="col-span-2">Status</th>
        </thead>
        <tbody>
    @foreach($users as $user)
            <tr>
              <td class="d-flex flex-row">
                <div class="image user-listing-images">
                  <img src="{{ asset('images/avatar/12.png') }}" class="rounded-circle" height="50" width="50" alt="Avatar" />
                </div>
                <div class="d-flex flex-column user-listing-details px-3">
                  <a href="{{ route('profile', $user->id) }}">{{$user->name}}</a>
                  <span>{{ $user->email }}</span>
                </div>
              </td>
              <td class=""><span>{{ $user->role}}</span></td>
              <td>
                @if ($user->status == 1)
                <label class="label green">ACTIVE</label>
                @endif
                @if ($user->status == 0)
                <label class="label gray">WAITING FOR APPROVAL</label>
                @endif
              </td>
              <td><i class="fa fa-cog"></i></td>
            </tr>
    @endforeach
        </tbody>
    </table>
  </div>

    <!-- <div class="card-body">
        <table class="table table-hover">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td><a href="{{ route('profile', $user->id) }}">{{$user->name}}</a></td>
                    <td>{{ $user->email }} </td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->status == 1)
                        <label class="label green">ACTIVE</label>
                        @endif
                        @if ($user->status == 0)
                        <label class="label gray">WAITING FOR APPROVAL</label>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> -->
</div>

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Add user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-3 auth-form">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                </div>
            </div>

            <h5 style="border-bottom: 1px solid #eeeeee">Business Information</h5>

            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="business-name" type="text" class="form-control @error('business-name') is-invalid @enderror" name="business-name" placeholder="Business Name" required autocomplete="business-name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Business Address" required autocomplete="name" autofocus>

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-3 mx-0">
                <button type="submit" class="btn btn-primary">
                    {{ __('Create Account') }}
                </button>
            </div>

            <hr>

            <div class="row mb-3 mx-0">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-google"></i>&emsp;{{ __('Continue with Google') }}
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection