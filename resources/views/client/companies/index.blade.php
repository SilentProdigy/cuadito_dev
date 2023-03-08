@extends('layouts.client-main-layout')

@section('content')    

<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Your Companies</div>
        <div class="col d-flex justify-content-end">
            <a href="{{ route('client.companies.create') }}" class="btn btn-primary header-btn">
                <i class="fa fa-plus"></i>&ensp;Add Company
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table" id="companies-table">
            <thead>
                <th>SEQ</th>
                <th>COMPANY</th>
                <th class="col-span-2">STATUS</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td class="d-flex flex-row">
                        <div class="d-flex flex-column user-listing-details px-3">
                            <span>{{ $loop->iteration }}</span>
                        </div>
                    </td>
                    <td>
                        <span>{{ $company->name }}</span>
                    </td>
                    <td class="">
                        <span>{!! $company->status_badge !!}</span>
                    </td>
                    <td class="user-actions">
                        <a href="{{ route('client.companies.show', $company) }}" class="btn btn-sm btn-outline-info">
                            <i class="fa fa-eye"></i>         
                        </a>
                        <a href="{{ route('client.companies.edit', $company) }}" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil"></i>          
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('client.companies.modals.confirm_delete_modal')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let delete_buttons = document.querySelectorAll('.btn-delete');

            delete_buttons.forEach(button => {
                button.addEventListener('click', function(e) {  
                    e.preventDefault;
                    let data = button.getAttribute('data-company');   
                    data = JSON.parse(data);

                    let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-modal'), {keyboard: false})
                    myModal.show()

                    document.querySelector('#company-name').innerHTML = data.name;

                    let form = document.querySelector('#delete-company-form');
                    form.setAttribute('action', `/companies/${ data.id }`);

                    // $('#validation_status').val(`${ data.validation_status }`);
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#companies-table').DataTable();
        });
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
@endsection

