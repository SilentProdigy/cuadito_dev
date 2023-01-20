@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('client.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('client.companies.index')}}">Companies</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $company->name }}</li>
    </ol>
</nav>

@if($company->validation_status === 'DISAPPROVED')
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger" role="alert">
                <div class="alert-body">
                    <h5>Your Company was disapproved with the following reasons:</h5>

                    <p>- {{ $company->remarks }}</p>
                </div    
            </div>
        </div>
    </div>
@endif

<div class="card">
    <div class="card-header px-5 py-3">
        <div class="company_logo d-flex">
            <img src="{{ asset('images/company_logo/cov.png') }}" height="100" alt="Avatar" loading="lazy" />
            <div class="px-3 py-3">
                <h4>{{ $company->name }}</h4>
                <span>{{ $company->address }}</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            @if(auth('client')->user()->id == $company->client_id)
                <div class="col-md-12 border-bottom">
                    <div class="col d-flex justify-content-end">
                        @if($company->can_upload_requirements && !$company->have_complete_requirements)
                            <button class="btn btn-primary header-btn" data-bs-toggle="modal" data-bs-target="#add-requirement-modal">
                                <i class="fa fa-plus"></i>&ensp;Add Requirement
                            </button>
                        @endif
                        </div>
                    <div class="col">
                        @include('client.companies.includes.requirements_table')
                    </div>
                </div>
                <div class="col-md-12">
                    <h4 class="mt-3">ABOUT <span class="text-uppercase">{{ $company->name }}</span></h4>
                    {{-- <div class="company_description">
                        {{ $company->description }}
                    </div> --}}
    
                    <div class="row mt-5">
                        <h4>FEATURED PROJECTS</h4>
                        @include('client.companies.includes.featured_projects')
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <h4 class="mt-3">ABOUT <span class="text-uppercase">{{ $company->name }}</span></h4>
                    <div class="company_description">
                        @if($company->description)
                            <p>{{ $company->description }}</p>
                        @else
                            <span>No description yet.</span>
                        @endif
                    </div>

                    <div class="row mt-5">
                        <h4>FEATURED PROJECTS</h4>
                        @include('client.companies.includes.featured_projects')
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@include('client.companies.modals.add_requirement_modal')
@include('client.companies.modals.confirm_delete_requirement_modal')
@endsection

@section('script')
<script>

    $(document).ready(function() {
        let delete_buttons = document.querySelectorAll('.btn-delete-requirement');

        delete_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let companyData = button.getAttribute('data-company');   
                companyData = JSON.parse(companyData);

                let requirementData = button.getAttribute('data-requirement');   
                requirementData = JSON.parse(requirementData);

                let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-modal'), {keyboard: false})
                myModal.show()

                document.querySelector('#requirement-name').innerHTML = requirementData.name;

                let form = document.querySelector('#delete-requirement-form');
                form.setAttribute('action', `/companies/${companyData.id}/requirements/${requirementData.id}`);

                companies/{company}/requirements/{requirement}

            });
        });
    });

</script>
@endsection