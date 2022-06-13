@extends('layouts.dashboard-layout')

@section('content')
<h2>ORDERS</h2>
<div class="card">

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <th>Order ID</th>
                <th>Name</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Placed Date</th>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</a></td>
                    <td>{{ $order->address->name }} </td>
                    <td>${{ $order->total_amount }}</td>
                    <td>
                        @if ($order->status == 'PAID')
                        <label class="label green">{{ $order->status }}</label>
                        @endif
                        @if ($order->status == 'UNPAID')
                        <label class="label gray">{{ $order->status }}</label>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">{{ $orders->links() }}</div>
    </div>
</div>
@endsection