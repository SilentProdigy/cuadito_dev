@component('mail::message')
# Hi! {{ $contact->name }}

{{ $contact->client->name }} is inviting you to join our platform. Click the button below to go to the register page.

@component('mail::button', ['url' => route('client.auth.show-register-form', ['code' => $contact->id])])
Join Us Now
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent