@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Companies</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $company->name }}</li>
    </ol>
    </nav>
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
                        @if($company->can_upload_requirements && !$company->have_complete_requirements && $missing_requirements->count() > 0)
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
                    <div class="company_description">
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur</p>
                        {{ $company->description }}
                    </div>
    
                    <div class="row mt-5">
                        <h4>FEATURED PROJECTS</h4>
                        @include('client.companies.includes.featured_projects')
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <h4 class="mt-3">ABOUT <span class="text-uppercase">{{ $company->name }}</span></h4>
                    <div class="company_description">
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur</p>
                        @if($company->description)
                            
                        @else
                            <span>Please edit your company and add company description.</span>
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