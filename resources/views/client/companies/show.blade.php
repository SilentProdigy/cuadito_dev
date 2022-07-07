@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">{{ $company->name }} Requirements</div>
        <div class="col d-flex justify-content-end">
            @if($company->can_upload_requirements)
                <button class="btn btn-primary header-btn" data-bs-toggle="modal" data-bs-target="#add-requirement-modal">
                    <i class="fa fa-plus"></i>&ensp;Add Requirement
                </button>
            @endif
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @include('client.companies.includes.requirements_table')
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
                form.setAttribute('action', `/client/companies/${companyData.id}/requirements/${requirementData.id}`);

                companies/{company}/requirements/{requirement}

            });
        });
    });

</script>
@endsection