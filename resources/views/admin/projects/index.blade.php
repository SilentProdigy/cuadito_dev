@extends('layouts.dashboard-layout')

@section('content')
<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Projects</div>
        <div class="col d-flex justify-content-end">
            <form action="{{ route('admin.projects.index') }}" method="get">
                <div class="input-group input-group-lg mb-3">
                    <input type="text" class="form-control " placeholder="Search Project ..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-warning" type="submit">
                        SEARCH
                    </button>
                    <a href="{{ route('admin.projects.index') }}">Clear Search</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-sm">
            <thead>
                <th>SEQ</th>
                <th>PROJECT</th>
                <th>COMPANY</th>
                <th>OWNER</th>
                <th class="col-span-2">STATUS</th>
                <th>DATE POSTED</th>
                <th>DUE DATE</th>
                <th>PROPOSALS</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <span>{{ $project->title }}</span>
                        </td>
                        <td>
                            <span>{{ $project->company->name }}</span>
                        </td>
                        <td>
                            <span>{{ $project->company->client->name }}</span>
                        </td>
                        <td class="">
                            <span>{{ $project->status }}</span>
                        </td>
                        <td>
                            <span>{{ $project->created_at->format('M d,Y') }}</span>
                        </td>
                        <td>
                            <span>{{ $project->max_active_date }}</span>
                        </td>
                        <td>
                            <span>{{ $project->proposals_count }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project  ) }}" class="btn btn-sm btn-outline-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            {{-- <a href="{{ route('client.projects.edit', $project) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger btn-delete-project" data-project="{{ json_encode($project) }}">
                                <i class="fa fa-trash"></i>
                            </a> --}}

                            @if(auth()->user()->role == 'admin')
                                <a href="#" class="btn btn-sm btn-dark btn-set-project-status" data-project="{{ json_encode($project) }}">
                                    <i class="fa fa-check"></i>
                                </a>
                            @endif
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

<section class="mt-3 d-flex justify-content-center">
    {{-- <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
    </nav> --}}
     
    {{ $projects->links() }}
</section>

@include('admin.projects.modals.set_status_modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {

        let set_status_buttons = document.querySelectorAll('.btn-set-project-status');

        set_status_buttons.forEach(button => {
                button.addEventListener('click', function(e) {  
                    e.preventDefault;
                    let data = button.getAttribute('data-project');   
                    data = JSON.parse(data);
    
                    let myModal = new bootstrap.Modal(document.getElementById('set-project-status-modal'), {keyboard: false})
                    myModal.show()

                    let form = document.querySelector('#set-project-status-form');
                    form.setAttribute('action', `/admin/projects/set-status/${ data.id }`);

                    $('#project-status').val(`${ data.status }`);
                });
            });        
        });
</script>
@endsection