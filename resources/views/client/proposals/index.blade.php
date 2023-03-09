@extends('layouts.client-main-layout')

@section('content')    
<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Your Proposals</div>
        <div class="col d-flex justify-content-end">
            {{-- @if(auth('client')->user()->have_valid_companies)
                <a href="{{ route('client.projects.create') }}" class="btn btn-primary header-btn">
                    <i class="fa fa-plus"></i>&ensp;Add Project
                </a>
            @else
                <button type="button" class="btn btn-primary header-btn" data-bs-toggle="modal" data-bs-target="#no-valid-company-modal">
                    <i class="fa fa-plus"></i>&ensp;Add Project
                </button>
            @endif --}}
        </div>
    </div>
</div>

<div class="my-3">
    {{-- <form action="{{ route('client.proposals.index') }}" method="get">
        <div class="input-group input-group-lg mb-4">
            <input id="search-focus" type="text" class="form-control" placeholder="Search Proposals ..." name="search" value="{{ request('search') }}">
            <button class="btn border-orange btn-orange" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>

        @if(request()->has('search') || request()->has('adv_search'))
            <a href="{{ route('client.proposals.index') }}">Clear Search Results</a>
        @endif
    </form> --}}

    @if(request()->has('search') || request()->has('adv_search'))
        <div style="margin-top: 10px;">
            <h5>Found {{ $proposals->count() }} search results ... </h5>
        </div>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table" id="proposals-table">
            <thead>
                <th>SEQ</th>
                <th>PROJECT</th>
                {{-- <th>COMPANY</th> --}}
                <th class="col-span-2">PROJECT STATUS</th>
                <th>SUBMITTED RATE</th>
                <th>DATE OF PROPOSAL</th>
                <th>PROPOSAL STATUS</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>
                @forelse ($proposals as $proposal)
                    <tr>
                        <td class="d-flex flex-row">
                            <div class="d-flex flex-column user-listing-details px-3">
                                <span>{{ $loop->iteration }}</span>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('client.projects.show', $proposal->project) }}" target="_blank">
                                {{ $proposal->project->title }}
                            </a>
                        </td>
                        {{-- <td>
                            <span>{{ $proposal->project->company->name }}</span>
                        </td> --}}
                        <td class="">
                            <span>{!! $proposal->project->status_badge !!}</span>
                        </td>
                        <td>
                            <span>@money($proposal->rate)</span>
                        </td>
                        <td>
                            <span>{{ $proposal->created_at->format('M d,Y') }}</span>
                        </td>
                        <td>
                            <span>
                                @if($proposal->project->status == 'CLOSED' && $proposal->project->winner_bidding_id == $proposal->id)
                                    <span class='badge rounded-pill bg-success px-3 py-2'><i class="fa fa-star"></i> WINNING BID</span>
                                @elseif($proposal->project->status == 'CLOSED' && $proposal->project->winner_bidding_id != $proposal->id)
                                    <span class='badge rounded-pill bg-dark px-3 py-2'>LOSING BID</span>
                                @else
                                    <span class='badge rounded-pill bg-dark px-3 py-2'>PENDING</span>
                                @endif
                            </span>
                        </td>
                        <td class="user-actions">
                            <a href="{{ route('client.proposals.show', $proposal) }}" class="btn btn-sm btn-outline-info">
                                <i class="fa fa-eye"></i>         
                            </a>

                            @if($proposal->project->winner_bidding_id == $proposal->id)
                                <a href="{{ route('client.conversations.create', ['email' => $proposal->project->owner->email]) }}" class="btn btn-sm btn-outline-success">
                                    <i class="fa fa-message"></i>         
                                </a>
                            @endif

                            @if($proposal->project->status == 'ACTIVE')
                                <button class="btn btn-sm btn-outline-danger btn-cancel-proposal" data-proposal='@json($proposal)'>
                                    <i class="fa fa-times"></i>
                                </button>
                            @endif
                        </td>
                    </tr>        
                @empty
                    <tr>
                        <td>No Proposals Yet!</td>
                    </tr>
                @endforelse
            
            </tbody>
        </table>

        {{-- <div class="d-flex justify-content-center">{{ $proposals->links() }}</div> --}}
    </div>
</div>

@include('client.includes.confirm_cancel_proposal')

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#proposals-table').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            const cancelProposalButtons = document.querySelectorAll('.btn-cancel-proposal');

            if(!cancelProposalButtons) return;

            cancelProposalButtons.forEach(button => {
                $(button).on('click', () => {
                    let data = $(button).attr('data-proposal');
                    data = JSON.parse(data);

                    let myModal = new bootstrap.Modal(document.getElementById('confirm-cancel-proposal-modal'), {keyboard: false})
                    myModal.show()

                    $('#project-name').text(data.project.title);

                    let form = document.querySelector('#cancel-proposal-form');
                    form.setAttribute('action', `/proposals/${ data.id }/cancel`);
                })
            })
        });
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
@endsection
