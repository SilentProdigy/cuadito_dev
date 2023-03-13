@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
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
</div>
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

<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-sm" id="projects-table">
            <thead>
                <th>PROJECT</th>
                <th>COMPANY</th>
                <th class="col-span-2">STATUS</th>
                <th>DATE POSTED</th>
                <th>PROPOSALS</th>
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
                            <span>{{ $project->proposals_count }}</span>
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
</div>
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