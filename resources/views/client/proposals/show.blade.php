@extends('layouts.client-main-layout')

@section('content')
<div class="container px-5 py-5">
    
    @if($bidding->project->status == 'CLOSED' && $bidding->project->winner_bidding_id == $bidding->id)
        <div class="alert alert-success d-flex align-items-center fs-4" role="alert">
            <span class="fa fa-trophy"></span>
            <div class="m-2">
                You are viewing the winning proposal for Project #{{ $bidding->project->id }}!
            </div>
        </div>
    @endif
    
    <section class="mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="fw-bold py-1">Proposal Details</h3>
                        @if($bidding->project->status !== 'CLOSED' && auth('client')->user()->id == $bidding->project->company->client_id)
                            <button class="btn btn-sm btn-warning btn-choose-proposal" data-project="{{ json_encode($bidding->project) }}" data-proposal="{{ json_encode($bidding) }}">
                                Choose Proposal
                            </button>   
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="my-2 py-2">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Company</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $bidding->company->name }}</p>
                        </div>

                        <div class="my-2 py-2 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Owner</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $bidding->company->client_id == auth('client')->user()->id ? 'You owned this Company' : $bidding->company->client->name }}</p>
                        </div>

                        <div class="my-2 py-2 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Project</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">{{ $bidding->project->title }}</p>
                        </div>

                        <div class="my-2 py-2 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Bidding Status</h5>
                            @if($bidding->project->status == 'CLOSED' && $bidding->project->winner_bidding_id == $bidding->id)
                                <span class='badge rounded-pill bg-success px-3 py-2'><i class="fa fa-star"></i> WINNING BID</span>
                            @elseif($bidding->project->status == 'CLOSED' && $bidding->project->winner_bidding_id != $bidding->id)
                                <span class='badge rounded-pill bg-dark px-3 py-2'>LOSING BID</span>
                            @else
                                -
                            @endif
                        </div>

                        <div class="my-2 py-2 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Rate</h5>
                            <p class="fs-6 lh-lg" style="color: #222;">@money($bidding->rate)</p>
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