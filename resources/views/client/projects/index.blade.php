@extends('layouts.client-layout')
@section('page_title', 'Projects List')

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
        height: 6rem;
    }
    .mask{
        background-color: rgba(255, 255, 255, 0.8);
    }
    .page-item.active .page-link{background-color: #F96B23;}
    .with-action{margin-right: 24px;}
    .small-counters{background-color: #00C0EF; border-radius: 100px; padding: 5px 6px; color: #fff; font-size: 10px;}
    .status-badge{background-color: #00A65A; color: #fff; font-size: 14px; padding: 3px 20px;
    border-radius: 5px;}
</style>
@endsection

@section('content')    

<div class="container">
    <div class="page-breadcrumbs">
        <div class="page-title">Projects List</div>
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
        <div>
            <!-- <span>Showing 1 to 9 of 100 entries</span> -->
        </div>
        <div>
            <div class="pagination">
                <!--<li class="page-item previous-page disable"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
                <li class="page-item next-page"><a class="page-link" href="#">Next</a></li>-->
            </div>
        </div>
    </div>

    <div class="container">
        @if(auth('client')->user()->have_valid_companies)
            <a href="{{ route('client.projects.create') }}" class="btn btn-orange header-btn">
                <i class="fa fa-plus"></i>&ensp;Add Project
            </a>
        @else
            <button type="button" class="btn btn-orange header-btn" data-bs-toggle="modal" data-bs-target="#no-valid-company-modal">
                <i class="fa fa-plus"></i>&ensp;Add Project
            </button>
        @endif
    </div>

    <div class="container mt-3" id="project-grid">
        <div class="row">
            @foreach($projects as $project)
            <div class="my-4 project-cards">
                <div class="card p-0">
                    <div class="bg-image">
                        <div class="mask card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title text-black">{{ $project->title }}</h4>
                                </div>
                                <div class="flex">
                                    <div class="estimated-cost">
                                        <small class="text-black">Estimated Cost: &#8369;{{ number_format($project->cost, 2) }}</small>
                                    </div>
                                    <div class="start-date">
                                        <small class="text-black">Due Date: {{ \Carbon\Carbon::parse($project->due_date)->format('M d,Y') }}</small>
                                    </div>
                                </div>
                                <div class="d-flex text-center with-action">
                                    <div>
                                        <div>
                                            <small class="text-black">Status</small>
                                        </div>
                                        <div>
                                            {!! $project->status_badge !!}
                                            <!-- <span class="status-badge">Active</span> -->
                                            <!-- <a href="#" class="btn btn-sm btn-success status-badge"> Active</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div class="list-proposal-count">
                                <small class="text-muted">Proposals: </small>
                                <span class="small-counters"> +4 </span>
                            </div>
                            <div class="right-items d-flex">
                                <a href="{{ route('client.projects.show', $project) }}" class="btn btn-sm btn-orange">
                                    <i class="fa fa-eye"></i>
                                </a>
                                &ensp;
                                <a href="{{ route('client.projects.edit', $project) }}" class="btn btn-sm btn-dark-gray">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                &ensp;
                                <a href="#" class="btn btn-sm btn-light-gray btn-delete-project" data-project="{{ json_encode($project) }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

<!-- <div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Your Projects</div>
        <div class="col d-flex justify-content-end">
            @if(auth('client')->user()->have_valid_companies)
                <a href="{{ route('client.projects.create') }}" class="btn btn-primary header-btn">
                    <i class="fa fa-plus"></i>&ensp;Add Project
                </a>
            @else
                <button type="button" class="btn btn-primary header-btn" data-bs-toggle="modal" data-bs-target="#no-valid-company-modal">
                    <i class="fa fa-plus"></i>&ensp;Add Project
                </button>
            @endif
        </div>
    </div>
</div> -->
{{-- 
<div class="my-3">
    <form action="{{ route('client.projects.index') }}" method="get">
        <div class="input-group input-group-lg mb-4">
            <input id="search-focus" type="text" class="form-control" placeholder="Search Project ..." name="search" value="{{ request('search') }}">
            <button class="btn border-orange btn-orange" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
        
        @if(request()->has('search') || request()->has('adv_search'))
            <a href="{{ route('client.projects.index') }}">Clear Search Results</a>
        @endif
    </form>

    @if(request()->has('search') || request()->has('adv_search'))
        <div style="margin-top: 10px;">
            <h5>Found {{ $projects->count() }} search results ... </h5>
        </div>
    @endif
</div> --}}

<!-- <div class="card">
    <div class="card-body">
        <table class="table table-borderless table-sm" id="projects-table">
            <thead>
                <th>PROJECT</th>
                <th>COMPANY</th>
                <th class="col-span-2">STATUS</th>
                <th>DATE POSTED</th>
                <th>DUE DATE</th>
                <th>PAYMENT STATUS</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>
                            <span>{{ $project->title }}</span>
                        </td>
                        <td>
                            <span>{{ $project->company->name }}</span>
                        </td>
                        <td class="">
                            {!! $project->status_badge !!}
                        </td>
                        <td>
                            <span>{{ $project->created_at->format('M d,Y') }}</span>
                        </td>
                        <td>
                            <span>{{ \Carbon\Carbon::parse($project->due_date)->format('M d,Y') }}</span>
                        </td>
                        <td>
                            <span class="{{ $project->is_paid ?  'text-success' : 'text-danger'}} fw-bold">
                                {{ $project->is_paid ? "PAID" : "NOT PAID" }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('client.projects.show', $project  ) }}" class="btn btn-sm btn-outline-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('client.projects.edit', $project) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger btn-delete-project" data-project="{{ json_encode($project) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-dark btn-set-project-status" data-project="{{ json_encode($project) }}">
                                <i class="fa fa-check"></i>
                            </a>
                        </td>
                    </tr>      
                @endforeach  
            </tbody>
        </table>

        {{-- <div class="d-flex justify-content-center">{{ $projects->links() }}</div> --}}
    </div>
</div> -->
@include('client.projects.modals.confirm_delete_modal')
@include('client.projects.modals.set_status_modal')
@include('client.projects.modals.no_valid_company_modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let delete_buttons = document.querySelectorAll('.btn-delete-project');

        delete_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-project');   
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-modal'), {keyboard: false})
                myModal.show()

                document.querySelector('#project-name').innerHTML = data.title;

                let form = document.querySelector('#delete-project-form');
                form.setAttribute('action', `/projects/${ data.id }`);

            });
        });

        let set_status_buttons = document.querySelectorAll('.btn-set-project-status');

        set_status_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-project');   
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('set-project-status-modal'), {keyboard: false})
                myModal.show()

                let form = document.querySelector('#set-project-status-form');
                form.setAttribute('action', `/projects/set-status/${ data.id }`);

                $('#project-status').val(`${ data.status }`);
            });
        });        
    });
</script>

<script>
    $(document).ready(function () {
        $('#projects-table').DataTable();
    });
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
@endsection