<div>
    Dobrý deň {{$user->name}} {{$user->surname}},
</div>
<div>
    boli ste zaregistrovaný ako administrátor pre <a href="{{action('Blog\HomeController@index')}}">Blogin</a></div>
<div>
    <b>Vaše heslo je:</b> {{$pass}}
</div>
<div>
    Prihlásiť sa môžte tu: <a href="{{action('Admin\Auth\AuthController@getLogin')}}">Prihlásenie</a>
</div>
<div>
    S pozdravom <br>
    Blogin
</div>