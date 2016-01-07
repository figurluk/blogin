@extends('blog.layout.app')

@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="article-image">
                    <img src="{{action('Blog\ArticlesController@getImage',$article->code)}}" alt="">
                    <div class="desc-article desc">
                        <div class="container">
                            <p>Nadpis článku bu bu bu
                    <span class="article-icon pull-right">
                      <i class="fa fa-calendar-plus-o"></i> {{$article->updated_at}}
                        <i class="fa fa-user comment-icon"></i> {{$article->user->name}} {{$article->user->surname}}
                        <i class="fa fa-commenting comment-icon"></i> {{count($article->comments)}}
                    </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="article-content">
                <ul class="article-tags">
                    @foreach($article->tags as $tag)
                        <li><a href="#">#{{$tag->name}}</a></li>
                    @endforeach
                </ul>

                <p>{{$article->content}}</p>

            </div>
        </div>
    </div>

    <div class="row comment">
        <div class="container">
            <h2>Komentár</h2>
            @foreach($article->comments()->orderBy('created_at','desc')->get() as $comment)
                <div class="comment-params">
                    <div class="comment-name">
                        {{$comment->user->name}} {{$comment->user->surname}}
                    </div>
                    <div class="comment-date">
                        {{$comment->created_at}}
                    </div>

                    <div class="comment-content">
                        <p>{{$comment->content}}</p>
                    </div>
                </div>
            @endforeach

            @if(Auth::check())
                <form>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Meno a priezvisko</label>
                            <input type="text" class="form-control" id="name" placeholder="Meno a priezvisko" value="{{Auth::user()->name}} {{Auth::user()->surname}}" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" value="{{Auth::user()->email}}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Správa</label>
                        <textarea class="form-control" rows="3" id="message" placeholder="Správa"></textarea>
                    </div>


                    <button type="submit" class="btn btn-danger">Vložiť</button>
                </form>

            @endif
        </div>
    </div>
@stop

@section('scripts')

@stop
