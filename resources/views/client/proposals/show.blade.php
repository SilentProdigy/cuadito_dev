@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5">
    <div class="my-3">
        
    </div>

    <section class="mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="fw-bold py-1">Proposal Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="my-2 py-2">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Company</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $bidding->company->name }}</p>
                        </div>

                        <div class="my-2 py-2 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Owner</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $bidding->company->client->name }}</p>
                        </div>

                        <div class="my-2 py-2 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Project</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $bidding->project->title }}</p>
                        </div>

                        <div class="my-2 py-2 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Rate</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $bidding->rate }}</p>
                        </div>

                        <div class="my-2 py-2 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Cover Letter</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $bidding->cover_letter }}</p>
                        </div>

                        <div class="my-2 py-2 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Attachments</h5>
                            <table class="table table-borderless table-md user-listing-table">
                                <thead>
                                    <th>SEQ</th>
                                    <th>FILE</th>
                                    <th>ACTIONS</th>
                                </thead>
                                <tbody>
                                    @foreach ($bidding->attachments as $item)
                                        <tr>
                                            <td class="d-flex flex-row">
                                                <div class="d-flex flex-column user-listing-details px-3">
                                                    <span>{{ $loop->iteration }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column user-listing-details px-3">
                                                    <span>
                                                        <a href="{{ route('client.attachments.download', $item) }}" target="_blank">
                                                            {{ $item->file_name }}
                                                        </a>
                                                    </span>
                                                </div>
                                            </td>  

                                            <td class="user-actions">
                                                <a href="{{ route('client.attachments.download', $item) }}" 
                                                    class="btn btn-sm btn-outline-info"
                                                    target="_blank"
                                                >
                                                    <i class="fa fa-download"></i>         
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
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="my-5 text-center">
                            <h1 class="fw-bold">{{ $project->proposals_count }}</h1>
                            <p class="fw-bold text-uppercase fs-6 text-secondary">Current Proposals</p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@include('client.projects.modals.choose_proposal_modal')
@endsection

@section('script')

@endsection