@component('mail::message')
    Hi {{$user->name}}
    @component("mail::panel")
        <p>Lien de Vérification</p>
        <x-mail::button url="{{env('APP_Frontend')}}/login?email={{($user->email)}}" color="success">
            Verify Email
        </x-mail::button>
    @endcomponent
     TunisienFreelancers
@endcomponent