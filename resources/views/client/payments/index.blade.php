@extends('layouts.client-main-layout')

@section('content')    
<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">Payment History</div>
        <div class="col d-flex justify-content-end">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-borderless table-md user-listing-table">
            <thead>     
                <th>SEQ</th>          
                <th>INVOICE #</th>
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
                        <td>{{ $payment->status }}</td>
                        <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                        <td>{{ $payment->paid_at->format('Y-m-d') }}</td>
                        <td>@money( $payment->total_amount )</td>
                        <td>
                            <a href="{{ route('client.payments.show', $payment) }}" class="btn btn-primary btn-sm">View Details</a>
                            <a href="{{ route('client.payments.print', $payment) }}" class="btn btn-dark btn-sm">Print</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">{{ $payments->links() }}</div>
    </div>
</div>
@endsection
