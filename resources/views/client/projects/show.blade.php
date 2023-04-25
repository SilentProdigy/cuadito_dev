@extends('layouts.client-layout')
@section('page_title', $project->title)

@section('style')
<style>
    .right-elements{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .bg-image{
        background-image: url("{{ asset('images/banners/project-banner.jpg') }}");
        background-position: 10% 65%;
        height: 25vh;
    }
    .mask{
        background-color: rgba(255, 255, 255, 0.8);
    }
    .card-header{padding: 3%;height: auto;}
    .page-item.active .page-link{background-color: #F96B23;}
    .card-text{font-size: 16px;}
    .card .rounded-pill{padding: 3px 20px;}
    .card-title{font-size: 21px;}
    .card-body{padding: 0;}
    .project-content .col{padding: 3%;}
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-breadcrumbs">
        <div class="page-title">Projects Available</div>
        <div class="right-elements">
            &ensp;
            <div>
                <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal"><i class="bx bx-slider-alt fs-5 text-black"></i></a>
                @if(request()->has('search') || request()->has('adv_search'))
                    <a href="{{ route('client.listing.index') }}"><i class="bx bx-x"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="project-cards">
        <div class="card h-100">
            <div class="bg-image">
                <div class="mask card-header">
                    <div class="d-flex justify-content-between text-green">
                        <h5 class="card-title text-black">{{ $project->title }}</h5>
                        <!-- <span><i class="fa fa-star"></i>&nbsp; 9.0/10</span> -->
                    </div>
                    <div class="d-flex mt-3">
                        @foreach ($project->categories as $category)
                            <span class="badge rounded-pill bg-green">Construction</span>
                        @endforeach
                    </div>
                    <div class="project-dates mt-3">
                        <div class="start-date">
                            <small class="text-black card-text">Start Date: {{ $project->created_at->format('M d,Y') }}</small>
                        </div>
                        <div class="due-date">
                            <small class="text-black  card-text">Due Date: {{ $project->max_active_date ? $project->max_active_date : 'No Due Date' }}</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end ">
                        <a href="#" class="btn btn-sm btn-light-gray"><i class="bx bx-download"></i> Download PDF</a>
                    </div>
                </div>
            <!-- <img src="{{ asset('images/banners/project-banner.jpg') }}" class="card-img-top" alt="Project Banner"/> -->
            </div>
            <div class="card-body project-content">
                <div class="d-flex">
                    <div class="col col-md-9">
                        <div>
                            <h5 class="card-title text-black">Project Type</h5>
                            <p class="card-text lh-sm">Construction Building</p>
                        </div>
                        <div class="mt-4">
                            <h5 class="card-title text-black">Location</h5>
                            <p class="card-text lh-sm">#226 Zone 2 Brgy. Bitano, Legazpi City Albay Philippines</p>
                        </div>
                        <div class="mt-4">
                            <h5 class="card-title text-black">Details</h5>
                            <p class="card-text lh-sm" style="padding-right: 5%;">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                        </div>
                    </div>
                    <div class="col col-md-3  bg-light text-center">
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-lg btn-orange">Submit Proposal</a>
                            <a href="#" class="btn btn-lg btn-dark-gray">Back</a>
                        </div>
                        <div class="project-info mt-5">
                            <h1 class="card-title text-black">Estimated Cost</h1>
                            <p class="card-text lh-sm">&#8369; {{ number_format($project->cost, 2) }}</p>
                        </div>
                        <div class="project-info mt-5">
                            <h1 class="card-title text-black">Requirments</h1>
                            <p class="card-text lh-sm"> Permit to Operate</p>
                            <p class="card-text lh-sm"> Business Permit</p>
                            <p class="card-text lh-sm"> Business Registration (SEC/DTI)</p>
                            <p class="card-text lh-sm">Latest Audited Financial Statement</p>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- <div class="card-footer d-flex justify-content-center">
                <a href="#" class="btn btn-sm btn-black"><i class="bx bx-show"></i> View</a>
                &ensp;
                <a href="#" class="btn btn-sm btn-orange"><i class="bx bx-paper-plane"></i> Submit Proposal</a>
            </div> -->
        </div>
    </div>
</div>
<!-- <div class="container px-5">
    <div class="my-3">
        
    </div>

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
                            {{-- <p class="text-danger fs-6">Open till {{ $project->max_active_date }}</p> --}}
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

                        <div class="my-2 py-3 border-top">
                            <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Requirements</h5>
                            <ul>
                                @foreach ($project->requirements as $item)
                                    <li>{{ $item->requirement_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="my-5 text-center">
                            @if($project->is_owned || $project->is_winner)
                                <a class="btn btn-sm btn-primary" href="{{route('client.projects.proposals', $project)}}">View all proposals</a>
                            @endif
                        </div>

                        @if($project->status == 'CLOSED' && $project->winningBidding)
                            <div class="my-5 text-center">
                                <hr>
                                <p class="fw-bold text-uppercase fs-6 text-secondary">Winning Proposal</p>
                                <h5 class="fw-bold"><span class="fa fa-trophy"></span> {{ $project->winningBidding->company->name }}</h5>
                                
                                <a href="{{ route('client.conversations.create', 
                                    [
                                        'email' => $project->is_owned ? 
                                            $project->winningBidding->company->client->email : 
                                            $project->owner->email
                                    ]) }}"
                                >
                                    <span class="fa fa-message"></span> Send Message
                                </a>

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

    {{-- <section class="mt-4">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="fw-bold py-1">Project's Proposals</h3>
                        
                        <form action="{{ route('client.projects.show', $project) }}" method="get">
                            <div class="input-group input-group-lg mb-3">
                                <input type="text" class="form-control " placeholder="Search Project ..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-warning" type="submit">
                                    <span class="fa fa-search"></span>
                                </button>
                                <a href="{{ route('client.projects.show', $project) }}">Clear</a>
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
    </section> --}}
</div> -->
{{-- @include('client.projects.modals.choose_proposal_modal') --}}
@endsection

@section('script')
<script>
    // $(document).ready(function() {


    //     let choose_proposal_buttons = document.querySelectorAll('.btn-choose-proposal');

    //     choose_proposal_buttons.forEach(button => {
    //         button.addEventListener('click', function(e) {  
    //             e.preventDefault;
    //             let data = button.getAttribute('data-proposal');   
    //             data = JSON.parse(data);

    //             let project = button.getAttribute('data-project');
    //             project = JSON.parse(project);

    //             document.querySelector('#company-name').innerHTML = data.company.name;
    //             document.querySelector('#proposal-id').innerHTML = data.id;
    //             document.querySelector('#winner_bidding_id').value = data.id;

    //             let myModal = new bootstrap.Modal(document.getElementById('set-project-winner-modal'), {keyboard: false})
    //             myModal.show()

    //             let form = document.querySelector('#set-project-winner-form');
    //             form.setAttribute('action', `/projects/set-winner/${ project.id }`);

    //             // document.querySelector('#area-name').innerHTML = data.name;
    //         });
    //     });
    // });
</script>
@endsection