@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5">
    <section class="mt-4">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="fw-bold py-1">{{ $project->title }}'s Proposals</h5>
                        
                        {{-- <form action="{{ route('client.projects.proposals', $project) }}" method="get">
                            <div class="input-group input-group-lg mb-3">
                                <input type="text" class="form-control " placeholder="Search Project ..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-warning" type="submit">
                                    <span class="fa fa-search"></span>
                                </button>
                                <a href="{{ route('client.projects.proposals', $project) }}">Clear</a>
                            </div>

                            <label>Rate Filter</label>
                            <input type="text" name="min_rate" placeholder="* Min Rate" value="{{ request('min_rate') }}">
                            <input type="text" name="max_rate" placeholder="* Max Rate" value="{{ request('max_rate') }}"/><br/>

                            <label>Date Filter</label>
                            <input type="date" name="min_date" placeholder="* Min Date" value="{{ request('min_date') }}"/>
                            <input type="date" name="max_date" placeholder="* Max Date" value="{{ request('max_date') }}"/>
                        </form> --}}                    
                    </div>
                    <div class="card-body">

                        {{-- <h5>{{ request('search') ? 'We found ' . $proposals->count() . ' results ...' : 'Current Proposals'}}</h5> --}}

                        <table class="table table-borderless table-md user-listing-table" id="project-proposals-table">
                            <thead>
                                <th>SEQ</th>
                                <th>COMPANY</th>
                                <th>EMAIL</th>
                                <th>RATE</th>
                                <th>SUBMISSION DATE</th>
                                <th>ACTIONS</th>
                            </thead>
                            <tbody>
                                @foreach($proposals as $proposal)
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

                                            @if($project->winner_bidding_id == $proposal->id)
                                                <a href="{{ route('client.conversations.create', ['email' => $project->winningBidding->company->client->email]) }}" class="btn btn-sm btn-outline-success">
                                                    <i class="fa fa-message"></i>         
                                                </a>
                                            @endif
                                            
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

                        {{-- <div class="d-flex justify-content-center">{{ $proposals->links() }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('client.projects.modals.choose_proposal_modal')

<!-- Modal -->
{{-- <div class="modal fade" id="advance-search-modal" tabindex="-1" aria-labelledby="advance-search-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold" id="exampleModalLabel">Advance Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3">
                <form method="GET" action="{{ route('client.listing.index') }}">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="" class="fw-bold">Filter By:</label>
                            <select class="form-control" name="filter_col">
                                <option value="">-- Please select an option</option>
                               @foreach ($search_options['filter_cols'] as $col)
                                   <option value="{{ $col['value'] }}" {{ $col['value'] == request('filter_col') ? 'selected' : '' }}>
                                        {{ $col['label'] }}
                                    </option>
                               @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="fw-bold">Having Value of:</label>
                            <input type="text" name="filter_val" class="form-control" value="{{ request()->input('filter_val') }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="" class="fw-bold">Sort By:</label>
                            <select class="form-control" name="sort_col">
                                <option value="">-- Please select an option</option>
                                @foreach ($search_options['sort_by_cols'] as $col)
                                   <option value="{{ $col['value'] }}" {{ $col['value'] == request('sort_col') ? 'selected' : '' }}>
                                    {{ $col['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="fw-bold">Ascending / Descending:</label>
                            <select class="form-control" name="sort_val">
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="adv_search" value="1">

                    <div class="row mb-4 mx-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Search') }}
                        </button>
                    </div>

                    <hr>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#project-proposals-table').DataTable();

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
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
@endsection