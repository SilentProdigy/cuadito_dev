@extends('layouts.dashboard-layout')

@section('content')

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Edit User Account Form</div>
        <div class="col d-flex justify-content-end">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.profile.update', $user) }}" method="POST">
            @method("PATCH")
            @csrf
            <div class="row mb-3">
                <div class="col-md-12 my-2">
                    <label>Fullname</label>
                    <input type="text" class="mt-1 form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" placeholder="* Enter Fullname" required autocomplete="name" autofocus>
        
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
                
                <div class="col-md-12 my-2">
                    <label>Email</label>
                    <input type="email" class="mt-1 form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" placeholder="* Enter Email" required autocomplete="name" autofocus>
        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

            </div>
            <input type="submit" value="Update User Account" class="btn btn-warning">
        </form>
    </div>
</div>

@endsection