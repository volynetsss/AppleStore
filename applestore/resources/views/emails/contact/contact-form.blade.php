@component('mail::message')
# Повідомлення від користувача !

<br>
<strong>Електронна пошта:</strong><p> {{$data['email']}}</p>
<br>
<strong>Запитання, чи рекомендація:
</strong><p>{{$data['message']}}</p>
<br>


{{$data['name']}} {{$data['last_name']}}
@endcomponent
