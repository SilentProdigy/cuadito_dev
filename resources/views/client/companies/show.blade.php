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
                <div class="company_tags">
                    <span class="badge bg-success">IT Industry</span>
                    <span class="badge bg-success">Graphic Designs</span>
                    <span class="badge bg-success">Website Development</span>
                    <span class="badge bg-success">SEO</span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body row">
        <div class="col-md-5 border-end">
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
        <div class="col-md-7">
            <h4 class="mt-3">ABOUT <span class="text-uppercase">{{ $company->name }}</span></h4>
            <div class="company_description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>

            <div class="row mt-5">
                <h4>FEATURED PROJECTS</h4>
                <div class="col-md-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-project-titles">
                                    Website Developer
                                </h5>
                            </div>
                            <span class="badge bg-success">Website Development</span> <span class="badge bg-success">IT Industry</span>
                            <p class="text-muted card-project-desc">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            </p>
                        </div>
                        <div class="card-footer">
                            <span class="badge bg-success rounded-pill fs-6">ACTIVE</span><br>
                            Cost: <span class="card-project-cost fw-bold">&#8369; 40, 000</span>
                            <br>
                            Due Date: <span class="card-project-due fw-bold">October 10, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-project-titles">
                                    Graphic Designer
                                </h5>
                            </div>
                            <span class="badge bg-success">Graphic Designs</span> <span class="badge bg-success">IT Industry</span>
                            <p class="text-muted card-project-desc">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            </p>
                        </div>
                        <div class="card-footer">
                            <span class="badge bg-success rounded-pill fs-6">ACTIVE</span><br>
                            Cost: <span class="card-project-cost fw-bold">&#8369; 30, 000</span>
                            <br>
                            Due Date: <span class="card-project-due fw-bold">October 10, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-project-titles">
                                    SEO Specialist
                                </h5>
                            </div>
                            <span class="badge bg-success">SEO</span> <span class="badge bg-success">IT Industry</span>
                            <p class="text-muted card-project-desc">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            </p>
                        </div>
                        <div class="card-footer">
                            <span class="badge bg-success rounded-pill fs-6">ACTIVE</span><br>
                            Cost: <span class="card-project-cost fw-bold">&#8369; 40, 000</span>
                            <br>
                            Due Date: <span class="card-project-due fw-bold">October 10, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-project-titles">
                                    Social Media Manager
                                </h5>
                            </div>
                            <span class="badge bg-warning">Social Media</span> <span class="badge bg-success">IT Industry</span>
                            <p class="text-muted card-project-desc">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            </p>
                        </div>
                        <div class="card-footer">
                            <span class="badge bg-success rounded-pill fs-6">ACTIVE</span><br>
                            Cost: <span class="card-project-cost fw-bold">&#8369; 25, 000</span>
                            <br>
                            Due Date: <span class="card-project-due fw-bold">October 10, 2022</span>
                        </div>
                    </div>
                </div>
            </div>
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
                form.setAttribute('action', `/client/companies/${companyData.id}/requirements/${requirementData.id}`);

                companies/{company}/requirements/{requirement}

            });
        });
    });

</script>
@endsection