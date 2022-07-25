@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row">
        <div class="table-titles">Your Proposals</div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>
                <th>SEQ</th>
                <th>PROJECT</th>
                <th>COMPANY</th>
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
                        <td class="user-actions">
                            <a href="#" class="btn btn-sm btn-outline-info">
                                <i class="fa fa-eye"></i>         
                            </a>
                        </td>
                    </tr>        
                @empty
                    <tr>
                        <td>No Proposals Yet!</td>
                    </tr>
                @endforelse
            
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
    <script>
    </script>
@endsection