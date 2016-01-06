@extends('layout.app')

@section('content')

    <div class="container-fluid main-articles-list">
        <div class="row">
            <div class="col-md-7 main-article articleDiv" article="{{$mainArt->code}}">
                <img src="{{action('ArticlesController@getImage',$mainArt->code)}}" alt="article image">
                <div class="desc1 desc" id="{{$mainArt->code}}">
                    <p><a href="{{action('ArticlesController@show',$mainArt->code)}}">{{$mainArt->title}}</a>
                            <span class="main-article-icon pull-right articleInfo">
                  <i class="fa fa-calendar-plus-o"></i> {{$mainArt->updated_at}}
                                <i class="fa fa-commenting comment-icon"></i> {{count($mainArt->comments)}}
                </span>
                    </p>
                </div>
            </div>

            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12 main-article2 articleDiv" article="{{$firstSub->code}}">
                        <img src="{{action('ArticlesController@getImage',$firstSub->code)}}" alt="article image">
                        <div class="desc2 desc" id="{{$firstSub->code}}">
                            <p><a href="{{action('ArticlesController@show',$firstSub->code)}}">{{$firstSub->title}}</a>
                                    <span class="main-article-icon2 pull-right articleInfo">
                      <i class="fa fa-calendar-plus-o"></i> {{$firstSub->updated_at}}
                                        <i class="fa fa-commenting comment-icon"></i> {{count($firstSub->comments)}}
                    </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 main-article2 articleDiv" article="{{$secondSub->code}}">
                        <img src="{{action('ArticlesController@getImage',$secondSub->code)}}" alt="article image">
                        <div class="desc2 desc" id="{{$secondSub->code}}">
                            <p>
                                <a href="{{action('ArticlesController@show',$secondSub->code)}}">{{$secondSub->title}}</a>
                                    <span class="main-article-icon2 pull-right articleInfo">
                                  <i class="fa fa-calendar-plus-o"></i> {{$secondSub->updated_at}}
                                        <i class="fa fa-commenting comment-icon"></i> {{count($secondSub->comments)}}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row sub-articles-list">
            <div class="col-md-4">
                <div class="sub-article articleDiv" article="{{$firstSubSub->code}}">
                    <img src="{{action('ArticlesController@getImage',$firstSubSub->code)}}" alt="article image">
                    <div class="desc2 desc" id="{{$firstSubSub->code}}">
                        <p>
                            <a href="{{action('ArticlesController@show',$firstSubSub->code)}}">{{$firstSubSub->title}}</a>
                                <span class="main-article-icon2 pull-right articleInfo">
                                  <i class="fa fa-calendar-plus-o"></i> {{$firstSubSub->updated_at}}
                                    <i class="fa fa-commenting comment-icon"></i> {{count($firstSubSub->comments)}}
                                </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sub-article articleDiv" article="{{$secondSubSub->code}}">
                    <img src="{{action('ArticlesController@getImage',$secondSubSub->code)}}" alt="article image">
                    <div class="desc2 desc" id="{{$secondSubSub->code}}">
                        <p>
                            <a href="{{action('ArticlesController@show',$secondSubSub->code)}}">{{$secondSubSub->title}}</a>
                                <span class="main-article-icon2 pull-right articleInfo">
                                  <i class="fa fa-calendar-plus-o"></i> {{$secondSubSub->updated_at}}
                                    <i class="fa fa-commenting comment-icon"></i> {{count($secondSubSub->comments)}}
                                </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sub-article articleDiv" article="{{$thirdSubSub->code}}">
                    <img src="{{action('ArticlesController@getImage',$thirdSubSub->code)}}" alt="article image">
                    <div class="desc2 desc" id="{{$thirdSubSub->code}}">
                        <p>
                            <a href="{{action('ArticlesController@show',$thirdSubSub->code)}}">{{$thirdSubSub->title}}</a>
                                <span class="main-article-icon2 pull-right articleInfo">
                                  <i class="fa fa-calendar-plus-o"></i> {{$thirdSubSub->updated_at}}
                                    <i class="fa fa-commenting comment-icon"></i> {{count($thirdSubSub->comments)}}
                                </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container main-content">

        <?php $i = 0; ?>
        @foreach($articles as $article)
            @if($i%4==0 && $i==0)
                <div class="row">
                    <div class="col-md-12">
                        @elseif($i%4==0)
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            @endif

                        <div class="article col-md-3">
                            <h1>{{$article->title}}</h1>
                            <p>{{substr($article->content,0,200)}} <b>...</b></p>
                            <a href="{{action('ArticlesController@show',$article->code)}}" class="btn btn-danger">Čítaj
                                ďalej</a>
                        </div>

                        <?php $i++; ?>
                        @endforeach

            @if(count($articles)!=0)
                    </div>
                </div>
            @endif
    </div>

@stop

@section('scripts')
    <script>

        $(document).ready(function () {
            $('.articleInfo').hide();
            $('.articleDiv').css('cursor', 'pointer');
        });

        $(document).on('mouseenter', '.articleDiv', function (event) {
            $(event.target).closest('.articleDiv').find('.articleInfo').fadeIn();
        });

        $(document).on('mouseleave', '.articleDiv', function (event) {
            $(event.target).closest('.articleDiv').find('.articleInfo').fadeOut();
        });

        $(document).on('click', '.articleDiv', function (event) {
            window.location.href = $(event.target).closest('.articleDiv').find('a').attr('href');
        });

    </script>
@stop