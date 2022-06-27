@extends('layouts.dashboard-layout')

@section('content')

    <div class="container-fluid mb-3">
        <div class="d-flex flex-row d-align-items-center justify-content-center">
            <div class="table-titles">Companies</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-md user-listing-table">
                <thead>
                    <th>SEQ</th>
                    <th>NAME</th>
                    <th>OWNER</th>
                    <th class="col-span-2">STATUS</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>
                                <span>{{ $loop->iteration }}</span>
                            </td>
                            <td class="">
                                <span>{{ ucfirst($company->name) }}</span>
                            </td>
                            <td>
                                <span>{{ $company->client->name }}</span>
                            </td>
                            <td>
                                <span>{{ $company->validation_status }}</span>
                            </td>
                            <td class="user-actions">
                                {{-- 
                                    <a href="#" class="btn btn-sm btn-info">
                                        View
                                    </a> 
                                --}}
                                <a href="#" class="btn btn-sm btn-warning btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                    Set Approval Status
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
    });
</script>
@endsection