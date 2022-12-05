@extends('layouts.auth-layout')

@section('content')
<div class="container auth-form">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="border-radius: 20px;">
                <div class="card-body">
                    <form method="POST" action="{{ $register_route }}">
                        @csrf
                        <h5 style="border-bottom: 1px solid #eeeeee" class="text-center">Welcome to CUADITO</h5>
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
            <div class="justify-content-center text-center">
                <span>Already a member?</span>&nbsp;<a href="{{ route('client.auth.login') }}">Log in</a>
            </div>
        </div>
    </div>
</div>
@endsection
