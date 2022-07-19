@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5">
    <div class="my-3">
        
    </div>

    <section class="mt-4">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="fw-bold py-1">{{ $project->title }}</h3>
                        <div class="py-1">
                            <span class="badge rounded-pill bg-dark">Tag-01</span>
                            <span class="badge rounded-pill bg-dark">Tag-01</span>
                            <span class="badge rounded-pill bg-dark">Tag-01</span>
                            <span class="badge rounded-pill bg-dark">Tag-01</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="my-2">
                            <p class="text-secondary fs-6">Posted at July 12, 2022 - 9:12 PM</p>
                            <p class="text-danger fs-6">Open till July 31, 2022 - 12:00 PM</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Description</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $project->description }}</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Cost & Payment</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $project->cost_and_payment }}</p>
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
                            
                            @if(!$has_proposal)
                                <a href="{{ route('client.proposals.create', $project) }}" class="btn btn-outline-success">Submit A Proposal</a>
                            @else
                                <button class="btn btn-outline-secondary" disabled>Proposal Submitted</button>
                            @endif
                            <a href="{{ route('client.listing.index') }}" class="btn btn-dark">Back</a>
                        </div>

                        <div class="my-5 text-center">
                            <h1 class="fw-bold">{{ $project->proposals_count }}</h1>
                            <p class="fw-bold text-uppercase fs-6 text-secondary">Current Proposals</p>
                        </div>

                        <div class="border-top my-5 px-3 py-3">
                            <h5 class="fs-6 fw-bold text-center mb-3 text-uppercase" style="color: #222;"><i class="fa fa-info-circle"></i> About the Company</h5>
                            <p><span class="fw-bold">Company:</span> <a href="#">{{ $project->company->name }}</a></p>
                            <p><span class="fw-bold">Email:</span> {{ $project->company->email }}</p>
                            <p><span class="fw-bold">Owned by:</span> {{ $project->company->client->name }}</p>
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