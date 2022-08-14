@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Inbox</div>
        {{-- <div class="col d-flex justify-content-end">
            <a href="{{ route('client.companies.create') }}" class="btn btn-primary header-btn">
                <i class="fa fa-plus"></i>&ensp;Add Company
            </a>
        </div> --}}
    </div>
</div>
<div class="card">
    <div class="card-body">
    </div>
</div>

@endsection

@section('script')
   
@endsection