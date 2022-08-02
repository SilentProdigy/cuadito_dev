@extends('layouts.dashboard-layout')

@section('content')

    <div class="container-fluid mb-3">
        <div class="d-flex flex-row d-align-items-center justify-content-center">
            <div class="table-titles">Categories</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-md user-listing-table">
                <thead>
                    <th>SEQ</th>
                    <th>NAME</th>
                    <th>ACTIONS</th>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <span>{{ $loop->iteration }}</span>
                            </td>
                            <td class="">
                                <span>{{ ucfirst($category->name) }}</span>
                            </td>
                            <td class="user-actions">
                                <a href="#" class="btn btn-sm btn-warning btn-edit-category" data-category="{{ json_encode($category) }}">
                                    <i class="fa fa-pencil"></i>          
                                </a>
                                <a href="#" class="btn btn-sm btn-danger btn-delete" data-category="{{ json_encode($category) }}">
                                    <i class="fa fa-trash"></i>
                                </a> 
                                {{-- <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-eye"></i>         
                                </a> --}}
                            
                                {{-- <a href="#" class="btn btn-sm btn-warning btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                    Set Approval Status
                                </a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">{{ $categories->links() }}</div>
        </div>
    </div>
    @include('admin.categories.modals.confirm_delete_modal')
    @include('admin.categories.modals.edit_category_modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let delete_buttons = document.querySelectorAll('.btn-delete');

        delete_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-category');   
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-modal'), {keyboard: false})
                myModal.show()

                let form = document.querySelector('#delete-category-form');
                form.setAttribute('action', `/admin/categories/${ data.id }`);

                document.querySelector('#category-name').innerHTML = data.name;
            });
        });

        let edit_category_buttons = document.querySelectorAll('.btn-edit-category');

        edit_category_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-category');   
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('edit-category-modal'), {keyboard: false})
                myModal.show()

                let form = document.querySelector('#edit-category-form');
                form.setAttribute('action', `/admin/categories/${ data.id }`);

                document.querySelector('#category-name-txt').setAttribute("value", data.name);
            });
        });
    });
</script>
@endsection