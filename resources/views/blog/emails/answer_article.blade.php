<div>
    Dobrý deň {{$comment->articles->user->name}} {{$comment->articles->user->surname}},
</div>
<div>
    na Váš článok pribudla odpoveď.
</div>
<div>
    Prečítať si ju môžete <a href="{{action('Blog\ArticlesController@show',$comment->articles->code)}}">tu.</a>
</div>
<div>
    S pozdravom
</div>
<div>
    Blogin
</div>