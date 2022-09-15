@extends('layouts.dashboard-layout')

@section('content')

    <div class="container-fluid mb-3">
        <div class="d-flex flex-row d-align-items-center">
            <div class="table-titles">Clients</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-md user-listing-table">
                <thead>
                    <th>SEQ</th>
                    <th>NAME</th>
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

@endsection

@section('script')
<script>
</script>
@endsection