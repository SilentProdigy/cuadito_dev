@extends('layouts.dashboard-layout')

@section('content')
<div class="container px-5">
    <section class="mt-4">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h3 class="fw-bold py-1">{{ $project->title }}</h3>
                            <div class="py-1">
                                @foreach ($project->categories as $category)
                                    <span class="badge rounded-pill bg-dark">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            {!! $project->status_badge !!}
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
                        <div class="my-5 text-center">
                            <h1 class="fw-bold">{{ $project->proposals_count }}</h1>
                            <p class="fw-bold text-uppercase fs-6 text-secondary">Total Proposals</p>
                        </div>

                        @if($project->status == 'CLOSED' && $project->winningBidding)
                            <div class="my-5 text-center">
                                <hr>
                                <p class="fw-bold text-uppercase fs-6 text-secondary">Winning Proposal</p>
                                <h5 class="fw-bold"><span class="fa fa-trophy"></span> {{ $project->winningBidding->company->name }}</h5>
                                
                                <p class="fw-bold text-uppercase fs-6 text-secondary">Rate</p>
                                <h5 class="fw-bold">@money($project->winningBidding->rate)</h5>
                                <p class="fw-bold text-uppercase fs-6 text-secondary">Owner</p>
                                <h5 class="fw-bold">{{ $project->winningBidding->company->client->name }}</h5>

                                <p class="fw-bold text-uppercase fs-6 text-secondary">#Proposal ID</p>
                                
                                <a href="{{ route('client.proposals.show',$project->winningBidding) }}">
                                    <h5 class="fw-bold">{{ $project->winningBidding->id }}</h5>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-4">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="fw-bold py-1">Project's Proposals</h3>
                        
                        <form action="{{ route('admin.projects.show', $project) }}" method="get">
                            <div class="input-group input-group-lg mb-3">
                                <input type="text" class="form-control " placeholder="Search Project ..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-warning" type="submit">
                                    <span class="fa fa-search"></span>
                                </button>
                                <a href="{{ route('admin.projects.show', $project) }}">Clear</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">

                        <h5>{{ request('search') ? 'We found ' . $proposals->count() . ' results ...' : 'Current Proposals'}}</h5>

                        <table class="table table-borderless table-md user-listing-table">
                            <thead>
                                <th>SEQ</th>
                                <th>COMPANY</th>
                                <th>EMAIL</th>
                                <th>RATE</th>
                                <th>ACTIONS</th>
                            </thead>
                            <tbody>
                                @foreach ($proposals as $proposal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($project->winner_bidding_id == $proposal->id)
                                                <span class="text-success">
                                                    <i class="fa fa-trophy"></i>{{ $proposal->company->name }}
                                                </span>
                                            @else
                                                {{ $proposal->company->name }}
                                            @endif
                                        </td>
                                        <td>{{ $proposal->company->email }}</td>
                                        <td>@money($proposal->rate)</td>
                                        <td>
                                            <a href="{{ route('client.proposals.show', $proposal) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fa fa-eye"></i>         
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">{{ $proposals->links() }}</div>
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

        // let choose_proposal_buttons = document.querySelectorAll('.btn-choose-proposal');

        // choose_proposal_buttons.forEach(button => {
        //     button.addEventListener('click', function(e) {  
        //         e.preventDefault;
        //         let data = button.getAttribute('data-proposal');   
        //         data = JSON.parse(data);

        //         let project = button.getAttribute('data-project');
        //         project = JSON.parse(project);

        //         document.querySelector('#company-name').innerHTML = data.company.name;
        //         document.querySelector('#proposal-id').innerHTML = data.id;
        //         document.querySelector('#winner_bidding_id').value = data.id;

        //         let myModal = new bootstrap.Modal(document.getElementById('set-project-winner-modal'), {keyboard: false})
        //         myModal.show()

        //         let form = document.querySelector('#set-project-winner-form');
        //         form.setAttribute('action', `/client/projects/set-winner/${ project.id }`);

        //         // document.querySelector('#area-name').innerHTML = data.name;
        //     });
        // });
    });
</script>
@endsection