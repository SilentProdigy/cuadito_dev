@extends('layouts.auth-layout')

@section('content')
<div class="container auth-form">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" style="border-radius: 20px;">
                <div class="card-body"> 
                    <form method="POST" action="{{ route('client.auth.login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-6">
                                {{-- @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>

                        <div class="row mb-3 mx-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                        {{-- 
                            <hr>
                            <div class="row mb-3 mx-0">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-google"></i>&nbsp;{{ __('Login with Google') }}
                                </button>
                            </div>
                            <div class="row mb-3 mx-0">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-apple"></i>&nbsp;{{ __('Login with Apple') }}
                                </button>
                            </div> 
                        --}}
                    </form>
                </div>
            </div>
            <div class="justify-content-center text-center">
                <span>Don't have an account?</span>&nbsp;<a href="{{ route('client.auth.show-register-form') }}">Join us now.</a>
            </div>
        </div>
    </div>
</div>
@endsection
