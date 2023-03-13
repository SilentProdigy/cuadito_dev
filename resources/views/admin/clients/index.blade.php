@extends('layouts.dashboard-layout')

@section('content')
    <div class="container-fluid mb-3">
        <div class="my-3">
            <div class="d-flex flex-row d-align-items-center justify-content-center">
                <div class="table-titles">Registered Clients</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-md clients-listing-table" id="clients-table">
                <thead>
                    <th>SEQ</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    {{-- <th>CONTACT NO.</th> --}}
                    <th>COMPANIES</th>
                    <th>PROJECTS</th>
                    <th>BIDDINGS</th>
                    {{-- <th>PLAN</th>
                    <th>PROMO</th> --}}
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>
                                <span>{{ $loop->iteration }}</span>
                            </td>
                            <td class="">
                                <span>{{ ucfirst($client->name) }}</span>
                            </td>
                            <td>
                                <span>{{ $client->email }}</span>
                            </td>
                            <td>
                                <span>{{ $client->companies_count }}</span>
                            </td>
                            <td>
                                <span>{{ $client->projects_count }}</span>
                            </td>
                            <td>
                                <span>{{ $client->biddings_count }}</span>
                            </td>
                            {{-- <td>
                                <span>{{ $client->active_subscription?->subscription_type->name }}</span>
                            </td>
                            <td>
                                <span>{{ $client->active_subscription?->is_life_time_subscription ? "LIFETIME PROMO" : "-" }}</span>
                            </td> --}}
                            <td class="user-actions">
                                <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-eye"></i>         
                                </a>

                                {{-- 
                                    @if(!$client->active_subscription?->is_life_time_subscription)
                                        <button class="btn btn-sm btn-outline-success btn-sub-lifetime" title="Subscribe to Lifetime Plan" data-client='@json($client)'>
                                            <i class="fa-solid fa-seedling"></i>
                                        </button>
                                    @endif
                                    <a href="#" class="btn btn-sm btn-warning btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                        Set Approval Status
                                    </a> 
                                --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- <section class="mt-3 d-flex justify-content-center">        
        {{ $clients->links() }}
    </section> --}}

    <div class="modal" tabindex="-1" id="confirm-lifetime-subscription-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cofirm Action</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0 ml-1">
                    Are you sure you want to <span class="text-warning text-bold">give lifetime promo</span> <strong id="category-name"></strong> to this Client?
                </p>
                
                <form action="{{ route('admin.subscribe.life-time-plan') }}" method="post" id="submit-lifetime-plan-form">
                    @csrf
                    <input type="hidden" name="client_id" id="client-id">
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" onclick="document.getElementById('submit-lifetime-plan-form').submit()">Give Lifetime Promo</button>
            </div>
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