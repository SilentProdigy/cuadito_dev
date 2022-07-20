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
                            <p class="text-secondary fs-6">Posted at {{ $project->created_at->format('M d,Y') }}</p>
                            <p class="text-danger fs-6">Open till {{ $project->max_active_date }}</p>
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
                        <div class="my-5 text-center">
                            <h1 class="fw-bold">{{ $project->proposals_count }}</h1>
                            <p class="fw-bold text-uppercase fs-6 text-secondary">Current Proposals</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-4">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="fw-bold py-1">Project's Proposals</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-md user-listing-table">
                            <thead>
                                <th>SEQ</th>
                                <th>COMPANY</th>
                                <th>EMAIL</th>
                                <th>RATE</th>
                                <th>ACTIONS</th>
                            </thead>
                            <tbody>
                                @foreach ($project->proposals as $proposal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $proposal->company->name }}</td>
                                        <td>{{ $proposal->company->email }}</td>
                                        <td>{{ $proposal->rate }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-info">
                                                <i class="fa fa-eye"></i>         
                                            </a>
                                            
                                            <button class="btn btn-sm btn-warning btn-choose-proposal" data-project="{{ json_encode($project) }}" data-proposal="{{ json_encode($proposal) }}">
                                                Choose Proposal
                                            </button>   
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('client.projects.modals.choose_proposal_modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {


        let choose_proposal_buttons = document.querySelectorAll('.btn-choose-proposal');

        choose_proposal_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-proposal');   
                data = JSON.parse(data);

                let project = button.getAttribute('data-project');
                project = JSON.parse(project);

                document.querySelector('#company-name').innerHTML = data.company.name;
                document.querySelector('#proposal-id').innerHTML = data.id;
                document.querySelector('#winner_bidding_id').value = data.id;

                let myModal = new bootstrap.Modal(document.getElementById('set-project-winner-modal'), {keyboard: false})
                myModal.show()

                let form = document.querySelector('#set-project-winner-form');
                form.setAttribute('action', `/client/projects/set-winner/${ project.id }`);

                // document.querySelector('#area-name').innerHTML = data.name;
            });
        });
    });
</script>
@endsection