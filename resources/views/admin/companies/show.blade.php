@extends('layouts.dashboard-layout')

@section('content')
<div class="container-fluid mb-3">
    <div class="d-flex flex-row">
        <div class="table-titles">{{ $company->name }} Requirements</div>
        <div class="col d-flex justify-content-end">
            <a href="#" class="btn btn-sm btn-warning btn-set-approval-status" data-company="{{ json_encode($company) }}">
                Set Approval Status
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>
                <th>SEQ</th>
                <th>REQUIREMENT</th>
                <th>STATUS</th>
                <th>REMARKS</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>
                @foreach ($company->requirements as $item)
                    <tr>
                        <td class="d-flex flex-row">
                            <div class="d-flex flex-column user-listing-details">
                                <span>{{ $loop->iteration }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column user-listing-details">
                                <span>{{ $item->name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column user-listing-details">
                                <span>{{ $item->file->status }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column user-listing-details">
                                <span>{{ $item->file->remarks }}</span>
                            </div>
                        </td>
                        <td class="user-actions">

                            @if($item->file->status == 'FOR APPROVAL' || $item->file->status == 'DISAPPROVED')
                                <button class="btn btn-sm btn-outline-success btn-approve-requirement" 
                                    data-file="{{ json_encode($item->file) }}">
                                    <i class="fa fa-check"></i>         
                                </button>  
                            @else
                                <a href="#" 
                                class="btn btn-sm btn-outline-danger"
                                target="_blank">
                                    <i class="fa fa-close"></i>         
                                </a>  
                            @endif

                            <a href="{{ route('admin.companies.requirements.download', [ $company, $item ]) }}" 
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

<form action="#" method="POST" id="approve-requirement-form">
    @method('PATCH')
    @csrf
    <input type="hidden" name="status" value="APPROVED">
</form>

@include('admin.companies.modals.set_status_modal')
@endsection

@section('script')
<script>

    $(document).ready(function() {

        let set_status_buttons = document.querySelectorAll('.btn-set-approval-status');

        set_status_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-company');   
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('set-company-status-modal'), {keyboard: false})
                myModal.show()

                let form = document.querySelector('#set-company-status-form');
                form.setAttribute('action', `/admin/companies/${ data.id }`);

                // console.log(data);
                $('#validation_status').val(`${ data.validation_status }`);
                // document.querySelector('#area-name').innerHTML = data.name;
            });
        });

        let approve_requirement_buttons = document.querySelectorAll('.btn-approve-requirement');

        approve_requirement_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-file');   
                data = JSON.parse(data);

                let form = document.querySelector('#approve-requirement-form');
                form.setAttribute('action', `/admin/requirements/set-status/${ data.id }`);

                form.submit();
                // $('#validation_status').val(`${ data.validation_status }`);
                // document.querySelector('#area-name').innerHTML = data.name;
            });
        });


    })
</script>
@endsection