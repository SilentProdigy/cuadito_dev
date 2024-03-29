@extends('layouts.client-main-layout')

@section('content')    
{{-- <div class="container-fluid mb-3">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <div class="table-titles">Payment History</div>
        <form action="{{ route('client.payments.index') }}" method="get" class="d-flex justify-content-between align-items-center">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control " placeholder="Search Payment ..." name="search" value="{{ request('search') }}">
                <button class="btn btn-warning" type="submit">
                    <span class="fa fa-search"></span>
                </button>
            </div>
            <a href="{{ route('client.payments.index') }}" class="p-2">Clear</a>
        </form>
    </div>
</div> --}}
<div class="card">
    <div class="card-body">

        <h5>Your Payment Transactions</h5>

        <table class="table table-borderless table-md user-listing-table" id="payment-history-table">
            <thead>     
                <th>SEQ</th>          
                <th>INVOICE #</th>
                <th>OR #</th>
                <th>DETAILS</th>
                <th>STATUS</th>                
                <th>CREATED AT</th>
                <th>PAID AT</th>
                <th>TOTAL AMOUNT</th>
                <th>ACTIONS</th>
            </thead>
            <tbody>            
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->invoice_id }}</td>
                        <td>{{ $payment->or_number ?? "-" }}</td>
                        <td>{{ $payment->details }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                        <td>{{ $payment->paid_at?->format('Y-m-d') }}</td>
                        <td>@money( $payment->total_amount )</td>
                        <td>
                            <a href="{{ route('client.payments.show', $payment) }}" class="btn btn-primary btn-sm">View Details</a>
                            <a href="{{ route('client.payments.print', $payment) }}" class="btn btn-dark btn-sm">Print</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <div class="d-flex justify-content-center">{{ $payments->links() }}</div> --}}
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
