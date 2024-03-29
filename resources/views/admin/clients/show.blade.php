@extends('layouts.dashboard-layout')

@section('content')
<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center">
        <div class="table-titles">{{ $client->name }}</div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5>Companies</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-borderless table-md user-listing-table" id="companies-table">
                    <thead>
                        <th>SEQ</th>
                        <th>COMPANY</th>
                        <th class="col-span-2">STATUS</th>
                        {{-- <th>SUBSCRIPTION</th> --}}
                        <th>ACTIONS</th>
                    </thead>
                    <tbody>
                        @foreach ($client->companies as $company)
                        <tr>
                            <td class="d-flex flex-row">
                                <div class="d-flex flex-column user-listing-details px-3">
                                    <span>{{ $loop->iteration }}</span>
                                </div>
                            </td>
                            <td>
                                <span>{{ $company->name }}</span>
                            </td>
                            <td class="">
                                <span>{{ $company->validation_status }}</span>
                            </td>
                            {{-- <td>
                                <span>-</span>
                                </td> --}}
                            <td class="user-actions">
                                <a href="{{ route('client.companies.show', $company) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h5>Projects</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-borderless table-md user-listing-table" id="projects-table">
                    <thead>
                        <th>SEQ</th>
                        <th>PROJECT</th>
                        <th>COMPANY</th>
                        <th class="col-span-2">STATUS</th>
                        <th>DATE POSTED</th>
                        {{-- <th>DUE DATE</th> --}}
                        <th>PROPOSALS</th>
                        <th>PAYMENT STATUS</th>
                        <th>ACTIONS</th>
                    </thead>
                    <tbody>
                        @foreach ($client->projects as $project)
                        <tr>
                            <td>
                                <span>{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                <span>{{ $project->title }}</span>
                            </td>
                            <td>
                                <span>{{ $project->company->name }}</span>
                            </td>
                            <td class="">
                                <span>{{ $project->status }}</span>
                            </td>
                            <td>
                                <span>{{ $project->created_at->format('M d,Y') }}</span>
                            </td>
                            {{-- <td>
                                    <span>{{ $project->max_active_date }}</span>
                            </td> --}}
                            <td>
                                <span>{{ $project->proposals_count }}</span>
                            </td>
                            <span class="{{ $project->is_paid ?  "text-success" : 'text-danger'}} fw-bold">
                                {{ $project->is_paid ? "PAID" : "NOT PAID" }}
                            </span>
                            <td>
                                <a href="{{ route('client.projects.show', $project  ) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h5>Proposals</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-borderless table-md user-listing-table" id="proposals-table">
                    <thead>
                        <th>SEQ</th>
                        <th>PROJECT</th>
                        <th>COMPANY</th>
                        <th class="col-span-2">PROJECT STATUS</th>
                        <th>SUBMITTED RATE</th>
                        <th>DATE OF PROPOSAL</th>
                        <th>PROPOSAL STATUS</th>
                        <th>PAYMENT STATUS</th>
                        <th>ACTIONS</th>
                    </thead>
                    <tbody>
                        @foreach ($client->biddings as $proposal)
                        <tr>
                            <td class="d-flex flex-row">
                                <div class="d-flex flex-column user-listing-details px-3">
                                    <span>{{ $loop->iteration }}</span>
                                </div>
                            </td>
                            <td>
                                <span>{{ $proposal->project->title }}</span>
                            </td>
                            <td>
                                <span>{{ $proposal->project->company->name }}</span>
                            </td>
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
                                    -
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="{{ $proposal->is_paid ?  "text-success" : 'text-danger'}} fw-bold">
                                    {{ $proposal->is_paid ? "PAID" : "NOT PAID" }}
                                </span>
                            </td>

                            <td class="user-actions">
                                <a href="{{ route('client.proposals.show', $proposal) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#companies-table').DataTable();
        $('#projects-table').DataTable();
        $('#proposals-table').DataTable();
    });

</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
@endsection
