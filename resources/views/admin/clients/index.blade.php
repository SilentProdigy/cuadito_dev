@extends('layouts.dashboard-layout')

@section('content')

    <div class="container-fluid mb-3">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="table-titles">Clients</div>
            <form action="{{ route('admin.clients.index') }}" method="get" class="d-flex justify-content-between align-items-center">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control " placeholder="Search Client ..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-warning" type="submit">
                        <span class="fa fa-search"></span>
                    </button>
                </div>
                <a href="{{ route('admin.clients.index') }}" class="p-2">Clear</a>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-md user-listing-table">
                <thead>
                    <th>SEQ</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>CONTACT NO.</th>
                    <th>COMPANIES</th>
                    <th>PROJECTS</th>
                    <th>BIDDINGS</th>
                    <th>ACTIVE SUBSCRIPTION</th>
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
                                <span>{{ $client->contact_number }}</span>
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
                            <td>
                                <span>{{ $client->active_subscription?->subscription_type->name }}</span>
                            </td>
                            <td class="user-actions">
                                <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-eye"></i>         
                                </a>
                                {{-- 
                                <a href="#" class="btn btn-sm btn-warning btn-set-approval-status" data-company="{{ json_encode($company) }}">
                                    Set Approval Status
                                </a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <section class="mt-3 d-flex justify-content-center">        
        {{ $clients->links() }}
    </section>

@endsection

@section('script')
<script>
</script>
@endsection