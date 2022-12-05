@component('mail::message')
# Your Cuadito Subscription Plan Has Been Posted

<p>Dear valued customer,</p>

Your payment of P{{ $payment->amount }} on {{ $payment->created_at->format('M-d-Y') }} 
for {{ $subscription->subscription_type->name }} plan has been posted to your account.
You may click here to visit <a href="#" target="_blank">Bills & Payment</a> section. <br>

Thanks you <br>
The {{ config('app.name') }} Team
@endcomponent