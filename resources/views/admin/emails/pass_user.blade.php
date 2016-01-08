<div>
    Dobrý deň {{$user->name}} {{$user->surname}},
</div>
<div>
    bolo Vám vygenerované nové heslo administrátorom.</div>
<div>
    <b>Vaše heslo je:</b> {{$pass}}
</div>
<div>
    Prihlásiť sa môžte tu: <a href="{{action('Blog\Auth\AuthController@getLogin')}}">Prihlásenie</a>
</div>
<div>
    S pozdravom <br>
    Blogin
</div>