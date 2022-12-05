@component('mail::message')
# NOTICE

<p>Dear Client,</p>

We are sad to inform you that your subscription has expired already. You can try to renew your current subscription by clicking the button below.

@component('mail::button', ['url' => route('client.products.index')])
Renew Subscription
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent