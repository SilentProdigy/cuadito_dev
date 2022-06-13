<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>

<body>
    <div class="invoice">
        <div>
            <div class="invoice-row" style="height: 150px"></div>
            <div class="invoice-row" style="height: 100px; display: flex;">
                <div style="width: 51%; padding-left: 1em">
                    {{ $address->name }}<br>
                    {{ $address->address }}<br>
                    {{ $address->state }}, {{ $address->zipcode }}<br>
                    {{ $address->country }}
                </div>
                <div style="width: 49%; padding-left: 1em">
                    {{ $address->name }}<br>
                    {{ $address->address }}<br>
                    {{ $address->state }}, {{ $address->zipcode }}<br>
                    {{ $address->country }}
                </div>
            </div>
            <div class="invoice-row" style="height: 100px; padding-top: 1.3em; padding-left: 10em; display: flex">
                <div style="width: 23%">{{ $user->id }}</div>
                <div style="width: 25%">NET 13</div>
                <div style="width: 30%">{{ $order->created_at->format('d/m/Y') }}</div>
                <div style="width: 21%">{{ $order->id }}</div>
            </div>
            <div class="invoice-row" style="height: 340px;">
                @foreach ($orderItems as $key => $orderItem)
                <div style="display: flex;">
                    <div style="width: 10%;" align="center">{{ $orderItem->quantity }}</div>
                    <div style="width: 10%" align="center">{{ $orderItem->product_id }}</div>
                    <div style="width: 48%">{{ $orderItem->name }}</div>
                    <div style="width: 8%" align="center">{{ $orderItem->unit }}</div>
                    <div style="width: 10%" align="right">${{ $orderItem->price }}</div>
                    <div style="width: 15%" align="right">${{ $orderItem->total_item_amount }}</div>
                </div>
                @endforeach
            </div>
            <div class="invoice-row" style="height: 35px;" align="right">${{ $order->total_amount }}</div>
            <div class="invoice-row" style="height: 30px;" align="right">$0</div>
            <div class="invoice-row" style="height: 35px;" align="right">${{ $order->total_amount }}</div>
            <div class="invoice-row" style="height: 50px;" align="right">${{ $balanceDueAmount }}</div>
        </div>
    </div>
</body>

</html>