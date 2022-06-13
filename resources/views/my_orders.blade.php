@extends('layouts.app')

@section('content')
<div class="container my-order">
    <h1>My Orders</h1>
    <div class="row header">
        <div class="col-1">Order ID</div>
        <div class="col-3">Name</div>
        <div class="col-2">Total Amount</div>
        <div class="col-4">Placed Date</div>
        <div class="col-2">Action</div>
    </div>

    @foreach ($orders as $order)
    <div class="row order-item">
        <div class="col-1">#{{ $order->id }}</div>
        <div class="col-3">{{ $order->name }}</div>
        <div class="col-2"><b>${{ $order->total_amount }}</b></div>
        <div class="col-4">{{ $order->created_at->format('d/m/Y') }}</div>
        <div class="col-2">
            <a href="/invoice?order_id={{ $order->id }}">View Invoice</a>
        </div>
    </div>
    @endforeach

    <div class="mt-3 d-flex justify-content-center">
        {!! $orders->links() !!}
    </div>
</div>
@endsection