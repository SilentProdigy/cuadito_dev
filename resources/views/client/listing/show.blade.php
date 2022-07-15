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
                        <h4>{{ $project->title }}</h4>
                        <span class="badge rounded-pill bg-dark">Tag-01</span>
                        <span class="badge rounded-pill bg-dark">Tag-01</span>
                        <span class="badge rounded-pill bg-dark">Tag-01</span>
                        <span class="badge rounded-pill bg-dark">Tag-01</span>
                    </div>
                    <div class="card-body">
                        <div class="my-2">
                            <p>Posted at July 12, 2022 - 9:12 PM</p>
                            <p>Open till July 31, 2022 - 12:00 PM</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5>Description</h5>
                            <p>{{ $project->description }}</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5>Cost & Payment</h5>
                            <p>{{ $project->cost_and_payment }}</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5>Scope of Work</h5>
                            <p>{{ $project->scope_of_work }}</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5>Terms & Conditions</h5>
                            <p>{{ $project->terms_and_conditions }}</p>
                        </div>

                        <div class="my-2 py-3 border-top">
                            <h5>Relevant Authorities</h5>
                            <p>{{ $project->relevant_authorities }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-success">Submit A Proposal</a>
                            <a href="#" class="btn btn-dark">Cancel</a>
                        </div>

                        <div class="my-5 text-center">
                            <h1>{{ $project->proposals_count }}</h1>
                            <p>Current Proposals</p>
                        </div>

                        <div class="border-top my-5">
                            <h5><i class="fa fa-info-circle"></i> About the Company</h5>
                            <a href="#">{{ $project->company->name }}</a>
                            <p>Email: {{ $project->company->email }}</p>
                            <p>Owned by: {{ $project->company->client->name }}</p>
                            <p>Total Company's Projects: {{ $project->company->projects_count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')

@endsection