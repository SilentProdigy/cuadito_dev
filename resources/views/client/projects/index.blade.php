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
<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>
                <th>SEQ</th>
                <th>PROJECT</th>
                <th>COMPANY</th>
                <th class="col-span-2">STATUS</th>
                <th>DATE POSTED</th>
                <th>MAX AVAILABLE DATE</th>
                <th>PROPOSALS</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>

                @forelse ($projects as $project)
                    <tr>
                        <td class="d-flex flex-row">
                            <div class="d-flex flex-column user-listing-details px-3">
                                <span>{{ $loop->iteration }}</span>
                            </div>
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
                        <td>
                            <span>{{ $project->max_date }}</span>
                        </td>
                        <td>
                            <span>{{ $project->proposals_count }}</span>
                        </td>
                        <td class="user-actions">
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
                               Set Status
                            </a>
                        </td>
                    </tr>        
                @empty
                    <tr>
                        <td>No Projects Yet!</td>
                    </tr>
                @endforelse
            
            </tbody>
        </table>
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
                    form.setAttribute('action', `/client/projects/${ data.id }`);

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
                    form.setAttribute('action', `/client/projects/set-status/${ data.id }`);

                    $('#project-status').val(`${ data.status }`);
                });
            });        
        });
    </script>
@endsection