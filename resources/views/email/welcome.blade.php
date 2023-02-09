@component('mail::message')
Hey {{ $details["name"] }} 👋 ,

<p> This is your QrCode :  </p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent