@extends('layouts.dashboard-layout')

@section('content')
<div class="container-fluid mb-3">
    <div class="my-3">
        <div class="d-flex flex-row d-align-items-center justify-content-center">
            <div class="table-titles">Payment Transactions</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">        

        <table class="table table-borderless table-md user-listing-table" id="payment-history-table">
            <thead>     
                <th>SEQ</th>          
                <th>INVOICE #</th>
                <th>REF. NO.</th>
                <th>OR #</th>
                <th>PLAN</th>
                <th>STATUS</th>                
                <th>CREATED AT</th>
                <th>PAID AT</th>
                <th>TOTAL AMOUNT</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>            
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('admin.payments.show', $payment) }}">{{ $payment->id }}</a></td>
                        <td>{{ $payment->reference_no ?? "-" }}</td>
                        <td>{{ $payment->or_number ?? "-" }}</td>
                        <td>{{ $payment->subscription->subscription_type->name }} Plan</td>
                        <td>{{ $payment->status }}</td>
                        <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                        <td>{{ $payment->paid_at?->format('Y-m-d') }}</td>
                        <td>@money( $payment->total_amount )</td>
                        <td>
                            <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-primary btn-sm">View Details</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No results found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#payment-history-table').DataTable();
    });
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
@endsection