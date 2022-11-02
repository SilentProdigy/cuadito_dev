@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5">
    <section class="mt-4">
        <div class="row">
            <div class="col-sm-12">
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
                        
                        <form action="{{ route('client.projects.proposals', $project) }}" method="get">
                            <div class="input-group input-group-lg mb-3">
                                <input type="text" class="form-control " placeholder="Search Project ..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-warning" type="submit">
                                    <span class="fa fa-search"></span>
                                </button>
                                <a href="{{ route('client.projects.proposals', $project) }}">Clear</a>
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
                                <th>SUBMISSION DATE</th>
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
                                        <td>{{ $proposal->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('client.proposals.show', $proposal) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fa fa-eye"></i>         
                                            </a>
                                            
                                            @if($project->status !== 'CLOSED')
                                                <button class="btn btn-sm btn-warning btn-choose-proposal" data-project="{{ json_encode($project) }}" data-proposal="{{ json_encode($proposal) }}">
                                                    Choose Proposal
                                                </button>   
                                            @endif
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
{{-- <script>
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
                form.setAttribute('action', `/projects/set-winner/${ project.id }`);

                // document.querySelector('#area-name').innerHTML = data.name;
            });
        });
    });
</script> --}}
@endsection