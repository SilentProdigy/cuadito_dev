@extends('layouts.dashboard-layout')

@section('content')

    <div class="alert alert-primary d-flex justify-content-between" role="alert">
        <div class="alert-body">
            <span><i class="fa fa-info-circle"></i> Note:</span>
            <p>The table below holds the requirements / fields that we will ask for our clients.</p>
        </div>
        <a class="float-end text-primary" data-bs-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
    </div>

    <div class="container-fluid mb-3">
        <div class="d-flex flex-row d-align-items-center justify-content-center">
            <div class="table-titles">Client Requirements</div>
        </div>

        <div class="col d-flex justify-content-end">
            <button type="button" class="btn btn-primary header-btn" data-bs-toggle="modal" data-bs-target="#addRequirementModal">
                <i class="fa fa-plus"></i>&ensp;Add Requirement
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-md user-listing-table">
                <thead>
                    <th>SEQ</th>
                    <th>REQUIREMENT</th>
                    <th>REQUIRED</th>
                    <th>ACTIONS</th>
                </thead>
                <tbody>
                    @foreach($requirements as $requirement)
                        <tr>
                            <td>
                                <span>{{ $loop->iteration }}</span>
                            </td>
                            <td class="">
                                <span>{{ ucfirst($requirement->name) }}</span>
                            </td>
                            <td class="">
                                <span>{{ $requirement->required ? 'Required' : 'Optional' }}</span>
                            </td>
                            <td class="user-actions"> 
                                <a href="#" class="btn btn-sm btn-warning btn-edit-user">
                                    <i class="fa fa-pencil"></i>          
                                </a>
                                <a href="#" data-requirement="{{ json_encode($requirement) }}" class="btn btn-sm btn-danger btn-delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                                {{-- <a href="#" class="btn btn-sm btn-outline-primary btn-set-user-status">
                                  <i class="fa fa-check"></i>         
                                </a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.requirements.modals.confirm_delete_modal')
    @include('admin.requirements.modals.add_requirement_modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let delete_buttons = document.querySelectorAll('.btn-delete');

        delete_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-requirement');   
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-modal'), {keyboard: false})
                myModal.show()

                // document.querySelector('#user-fullname').innerHTML = data.name;

                let form = document.querySelector('#delete-requirement-form');
                form.setAttribute('action', `/admin/requirements/${ data.id }`);

            });
        });
    });
</script>
@endsection