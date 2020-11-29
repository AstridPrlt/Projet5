@component('mail::message')
# Le Cowee : Vous avez reçu un message de {{ $contactData['senderName'] }}

Bonjour {{ $contactData['contactName'] }},

Vous avez reçu un message de **{{ $contactData['senderName'] }}**<br>
Spécialité : {{ $contactData['senderJob'] }}<br>
Description : "{{ $contactData['senderDescription'] }}"



Message : <br>
"{{str_replace("<br />", "  ", nl2br($contactData['message']))}}"


A bientôt !

[![Le Cowee]({{asset('/images/logo2.png')}})]({{env('APP_URL')}})

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

{{-- Thanks,<br>
{{ config('app.name') }} --}}

@endcomponent
