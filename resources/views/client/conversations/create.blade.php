@extends('layouts.client-main-layout')

@section('content')    
<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Send Email</div>
        <div class="col d-flex justify-content-end">
            
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('client.conversations.store') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="">Subject</label>
                    <input type="text" name="subject" class="form-control">
                </div>

                <div class="col-md-12">
                    <label for="">Recipient Email</label>
                    <input type="email" name="email" class="form-control" value="{{ request()->input('email') }}">
                </div>

                <div class="col-md-12">
                    <label for="">Content</label>
                    <textarea name="content" id="" rows="5" class="form-control"></textarea>
                </div>
            </div>
            

            <div class="row mb-3 mx-0">
                <button type="submit" class="btn btn-primary">
                    Send
                </button>
            </div>
            <hr>
        </form>
    </div>
</div>

@endsection

@section('script')
   
@endsection