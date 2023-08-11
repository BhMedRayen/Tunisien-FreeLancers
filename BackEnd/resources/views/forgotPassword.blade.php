@component('mail::message')
 <p style="text-align: center">Your Token</p>
 @component('mail::panel')
 <p style="font-size: 30px;text-align: center">
    {{$token}}
 </p>
    <x-mail::button url="{{env('APP_Frontend')}}/VerifyToken" color="error">
         Changer Password
    </x-mail::button>
 @endcomponent
@endcomponent