<div>
    Dobry den {{$user->name}} {{$user->surname}},
</div>
<div>
    boli ste zaregistrovany ako administrator pre <a href="{{action('Blog\HomeController@index')}}">Blogin</a></div>
<div>
    <b>Vase heslo je:</b> {{$pass}}
</div>
<div>
    Prihlasit sa mozte tu: <a href="{{action('Admin\Auth\AuthController@getLogin')}}">Prihlasenie</a>
</div>
<div>
    S pozdravom <br>
    Blogin
</div>