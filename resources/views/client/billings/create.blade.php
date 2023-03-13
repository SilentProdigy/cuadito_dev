<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cuadito') }} | Billing</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ App::environment('local') ? asset('images/logo/logo.png') : secure_asset('images/logo/favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <script src="https://kit.fontawesome.com/7a6e9affc7.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css"
    rel="stylesheet"
    />
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/mdb.min.js') }}" defer></script>

    @yield('style')

</head>

<body>
    <main style="margin-top: 58px;">
        <div class="container px-5">
            @include('panels.flash_messages')
            <section>
                <div class="container py-5">
                    <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center pb-5">
                        <div class="col-md-4 col-xl-4 mb-4 mb-md-0">
                            <div class="py-4 d-flex flex-row">
                                <h5><span class="far fa-check-square pe-2"></span><b>CUADITO</b> |</h5>
                                <span class="ps-2">Payment Gateways Available</span>
                            </div>
                            <hr />
                            <div class="pt-2">
                            <!-- <div class="d-flex pb-2">
                                <div class="ms-auto">
                                <p class="text-primary">
                                    <i class="fas fa-plus-circle text-primary pe-1"></i>Add payment card
                                </p>
                                </div>
                            </div> -->
                            <form id="checkout-form" action="{{ route('client.payments.proposal.store', $bidding) }}" method="POST" class="pb-3">
                                @csrf
                                @foreach ($payment_channels as $channel)
                                    <div class="d-flex flex-row pb-3">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input" type="radio" name="payment_channel"
                                            value="{{ $channel['procId'] }}"
                                            required/>
                                        </div>
                                        <div class="rounded border d-flex w-100 p-3 align-items-center">
                                            <p class="mb-0">
                                                @if($channel['logo'])
                                                <img src="{{ $channel['logo'] }}" style="width: 100px; height: 50px;" alt="logo">
                                                @else
                                                    <i class="fa fa-building-columns fs-5"></i> &nbsp;
                                                @endif
                                                {{ $channel['longName'] }}
                                            </p>
                                        </div>
                                    </div>    
                                @endforeach    
                                
                            </form>
                            <!-- <a href="javascript::void()" class="btn btn-orange btn-block btn-lg" onclick="document.getElementById('checkout-form').submit()">Proceed To Checkout</a> -->
                            
                            <!-- <input type="button" value="Proceed to payment" class="btn btn-orange btn-block btn-lg" /> -->
                            </div>
                        </div>

                        <div class="col-md-8 col-xl-7 offset-xl-1">
                            <div class="py-4 d-flex justify-content-end">
                                <h6><a href="{{ url()->previous() }}" class="text-orange">Cancel and return to website</a></h6>
                            </div>
                            <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">
                                {{-- <div class="p-2 d-flex">
                                    <div class=col-8><h4>{{ $payment_type->name }}</h4></div>
                                    <div class="ms-auto"><h4>@money($payment_type->amount)</h4></div>
                                </div>
                                 --}}
                                
                                <div class="border-top px-2 mx-2"></div>
                                <div class="p-2 d-flex pt-3">
                                    <div class=col-8><h4>Total Amount</h4></div>
                                    <div class="ms-auto"><h4 class="text-success">@money($total_amount)</h4></div>
                                </div>store

                                <div class="p-2 d-flex pt-3">
                                    <p>
                                        This is an estimate for the portion of your order (not covered by
                                        insurance) due today . once insurance finalizes their review refunds
                                        and/or balances will reconcile automatically.
                                    </p>
                                </div>
                            </div>
                            <a href="javascript::void()" class="btn btn-orange btn-block btn-lg mt-5" onclick="document.getElementById('checkout-form').submit()">Proceed To Checkout</a>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
<!-- MDB -->
<script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"
    ></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @yield('script')
    <script>
    //     $(document).ready(function(){
    //     $("#subscriptionModal").modal('show');
    // });
    </script>
</body>

</html>
