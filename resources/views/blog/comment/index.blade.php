<div id="comments" class="row comment">
    <div class="container">
        <h2>Komentár</h2>
        @foreach($article->comments()->orderBy('created_at','desc')->get() as $comment)
            <div class="comment-params">
                <div class="comment-1lvl">
                    <div class="comment-name">
                        {{$comment->user->name}} {{$comment->user->surname}}
                    </div>
                    <div class="comment-date">
                        {{$comment->created_at}}
                    </div>

                    <div class="comment-content">
                        <p>{{$comment->content}}</p>
                    </div>
                    <a href="#" class="comment-reply reactionLink">Reagovať</a>
                    <div class="form-group reactionInput" style="display: none">
                        <hr>
                        <input type="hidden" name="comment" value="{{$comment->id}}">
                        <textarea name="content" class="form-control" rows="2" placeholder="Reakcia na {{$comment->user->name}} {{$comment->user->surname}}"></textarea>
                        <button type="submit" class="btn btn-danger">Reagovať</button>
                    </div>
                </div>
                @foreach($comment->comments()->orderBy('created_at','desc')->get() as $comment_lvl)
                    <div class="comment-2lvl">
                        <div class="comment-name">
                            {{$comment_lvl->user->name}} {{$comment_lvl->user->surname}}
                        </div>
                        <div class="comment-date">
                            {{$comment_lvl->created_at}}
                        </div>

                        <div class="comment-content">
                            <p>{{$comment_lvl->content}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        @if(Auth::check())
            {!! Form::open(['action'=>['Blog\ArticlesController@comment',$code],'method'=>'POST']) !!}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Meno a priezvisko</label>
                        <input type="text" class="form-control" id="name" placeholder="Meno a priezvisko"
                               value="{{Auth::user()->name}} {{Auth::user()->surname}}" disabled>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email"
                               value="{{Auth::user()->email}}" disabled>
                    </div>
                </div>

                <div class="form-group contentOfComment">
                    <label for="message">Správa</label>
                    <input class="commentId" type="hidden" name="comment" value="0">
                    <textarea name="cont" class="form-control commentMessage" rows="4" placeholder="Správa"></textarea>
                </div>


                <button type="submit" class="btn btn-danger submitForm">Vložiť</button>
            {!! Form::close() !!}

        @endif
    </div>
</div>