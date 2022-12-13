@extends('layouts.client-main-layout')

@section('content')    

    <div class="container px-5">
        <section class="mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="container mb-5 mt-3">
                        <div class="row d-flex align-items-baseline">
                            <div class="col-xl-9">
                            <p style="color: #FF5F00;font-size: 20px;">Invoice >> <strong>ID: #000{{ $payment->id }}</strong></p>
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
                                    <img src="{{ asset('images/logo/logo.png') }}" width="100px" class="img-fluid" alt="CUADITO Logo">
                                    <!-- <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i> -->
                                </div>
                            </div>


                            <div class="row mt-5">
                            <div class="col-xl-8">
                                <ul class="list-unstyled">
                                <li class="text-muted">To: <span style="color:#FF5F00 ;">{{ auth('client')->user()->name }}</span></li>
                                <li class="text-muted">{{ auth('client')->user()->address }}</li>
                                <li class="text-muted"><i class="fas fa-phone"></i> {{ auth('client')->user()->contact_number }}</li>
                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <p class="text-muted">Invoice</p>
                                <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#FF5F00 ;"></i> <span
                                    class="fw-bold">ID:</span>#{{ $payment->id }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#FF5F00 ;"></i> <span
                                    class="fw-bold">Creation Date: </span>{{ $payment->created_at->format('M d,Y') }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#FF5F00 ;"></i> <span
                                    class="me-1 fw-bold">Status:</span><span class="badge bg-success text-black fw-bold">
                                    Paid</span></li>
                                </ul>
                            </div>
                            </div>

                            <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped table-borderless">
                                <thead style="background-color:#FF5F00 ;" class="text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Subscription Type</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $subscription_type->name }}</td>
                                    <td>{{ $payment->details }}</td>
                                    <td>1 Month/s</td>
                                    <td>&#8369; {{ $payment->amount }}</td>
                                    <td>&#8369; {{ $payment->amount }}</td>
                                </tr>
                                </tbody>

                            </table>
                            </div>
                            <div class="row">
                            <div class="col-xl-7">
                                <p class="ms-3"><b>MODE OF PAYMENT: </b><i class="fab fa-cc-mastercard fa-lg text-dark pe-2"></i>{{ $payment->mode_of_payment }}</p>

                            </div>
                            <div class="col-xl-4">
                                <ul class="list-unstyled float-end">
                                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>&#8369; {{ $payment->amount }}</li>
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(12%)</span>&#8369; {{ $payment->additional_vat }}</li>
                                </ul>
                                <p class="text-black float-end"><span class="text-black me-3"> Total Amount</span><span
                                    style="font-size: 25px;">&#8369; {{ $payment->total_amount }}</span></p>
                            </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xl-12 text-center">
                                    <p>Thank you for your purchase</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h1 class="my-2">Invoice</h1>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Invoice ID</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->id }}</p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Payment Date</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $payment->created_at->format('M d,Y') }}</p>
                            </div>

                            <div class="my-2 py-3">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Product</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">{{ $subscription_type->name }}</p>
                            </div>

                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Price</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">@money($subscription_type->amount)</p>
                            </div>

                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Billed Months</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">1 Month/s</p>
                            </div>

                            <div class="my-2 py-3 border-top">
                                <h5 class="text-uppercase text-secondary fw-bold fs-6 py-2">Total Amount</h5>
                                <p class="fs-6 lh-lg" style="color: #222;">@money( $payment->total_amount )</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->
        </section>

    </div>
@endsection
