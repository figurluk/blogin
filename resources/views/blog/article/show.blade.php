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

    @include('blog.comment.index')
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
            $(document).on('click','.reactionLink',function(event) {
                event.stopPropagation();
                event.preventDefault();
                $('.reactionInput').fadeIn();
            });

            $(document).on('click','.submitForm',function(event) {
                event.stopPropagation();
                event.preventDefault();
                var commentCont = $(event.target).closest('form').find('.contentOfComment');
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
                        $('#comments').replaceWith(data);
                    }
                });
            });
        });

    </script>

@stop
