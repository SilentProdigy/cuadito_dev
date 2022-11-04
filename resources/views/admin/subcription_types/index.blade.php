@extends('layouts.dashboard-layout')

@section('content')

    <div class="container-fluid mb-3">
        <div class="d-flex flex-row d-align-items-center justify-content-center">
            <div class="table-titles">Our Products</div>
        </div>

        <div class="col d-flex justify-content-end">
            <button type="button" class="btn btn-primary header-btn" data-bs-toggle="modal" data-bs-target="#add-product-modal">
                <i class="fa fa-plus"></i>&ensp;Add New Product
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-md user-listing-table">
                <thead>
                    <th>SEQ</th>
                    <th>NAME</th>
                    <th>AMOUNT</th>
                    <th>DESCRIPTION</th>
                    <th>ACTIONS</th>
                </thead>
                <tbody>
                    @forelse ($subscription_types as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>@money($item->amount)</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning btn-edit-category" data-category="@json($item)">
                                    <i class="fa fa-pencil"></i>          
                                </a>
                                <a href="#" class="btn btn-sm btn-danger btn-delete" data-category="@json($item)">
                                    <i class="fa fa-trash"></i>
                                </a> 
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No products yet!</td>
                        </tr>
                    @endforelse
                  
                </tbody>
            </table>

            <div class="d-flex justify-content-center">{{ $subscription_types->links() }}</div>
        </div>
    </div>

    @include('admin.subcription_types.modals.add_subscription_type_modal')
@endsection

@section('script')
<script>
    // $(document).ready(function() {
    //     let delete_buttons = document.querySelectorAll('.btn-delete');

    //     delete_buttons.forEach(button => {
    //         button.addEventListener('click', function(e) {  
    //             e.preventDefault;
    //             let data = button.getAttribute('data-category');   
    //             data = JSON.parse(data);

    //             let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-modal'), {keyboard: false})
    //             myModal.show()

    //             let form = document.querySelector('#delete-category-form');
    //             form.setAttribute('action', `/admin/categories/${ data.id }`);

    //             document.querySelector('#category-name').innerHTML = data.name;
    //         });
    //     });

    //     let edit_category_buttons = document.querySelectorAll('.btn-edit-category');

    //     edit_category_buttons.forEach(button => {
    //         button.addEventListener('click', function(e) {  
    //             e.preventDefault;
    //             let data = button.getAttribute('data-category');   
    //             data = JSON.parse(data);

    //             let myModal = new bootstrap.Modal(document.getElementById('edit-category-modal'), {keyboard: false})
    //             myModal.show()

    //             let form = document.querySelector('#edit-category-form');
    //             form.setAttribute('action', `/admin/categories/${ data.id }`);

    //             document.querySelector('#category-name-txt').setAttribute("value", data.name);
    //         });
    //     });
    // });
</script>
@endsection