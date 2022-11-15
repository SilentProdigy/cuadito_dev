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
                    <th>POINTS</th>
                    <th>DESCRIPTION</th>
                    <th>ACTIONS</th>
                </thead>
                <tbody>
                    @forelse ($subscription_types as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>@money($item->amount)</td>
                            <td>{{ $item->points }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning btn-edit-product" data-product='@json($item)'>
                                    <i class="fa fa-pencil"></i>          
                                </a>
                                <a href="#" class="btn btn-sm btn-danger btn-delete" data-product='@json($item)'>
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
    @include('admin.subcription_types.modals.confirm_delete_product_modal')
    @include('admin.subcription_types.modals.edit_product_modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let delete_buttons = document.querySelectorAll('.btn-delete');

        delete_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-product');   
                data = JSON.parse(data);

                let myModal = new bootstrap.Modal(document.getElementById('confirm-delete-modal'), {keyboard: false})
                myModal.show()

                let form = document.querySelector('#delete-product-form');
                form.setAttribute('action', `/admin/subscription-types/${ data.id }`);

                // document.querySelector('#category-name').innerHTML = data.name;
            });
        });

        let edit_buttons = document.querySelectorAll('.btn-edit-product');
    
        edit_buttons.forEach(button => {
            button.addEventListener('click', function(e) {  
                e.preventDefault;
                let data = button.getAttribute('data-product');   
                data = JSON.parse(data);
    
                let myModal = new bootstrap.Modal(document.getElementById('edit-product-modal'), {keyboard: false})
                myModal.show()
    
                let form = document.querySelector('#edit-product-form');
                form.setAttribute('action', `/admin/subscription-types/${ data.id }`);
    
                // document.querySelector('#category-name-txt').setAttribute("value", data.name);
                $('#edit-name').val(data.name);
                $('#edit-amount').val(data.amount);
                $('#edit-points').val(data.points);
                $('#edit-description').val(data.description);
            });
        });
    });
    

</script>
@endsection
