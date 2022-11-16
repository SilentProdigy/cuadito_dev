@component('mail::message')
# NOTICE

<p>Dear {{ $subscription->client->name }},</p>

Your subscription for {{ $subscription->subscription_type->name }} is about to expire.

@component('mail::button', ['url' => route('client.products.index')])
Renew Subscription
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent