<div>
    Dobrý deň {{$comment->user->name}} {{$comment->user->surname}},
</div>
<div>
    na Váš komentár pribudla odpoveď.
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