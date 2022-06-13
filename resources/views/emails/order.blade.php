<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8</title>
</head>
<body>
 
 <p>Thank for your order, {{ $name }}!</p>
 <h1>Order summary</h1>
   
@component('mail::table')
| Product       | Cost          | Quantity | Total    |
| :------------ |--------------:| --------:| --------:|
@foreach ($cartItems as $cartItem)
| {{ $cartItem->name }} | ${{ $cartItem->price }} | {{ $cartItem->quantity }} | ${{ $cartItem->total }} |
@endforeach
|               |               | Subtotal | <b>${{ $totalAmount }}</b> |
@endcomponent

<p>The YCC Team<br>Sincerely!</p>

</body>
</html> 