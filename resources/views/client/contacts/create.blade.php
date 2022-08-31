@extends('layouts.client-main-layout')

@section('content')    
<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Add New Contact Form</div>
        <div class="col d-flex justify-content-end">
            
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('client.contacts.store') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="col-md-12">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ request()->input('email') }}">
                </div>
            </div>

            <div class="row mb-3 mx-0">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
            <hr>
        </form>
    </div>
</div>

@endsection

@section('script')
   
@endsection