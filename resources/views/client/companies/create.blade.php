@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Create New Company Form</div>
        <div class="col d-flex justify-content-end">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('client.companies.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label>Company Name</label>
                    <input type="text" class="mt-1 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="* Enter Company Name" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-6 mt-3">
                    <label>Company Email</label>
                    <input type="email" class="mt-1 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="* Enter Company Email" required autocomplete="name" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label>Contact Number</label>
                    <input type="text" class="mt-1 form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{old('contact_number') }}" placeholder="* Enter Company Contact Number" required autocomplete="contact_number" autofocus>

                    @error('contact_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label>Company Address</label>
                    <textarea name="address" id="" cols="30" rows="3" class="mt-1 form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <input type="submit" value="Save New Company" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection