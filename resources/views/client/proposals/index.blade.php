@extends('layouts.client-layout')
@section('page_title', 'Proposals')

@section('style')
<style>
    .right-elements{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    #proposals-table_previous{display: none;}
    #proposals-table_next{display: none;}
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-breadcrumbs">
        <div class="page-title">Your Proposals</div>
        <div class="right-elements">
            <div>
                <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal"><i class="bx bx-slider-alt fs-5 text-black"></i></a>
                @if(request()->has('search') || request()->has('adv_search'))
                    <a href="{{ route('client.listing.index') }}"><i class="bx bx-x"></i></a>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <div class="custom-pagination-info"></div>
        <div class="custom-pagination-paginate"></div>
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

<div class="card container">
    <div class="card-body">
        <table class="table table-hover table-md user-listing-table" id="proposals-table">
            <thead class="bg-light">
                <th>Project Name</th>
                <th>Project Cost</th>
                <th>Submission Date</th>
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($proposals as $proposal)
                    <tr>
                        <td>
                            <a href="{{ route('client.projects.show', $proposal->project) }}" target="_blank">
                                {{ $proposal->project->title }}
                            </a>
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
                        <!-- <td>
                            <span class="{{ $proposal->is_paid ?  "text-success" : 'text-danger'}} fw-bold">{{ $proposal->is_paid ? "PAID" : "NOT PAID" }}</span>
                        </td> -->
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
                @endforeach
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
            // $('#proposals-table').DataTable();
            $('#proposals-table').DataTable({
                initComplete: (settings, json)=>{
                    $('#proposals-table_paginate').appendTo('.custom-pagination-paginate');
                    $('#proposals-table_info').appendTo('.custom-pagination-info');
                },
                "bLengthChange" : false,
                "bFilter": false
            });
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
