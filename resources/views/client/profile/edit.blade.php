@extends('layouts.client-main-layout')

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
        <form action="{{ route('client.profile.update', $client) }}" method="POST" enctype="multipart/form-data">
            @method("PATCH")
            @csrf
            <div class="row mb-3">
                <div class="col-md-8 my-2">
                    <label>Fullname</label>
                    <input type="text" class="mt-1 form-control @error('name') is-invalid @enderror" name="name" value="{{ $client->name }}" placeholder="* Enter Fullname" required autocomplete="name" autofocus>
        
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-4 my-2">
                    <label>Profile Picture</label>
                    <input type="file" class="mt-1 form-control @error('profile_pic') is-invalid @enderror" name="profile_pic">
        
                    @error('profile_pic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
                
                <div class="col-md-6 my-2">
                    <label>Email</label>
                    <input type="email" class="mt-1 form-control @error('email') is-invalid @enderror" name="email" value="{{ $client->email }}" placeholder="* Enter Email" required autocomplete="name" autofocus>
        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-6 my-2">
                    <label>Contact Number</label>
                    <input type="text" class="mt-1 form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ $client->contact_number }}" placeholder="* Enter Contact Number" required autocomplete="contact_number" autofocus>
        
                    @error('contact_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <div class="col-md-4 my-2">
                    <label>Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" 
                                name="gender" 
                                value="Male"
                                id="flexRadioDefault1" 
                                {{ $client->gender == "Male" ? "checked" : "" }}>
                        <label class="form-check-label" for="flexRadioDefault1">
                          Male
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" 
                                name="gender" 
                                value="Female"
                                id="flexRadioDefault2" 
                                {{ $client->gender == "Female" ? "checked" : "" }}>
                        <label class="form-check-label" for="flexRadioDefault2">
                          Female
                        </label>
                      </div>

                    @error('gender')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>  

                <div class="col-md-4 my-2">
                    <label>Marital Status</label>
                    <select name="marital_status" id="" class="mt-1 form-control @error('marital_status') is-invalid @enderror"">
                        <option value="">Select Marital Status</option>
                        @foreach ($civil_status_options as $option)
                            <option value="{{ $option }}" {{ $option == $client->marital_status ? "selected" : "" }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('marital_status')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>  

                <div class="col-md-4 my-2">
                    <label>Birth Date</label>
                    <input type="date" class="mt-1 form-control @error('birth_date') is-invalid @enderror" 
                          name="birth_date" 
                          value="{{ $client->birth_date }}" 
                          placeholder="* Enter Birth Date" 
                          required 
                          autocomplete="birth_date" 
                          autofocus>
                    @error('birth_date')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>  

                <div class="col-md-12 my-3">
                    <label>Address</label>
                    <textarea 
                        name="address" 
                        rows="3" 
                        class="mt-1 form-control @error('address') is-invalid @enderror">{{ $client->address }}</textarea>

                    @error('address')
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