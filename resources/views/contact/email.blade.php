@component('mail::message')
# Le Cowee : message reçu

Vous avez reçu un message de {{ $contactData['prenom'] }} {{ $contactData['nom'] }} / {{ $contactData['email'] }}

"{{ $contactData['message'] }}"


{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

{{-- Thanks,<br>
{{ config('app.name') }} --}}

@endcomponent
