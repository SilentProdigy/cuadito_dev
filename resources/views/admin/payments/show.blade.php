@extends('layouts.dashboard-layout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
                <div class="col-xl-9">
                <p style="font-size: 20px;">Invoice >> <strong class="text-orange">ID: #{{ $payment->invoice_id }}</strong></p>
                </div>
                <div class="col-xl-3 d-flex justify-content-end">
                    {{-- <a href="{{ route('client.payments.print', $payment) }}" class="btn btn-orange text-capitalize border-0" data-mdb-ripple-color="dark"><i
                        class="fas fa-print text-white"></i> Print</a> --}}
                </div>
                <hr>
            </div>

            <div class="container">
                <div class="col-md-12">
                <div class="text-center">
                    <img src="{{asset('images/logo/logo.png')}}" height="100" alt="Cuadito Logo" loading="lazy" />
                    <p class="pt-0">Cuadito.com.ph</p>
                </div>

                </div>


                <div class="row">
                <div class="col-xl-8">
                    <ul class="list-unstyled">
                    <li class="text-muted">To: <span class="fw-bold">{{ $payment->client->name; }}</span></li>
                    </ul>
                </div>
                <div class="col-xl-4">
                    <p class="text-muted">Invoice</p>
                    <ul class="list-unstyled">
                    <li class="text-muted">
                        <i class="fas fa-circle text-orange"></i> 
                        <span class="fw-bold">ID:</span>#{{ $payment->invoice_id }}
                    </li>
                    <li class="text-muted">
                        <i class="fas fa-circle text-orange"></i> 
                        <span class="fw-bold">REFERENCE NO.</span>#{{ $payment->reference_no }}
                    </li>
                    <li class="text-muted"><i class="fas fa-circle text-orange"></i> <span
                        class="fw-bold">Creation Date: </span>{{ $payment->created_at->format('M d,Y') }}</li>
                    <li class="text-muted"><i class="fas fa-circle text-orange"></i> <span
                        class="me-1 fw-bold">Status:</span><span class="badge bg-success text-white fw-bold">
                        Paid</span></li>
                    </ul>
                </div>
                </div>

                <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                    <thead class="text-white bg-orange">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Billed Month</th>
                        <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $payment->subscription->subscription_type->name }} Plan</td>
                            <td>{{ $payment->created_at->format('M d,Y') }}</td>
                            <td>&#8369;{{$payment->subscription->subscription_type->amount}}</td>
                            <td>{{ $payment->period }}</td>
                            <td>&#8369;{{ $payment->subscription->subscription_type->amount * 12 }}.00</td>
                        </tr>
                    </tbody>

                </table>
                </div>
                <div class="row">
                <div class="col-xl-8">
                    <!-- <p class="ms-3">Add additional notes and payment information</p> -->

                </div>
                <div class="col-xl-3">
                    <ul class="list-unstyled">
                    <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>&#8369;{{ $payment->subscription->subscription_type->amount * 12 }}.00</li>
                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(0%)</span>&#8369;0.00</li>
                    </ul>
                    <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                        style="font-size: 25px;">&#8369;{{ $payment->subscription->subscription_type->amount * 12 }}.00</span></p>
                </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Thank you for your purchase</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>  
@endsection

@section('script')

@endsection