@component('mail::message')
# Le Cowee : message reçu

Vous avez reçu un message de {{ $contactData['prenom'] }} {{ $contactData['nom'] }} / {{ $contactData['email'] }}

"{{str_replace("<br />", "  ", nl2br($contactData['message']))}}"


{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

{{-- Thanks,<br>
{{ config('app.name') }} --}}

@endcomponent
