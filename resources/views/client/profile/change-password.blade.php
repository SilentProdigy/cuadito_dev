@extends('layouts.client-main-layout')

@section('content')

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left text-muted"></i></a>&nbsp;Change Password Form</div>
        <div class="col d-flex justify-content-end">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('client.profile.change-password', $client) }}" method="POST">
            @method("PATCH")
            @csrf
            <div class="row mb-3">
                <div class="col-md-12 my-2">
                    <label>Old Password</label>
                    <input type="password" class="mt-1 form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="* Enter Old Password" required autocomplete="name" autofocus>
        
                    @error('old_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-12 my-2">
                    <label>New Password</label>
                    <input type="password" class="mt-1 form-control @error('password') is-invalid @enderror" name="password" placeholder="* Enter New Password" required autocomplete="name" autofocus>
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
                
                <div class="col-md-12 my-2">
                    <label>Confirm Password</label>
                    <input type="password" class="mt-1 form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="* Enter Password" required autocomplete="name" autofocus>
        
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

            </div>
            <button type="submit" class="btn btn-warning">Update Password</button>
        </form>
    </div>
</div>

@endsection