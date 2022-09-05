@component('mail::message')
# Hello {{ $recepient->name }}! {{ $sender->name }} just messaged you!

Click the button below to go read the message.

@component('mail::button', ['url' => route('client.conversations.show', $conversation)])
Read Message
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent