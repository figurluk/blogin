<div>
    Dobry den {{$user->name}} {{$user->surname}},
</div>
<div>
    boli ste zaregistrovany do <a href="{{action('Blog\HomeController@index')}}">Blogin</a> administratorom.</div>
<div>
    <b>Vase heslo je:</b> {{$pass}}
</div>
<div>
    Prihlasit sa mozte tu: <a href="{{action('Blog\Auth\AuthController@getLogin')}}">Prihlasenie</a>
</div>
<div>
    S pozdravom <br>
    Blogin
</div>