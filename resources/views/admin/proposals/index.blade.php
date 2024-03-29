@extends('layouts.dashboard-layout')

@section('content')

<div class="container px-5 py-5">
    <div class="container-fluid mb-3">
        <div class="d-flex flex-row justify-content-between align-items-center">
        <div class="table-titles">System's Proposals</div>
            <form action="{{ route('admin.proposals.index') }}" method="GET">
                <div class="input-group">
                    <div class="form-outline">
                        <input id="search-focus" type="search" id="form1" class="form-control" name="search" value="{{ request('search') }}"/>
                        <label class="form-label" for="form1">Search</label>
                    </div>
                    <button type="submit" class="btn border-orange btn-orange">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('admin.proposals.index') }}">Clear</a>
                </div>
            </form>
        </div>

        @if(request('search'))
            <h5>Found {{ $proposals->count() }} results ...</h5>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-md user-listing-table">
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
                                <a href="{{ route('admin.proposals.show', $proposal) }}" class="btn btn-sm btn-outline-info">
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
    
            <div class="d-flex justify-content-center">{{ $proposals->links() }}</div>
        </div>
    </div>

</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection