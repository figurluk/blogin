<div>
    Dobry den {{$user->name}} {{$user->surname}},
</div>
<div>
    bolo Vam vygenerovane nove heslo administratorom.</div>
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