@extends('layouts.dashboard-layout')

@section('content')
<div class="container-fluid mb-3">
    <div class="d-flex flex-row d-align-items-center justify-content-center">
        <div class="table-titles">System Payments</div>
        <div class="col d-flex justify-content-end">
            <form action="{{ route('admin.payments.index') }}" method="get">
                <div class="input-group input-group-lg mb-3">
                    <input type="text" class="form-control " placeholder="Search Payments ..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-warning" type="submit">
                        SEARCH
                    </button>
                    <a href="{{ route('admin.payments.index') }}">Clear</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>{{ request('search') ? 'We found ' . $payments->count() . ' results ...' : 'Your Payment Transactions'}}</h5>

        <table class="table table-borderless table-md user-listing-table" id="payment-history-table">
            <thead>     
                <th>SEQ</th>          
                <th>INVOICE #</th>
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
                        <td>{{ $payment->invoice_id }}</td>
                        <td>{{ $payment->or_number ?? "-" }}</td>
                        <td>{{ $payment->subscription->subscription_type->name }} Plan</td>
                        <td>{{ $payment->status }}</td>
                        <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                        <td>{{ $payment->paid_at?->format('Y-m-d') }}</td>
                        <td>@money( $payment->total_amount )</td>
                        <td>
                            <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-primary btn-sm">View Details</a>
                            {{-- <a href="{{ route('client.payments.print', $payment) }}" class="btn btn-dark btn-sm">Print</a> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No results found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">{{ $payments->links() }}</div>
    </div>
</div>


@endsection

@section('script')

@endsection