@extends('layouts.client-main-layout')

@section('content')  
<div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                    <p style="font-size: 20px;">Invoice >> <strong class="text-orange">ID: #{{ $payment->invoice_id }}</strong></p>
                    </div>
                    <div class="col-xl-3 d-flex justify-content-end">
                        <a href="{{ route('client.payments.print', $payment) }}" class="btn btn-orange text-capitalize border-0" data-mdb-ripple-color="dark"><i
                            class="fas fa-print text-white"></i> Print</a>
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
                        <li class="text-muted">To: <span class="fw-bold">{{ auth('client')->user()->name; }}</span></li>
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
                                <span class="fw-bold">REFERENCE NO.</span>#{{ $reference_no }}
                            </li>
                            <li class="text-muted">
                                <i class="fas fa-circle text-orange"></i> 
                                <span class="fw-bold">Creation Date: </span>Jun 23,2021
                            </li>
                            <li class="text-muted">
                                <i class="fas fa-circle text-orange"></i> 
                                <span class="me-1 fw-bold">Status:</span>{{ $status }}
                            </li>
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
    <!-- <div class="container px-5">
        <section class="mt-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h1 class="my-2">Payment Details</h1>
                            </div>                            
                        </div>
                        <div class="card-body">
                            
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Transaction ID</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->invoice_id }}</p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Reference No</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $reference_no }}</p>
                            </div>

                            {{-- <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Payment Method</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment_method }}</p>
                            </div> --}}
                            
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Status</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $status }}</p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Created At</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->created_at->format('M d,Y') }}</p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Payment Date</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->paid_at?->format('M d,Y') }}</p>
                            </div>
                                
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Product</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    {{ $payment->subscription->subscription_type->name }} Plan
                                </p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Unit Price</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    @money($payment->subscription->subscription_type->amount)
                                </p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Total Payment</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    @money($payment->total_amount)
                                </p>
                            </div>
                                
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Discount</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    @money(0)
                                </p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">VAT</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">
                                    @money($payment->additional_vat)
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> -->
    <!-- <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
                <div class="col-xl-9">
                <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #{{ $payment->invoice_id }}</strong></p>
                </div>
                <div class="col-xl-3 float-end">
                <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                    class="fas fa-print text-primary"></i> Print</a>
                <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                    class="far fa-file-pdf text-danger"></i> Export</a>
                </div>
                <hr>
            </div>

            <div class="container">
                <div class="col-md-12">
                <div class="text-center">
                    <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                    <p class="pt-0">MDBootstrap.com</p>
                </div>

                </div>


                <div class="row">
                <div class="col-xl-8">
                    <ul class="list-unstyled">
                    <li class="text-muted">To: <span style="color:#5d9fc5 ;">John Lorem</span></li>
                    <li class="text-muted">Street, City</li>
                    <li class="text-muted">State, Country</li>
                    <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
                    </ul>
                </div>
                <div class="col-xl-4">
                    <p class="text-muted">Invoice</p>
                    <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">ID:</span>#{{ $payment->invoice_id }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Creation Date: </span>Jun 23,2021</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="me-1 fw-bold">Status:</span><span class="badge bg-success text-white fw-bold">
                        Paid</span></li>
                    </ul>
                </div>
                </div>

                <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                    <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Pro Package</td>
                        <td>4</td>
                        <td>$200</td>
                        <td>$800</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Web hosting</td>
                        <td>1</td>
                        <td>$10</td>
                        <td>$10</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Consulting</td>
                        <td>1 year</td>
                        <td>$300</td>
                        <td>$300</td>
                    </tr>
                    </tbody>

                </table>
                </div>
                <div class="row">
                <div class="col-xl-8">
                    <p class="ms-3">Add additional notes and payment information</p>

                </div>
                <div class="col-xl-3">
                    <ul class="list-unstyled">
                    <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
                    </ul>
                    <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                        style="font-size: 25px;">$1221</span></p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-xl-10">
                    <p>Thank you for your purchase</p>
                </div>
                <div class="col-xl-2">
                    <button type="button" class="btn btn-primary text-capitalize"
                    style="background-color:#60bdf3 ;">Pay Now</button>
                </div>
                </div>

            </div>
            </div>
        </div>
    </div> -->
@endsection
