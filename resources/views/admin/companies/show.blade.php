{{-- @extends('layouts.dashboard-layout') --}}
@extends('layouts.admin-layout')

@section('content')

@if($company->validation_status === 'DISAPPROVED')
<div class="row">
    <div class="col-xs-12">
        <div class="alert alert-danger" role="alert">
            <div class="alert-body">
                <h5>Company was disapproved with the following reasons:</h5>

                <p>- {{ $company->remarks }}</p>
            </div </div>
        </div>
    </div>
    @endif

    <div class="container-fluid mb-3">
        <div class="d-flex flex-row">
            <div class="table-titles">{{ $company->name }} Requirements</div>
            <div class="col d-flex justify-content-end">
                @if(auth()->user()->role == 'admin')
                <a href="#" class="btn btn-sm btn-warning btn-set-approval-status" data-company="{{ json_encode($company) }}">
                    Set Approval Status
                </a>
                @endif
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
                            @include('admin.companies.includes.status_badge')
                        </td>
                        <td>
                            <div class="d-flex flex-column user-listing-details">
                                <span>{{ $item->file->remarks }}</span>
                            </div>
                        </td>
                        <td class="user-actions">

                            @if($item->file->status == 'FOR APPROVAL' || $item->file->status == 'DISAPPROVED')
                            <button class="btn btn-sm btn-outline-success btn-approve-requirement" data-file="{{ json_encode($item->file) }}">
                                <i class="fa fa-check"></i>
                            </button>
                            @else
                            <button class="btn btn-sm btn-outline-danger btn-disapprove-requirement" data-file="{{ json_encode($item->file) }}">
                                <i class="fa fa-close"></i>
                            </button>
                            @endif

                            <a href="{{ route('admin.companies.requirements.download', [ $company, $item ]) }}" class="btn btn-sm btn-outline-info" target="_blank">
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
    @include('admin.companies.modals.disapprove_requirement_modal')
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

                    let myModal = new bootstrap.Modal(document.getElementById('set-company-status-modal'), {
                        keyboard: false
                    })
                    myModal.show()

                    let form = document.querySelector('#set-company-status-form');
                    form.setAttribute('action', `/admin/companies/${ data.id }`);

                    // console.log(data);
                    $('#validation_status').val(`${ data.validation_status }`);

                    if (data.validation_status === 'DISAPPROVED') {
                        $('#remarks-text-area').show();
                        $('#remarks-text-area').val(data.remarks);
                    }

                    $('#validation_status').on('change', function(e) {
                        // console.log("validation_status: ", $(this).val());
                        const selected_value = $(this).val();
                        selected_value === "DISAPPROVED" ? $('#remarks-text-area').show() : $('#remarks-text-area').hide();
                    });
                });
            });

            $('#btn-update-status').on('click', function(e) {
                e.preventDefault();

                const selected_value = $('#validation_status').val();

                if (selected_value === "DISAPPROVED") {
                    const remarks = $('#remarks-text-area').val();

                    if (!remarks) {
                        alert("Remarks field is required!");
                        return;
                    }
                }

                $('#set-company-status-form').submit();
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

            let disapprove_requirement_buttons = document.querySelectorAll('.btn-disapprove-requirement');
            disapprove_requirement_buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault;
                    let data = button.getAttribute('data-file');
                    data = JSON.parse(data);

                    let form = document.querySelector('#disapprove-requirement-form');
                    form.setAttribute('action', `/admin/requirements/set-status/${ data.id }`);

                    let myModal = new bootstrap.Modal(document.getElementById('disapprove-requirement-modal'), {
                        keyboard: false
                    })
                    myModal.show()

                    // $('#validation_status').val(`${ data.validation_status }`);
                    // document.querySelector('#area-name').innerHTML = data.name;
                });
            });
        })

    </script>
    @endsection
