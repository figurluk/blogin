@extends('app')

@section('content')
        <!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Welcome on BlogIn</h1>
                    <hr class="small">
                    <span class="subheading">Blog for programmers</span>
                </div>
            </div>
        </div>
    </div>
</header>


<div class="articles-presentation">
    @foreach($articles as $article)
        <div class="pull-left presented-articles">
            <div class="presented-article" articleID="{{$article->id}}">
                <div class="presented-article-title">
                    {{$article->title}}
                </div>
                <div class="presented-article-content">
                    {{$article->content}}
                </div>
                <a class="read-article" href="{{action('ArticlesController@show',$article->id)}}">Citaj dalej</a>
            </div>
        </div>
    @endforeach
</div>
<div class="clearfix"></div>

@stop


@section('scripts')
    <script>
        var link = '{!! url('articles/') !!}';

        $('.presented-article').click(function(){
            window.location.href =link+'/'+$(this).attr('articleID');
        });

    </script>
@stop