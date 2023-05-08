@extends('layouts.admin-layout')
@section('page_title', 'Users')

@section('style')
<style>
    .right-elements{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card img{
        border-radius: 100%;
        width: 100px;
    }
    .page-item.active .page-link{background-color: #F96B23;}
    .clients-cards{padding: 20px;}
    .card-text{font-size: 12px;}
    .card .rounded-pill{padding: 3px 20px;}
    .card-footer{padding-top: 5%; padding-bottom: 5%}
    .client-info{display: flex; align-items: center;}
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-breadcrumbs">
        <div class="page-title">Users</div>
        <div class="right-elements">
            &ensp;
            <div>
                <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal"><i class="bx bx-slider-alt fs-5 text-black"></i></a>
                @if(request()->has('search') || request()->has('adv_search'))
                    <a href="{{ route('admin.clients.index') }}"><i class="bx bx-x"></i></a>
                @endif
            </div>
        </div>
    </div>

    <hr>

    <div class="d-flex justify-content-between">
        <div>
            
        </div>
        <div>
            <div class="pagination">
                <!--<li class="page-item previous-page disable"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
                <li class="page-item dots"><a class="page-link" href="#">...</a></li>
                <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
                <li class="page-item next-page"><a class="page-link" href="#">Next</a></li>-->
            </div>
        </div>
    </div>
    
    <div class="container" id="clients-grid">
        <div class="row">
            @foreach($clients as $client)
            <div class="col-xs-12 col-md-4 clients-cards">
                <div class="card h-100">
                    <div class="card-body d-flex justify-content-between">
                        <div class="client-img cold-xs-6 col-md-6">
                            <img src="{{ asset('images/avatar/12.png') }}" alt="Client Image"/>
                        </div>
                        <div class="client-info cold-xs-6 col-md-6">
                            <div class="client-info-container">
                                <h5 class="client-name text-black">{{ $client->name }}</h5>
                                <p class="client-company">{{ $client->company->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#clients-table').DataTable();
        });
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            let btnLifetimePromoButtons = document.querySelectorAll('.btn-sub-lifetime');

            btnLifetimePromoButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault;
                    let data = button.getAttribute('data-client');   
                    data = JSON.parse(data);

                    document.querySelector('#client-id').value = data.id;
                    let myModal = new bootstrap.Modal(document.getElementById('confirm-lifetime-subscription-modal'), {keyboard: false});
                    myModal.show();
                });
            });

        });
    </script>
@endsection