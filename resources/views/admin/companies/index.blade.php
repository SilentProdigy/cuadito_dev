@extends('layouts.dashboard-layout')

@section('content')
    <div class="container-fluid mb-3">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="table-titles">Companies</div>
            <form action="{{ route('admin.companies.index') }}" method="get" class="d-flex justify-content-between align-items-center">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control " placeholder="Search Companies ..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-warning" type="submit">
                        <span class="fa fa-search"></span>
                    </button>
                </div>
                <a href="{{ route('admin.companies.index') }}" class="p-2">Clear</a>
            </form>
        </div>
        @if(request('search'))
            <h5>Found {{ $companies->count() }} results ...</h5>
        @endif
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
                                <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-eye"></i>         
                                </a>
                                
                                @if(auth()->user()->role == 'admin')
                                    <a href="#" class="btn btn-sm btn-warning btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                        Set Approval Status
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <section class="mt-3 d-flex justify-content-center">
        {{ $companies->links() }}
    </section>

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

                if(data.validation_status === 'DISAPPROVED') {
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

            if(selected_value === "DISAPPROVED")
            {
                const remarks = $('#remarks-text-area').val();

                if(!remarks) {
                    alert("Remarks field is required!");
                    return;
                }
            }

            $('#set-company-status-form').submit();
        });

    });
</script>
@endsection