@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">{{ $company->name }} Requirements</div>
        <div class="col d-flex justify-content-end">
            <button class="btn btn-primary header-btn" data-bs-toggle="modal" data-bs-target="#add-requirement-modal">
                <i class="fa fa-plus"></i>&ensp;Add Requirement
            </button>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @include('client.companies.includes.requirements_table')
    </div>
</div>
@include('client.companies.modals.add_requirement_modal')
@endsection

@section('script')
    
@endsection