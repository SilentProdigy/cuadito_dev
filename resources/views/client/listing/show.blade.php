@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5">
    @if($is_owned_project)
        <div class="alert alert-info d-flex justify-content-between" role="alert">
            <div class="alert-body">
                <span><i class="fa fa-info-circle"></i> Info</span>
                <p>You are browsing your own project.This means that you cannot submit a proposal to this project.</p>
            </div>
            <a class="float-end text-success" data-bs-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
        </div>
    @endif

    <section class="mt-4">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="fw-bold py-1">{{ $project->title }}</h3>
                        <div class="py-1">
                            @foreach ($project->categories as $category)
                                <span class="badge rounded-pill bg-dark">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="my-2">
                            <p class="text-secondary fs-6">Posted At: {{ $project->created_at->format('M d,Y') }}</p>
                            {{-- <p class="text-danger fs-6">Due Date: {{ $project->max_active_date }}</p> --}}
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Description</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $project->description }}</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Cost</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">@money($project->cost)</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Scope of Work</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $project->scope_of_work }}</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Terms & Conditions</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $project->terms_and_conditions }}</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Relevant Authorities</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $project->relevant_authorities }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            @include('client.listing.includes.action_buttons')
                        </div>

                        <div class="border-top my-5 px-3 py-3">
                            <h5 class="fs-6 fw-bold text-center mb-3 text-uppercase" style="color: #222;"><i class="fa fa-info-circle"></i> About the Company</h5>
                            <p><span class="fw-bold">Company:</span> <a href="{{ route('client.companies.show', $project->company) }}">{{ $project->company->name }}</a></p>
                            {{-- <p><span class="fw-bold">Email:</span> {{ $project->company->email }}</p> --}}
                            <p><span class="fw-bold">Owned by:</span> {{ $project->company->client->name }}</p>
                            {{-- <p><span class="fw-bold">Owner Email:</span> 
                                <a href="{{ route('client.conversations.create') . "?email=" . $project->company->client->email }}" target="_blank">
                                {{ $project->company->client->email }}
                                </a>
                            </p> --}}
                            <p><span class="fw-bold">Total Company's Projects:</span> {{ $project->company->projects_count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('client.includes.set_company_modal')
@endsection

@section('script')

@endsection