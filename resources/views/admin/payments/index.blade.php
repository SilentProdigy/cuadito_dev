@extends('layouts.dashboard-layout')

@section('content')
<div class="container-fluid mb-3">
    <div class="my-3">
        <form action="{{ route('admin.payments.index') }}" method="get">
            <div class="input-group input-group-lg mb-3">
                <input id="search-focus" type="text" class="form-control" placeholder="Search Payment ..." name="search" value="{{ request('search') }}">
                <button class="btn border-orange btn-orange" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            {{-- <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#advance-search-modal" style="margin-right: 2%;">Show Search Options</a> --}}

            @if(request()->has('search') || request()->has('adv_search'))
                <a href="{{ route('admin.payments.index') }}">Clear Search Results</a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>{{ request('search') ? 'We found ' . $payments->count() . ' results ...' : 'Payment Transactions'}}</h5>

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
                        <td><a href="{{ route('admin.payments.show', $payment) }}">{{ $payment->id }}</a></td>
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