@extends('blog.layout.app')

@section('content')
    <div id="content">
        <div class="row">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="article-image">
                        <img src="{{action('Blog\ArticlesController@getImage',$article->code)}}" alt="">
                        <div class="desc-article desc">
                            <div class="container">
                                <p>{{$article->title}}
                    <span class="article-icon pull-right">
                      <i class="fa fa-calendar-plus-o"></i> {{$article->updated_at}}
                        <i class="fa fa-user comment-icon"></i> {{($article->user!=null) ? $article->user->name.' '.$article->user->surname:'Neznámy'}}
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

        @include('admin.errors.form')

        <div id="comments" class="row comment">
            <div class="container">
                <h2>Komentár</h2>
                @foreach($article->comments()->where('comments_id',null)->orderBy('created_at')->get() as $comment)
                    <div class="comment-params">
                        <div class="comment-1lvl">
                            <div class="comment-name">
                                {{($comment->user!=null) ? $comment->user->name.' '.$comment->user->surname:'Neznámy'}}
                            </div>
                            <div class="comment-date">
                                {{$comment->created_at}}
                            </div>

                            <div class="comment-content">
                                <p>{{$comment->content}}</p>
                            </div>
                            <a href="#" class="comment-reply reactionLink" data-targetID="{{$comment->id}}"
                               style="display: none">Reagovať</a>
                            <div class="form-group subComment reactionInput{{$comment->id}}">
                                <hr>
                                {!! Form::open(['action'=>['Blog\ArticlesController@comment',$code],'method'=>'POST']) !!}
                                <div class="contentOfComment">
                                    <input class="commentId" type="hidden" name="comment" value="{{$comment->id}}">
                                <textarea name="cont" class="form-control commentMessage" rows="2"
                                          placeholder="Reakcia na {{($comment->user!=null) ? $comment->user->name.' '.$comment->user->surname:'Neznámy'}}"></textarea>
                                    <button type="submit" class="btn btn-danger submitForm">Reagovať</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        @foreach($comment->comments()->whereNotNull('comments_id')->orderBy('created_at')->get() as $comment_lvl)
                            <div class="comment-2lvl">
                                <div class="comment-name">
                                    {{($comment_lvl->user!=null) ? $comment_lvl->user->name.' '.$comment_lvl->user->surname:'Neznámy'}}
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
                        <input class="commentId" type="hidden" name="comment" value="0">
                        <label for="cont">Správa</label>
                        <textarea id="cont" name="cont" class="form-control commentMessage" rows="4"
                                  placeholder="Správa" required></textarea>
                        <span class="register-error-empty"
                              style="display:none">Toto pole musí byť vyplnené!</span>
                    </div>


                    <button type="submit" class="btn btn-danger submitForm">Vložiť</button>
                    {!! Form::close() !!}

                @endif
            </div>
        </div>
    </div>
@stop

@section('footer')

    <div class="footer">
        <div class="categories">
            <div class="container-fluid">
                <div class="col-md-12">
                    <span class="pull-right copyrightSign"><i class="fa fa-copyright"></i> Lukas Figura 2016
                    </span>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        $(document).ready(function () {
            $('.reactionLink').show();
            $('.subComment').hide();

            $(document).on('click', '.reactionLink', function (event) {
                event.stopPropagation();
                event.preventDefault();
                $('.reactionInput' + $(event.target).attr('data-targetID')).fadeIn();
            });

            $(document).on('click', '.submitForm', function (event) {
                console.log("llukas je pnak bo nedebuguje!");

                event.stopPropagation();
                event.preventDefault();
                var commentCont = $(event.target).closest('form').find('.contentOfComment');

                function validateTextarea(input) {
                    var val = input.val();
                    validInput = (val.length != 0);
                    if (validInput) {
                        validityShow(input, "");
                    } else {
                        validityShow(input, "empty");
                    }
                    return validInput;
                }

                function validityShow(input, status) {
                    var parent = input.parent().closest('div');

                    if (status == "empty") {
                        parent.addClass("has-error");
                        parent.find('.register-error-empty').css('display', '');
                        parent.find('.register-error-invalid').css('display', 'none');
                    } else if (status == "invalid") {
                        parent.addClass("has-error");
                        parent.find('.register-error-empty').css('display', 'none');
                        parent.find('.register-error-invalid').css('display', '');
                    } else {
                        parent.removeClass("has-error");
                        parent.find('.register-error-empty').css('display', 'none');
                        parent.find('.register-error-invalid').css('display', 'none');
                    }
                }

                var validContent = validateTextarea(commentCont.find('.commentMessage'));
                if (!validContent)
                    return;

                $.ajax({
                    url: '{{action('Blog\ArticlesController@comment',$code)}}',
                    type: 'POST',
                    data: {
                        cont: commentCont.find('.commentMessage').val(),
                        comment: commentCont.find('.commentId').val()
                    },
                    error: function () {
                    },
                    success: function (data) {
                        $('#content').replaceWith(data['content']);
                        $('.reactionLink').show();
                        $('.subComment').hide();
                    }
                });
            });
        });

    </script>

@stop
