@extends('blog.layout.app')

@section('content')

    <div class="container-fluid main-articles-list">
        @include('blog.flash.flash')
        <div class="row">
            @if($mainArt!=null)
                <div class="col-md-7 main-article articleDiv" article="{{$mainArt->code}}">
                    <img src="{{action('Blog\ArticlesController@getImage',$mainArt->code)}}" alt="article image">
                    <div class="desc1 desc" id="{{$mainArt->code}}">
                        <p><a href="{{action('Blog\ArticlesController@show',$mainArt->code)}}">{{$mainArt->title}}</a>
                            <span class="main-article-icon pull-right articleInfo">
                  <i class="fa fa-calendar-plus-o"></i> {{$mainArt->updated_at}}
                                <i class="fa fa-user comment-icon"></i> {{$mainArt->user->name}} {{$mainArt->user->surname}}
                                <i class="fa fa-commenting comment-icon"></i> {{count($mainArt->comments)}}
                </span>
                        </p>
                    </div>
                </div>
            @endif
            <div class="col-md-5">
                @if($firstSub!=null)
                    <div class="row">
                        <div class="col-md-12 main-article2 articleDiv" article="{{$firstSub->code}}">
                            <img src="{{action('Blog\ArticlesController@getImage',$firstSub->code)}}"
                                 alt="article image">
                            <div class="desc2 desc" id="{{$firstSub->code}}">
                                <p>
                                    <a href="{{action('Blog\ArticlesController@show',$firstSub->code)}}">{{$firstSub->title}}</a>
                                    <span class="main-article-icon2 pull-right articleInfo">
                      <i class="fa fa-calendar-plus-o"></i> {{$firstSub->updated_at}}
                                        <i class="fa fa-user comment-icon"></i> {{$firstSub->user->name}} {{$firstSub->user->surname}}
                                        <i class="fa fa-commenting comment-icon"></i> {{count($firstSub->comments)}}
                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($secondSub!=null)
                    <div class="row">
                        <div class="col-md-12 main-article2 articleDiv" article="{{$secondSub->code}}">
                            <img src="{{action('Blog\ArticlesController@getImage',$secondSub->code)}}"
                                 alt="article image">
                            <div class="desc2 desc" id="{{$secondSub->code}}">
                                <p>
                                    <a href="{{action('Blog\ArticlesController@show',$secondSub->code)}}">{{$secondSub->title}}</a>
                                    <span class="main-article-icon2 pull-right articleInfo">
                                  <i class="fa fa-calendar-plus-o"></i> {{$secondSub->updated_at}}
                                        <i class="fa fa-user comment-icon"></i> {{$secondSub->user->name}} {{$secondSub->user->surname}}
                                        <i class="fa fa-commenting comment-icon"></i> {{count($secondSub->comments)}}
                                </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row sub-articles-list">
            @if($firstSubSub!=null)
                <div class="col-md-4">
                    <div class="sub-article articleDiv" article="{{$firstSubSub->code}}">
                        <img src="{{action('Blog\ArticlesController@getImage',$firstSubSub->code)}}"
                             alt="article image">
                        <div class="desc2 desc" id="{{$firstSubSub->code}}">
                            <p>
                                <a href="{{action('Blog\ArticlesController@show',$firstSubSub->code)}}">{{$firstSubSub->title}}</a>
                                <span class="main-article-icon2 pull-right articleInfo">
                                  <i class="fa fa-calendar-plus-o"></i> {{$firstSubSub->updated_at}}
                                    <i class="fa fa-user comment-icon"></i> {{$firstSubSub->user->name}} {{$firstSubSub->user->surname}}
                                    <i class="fa fa-commenting comment-icon"></i> {{count($firstSubSub->comments)}}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if($secondSubSub!=null)
                <div class="col-md-4">
                    <div class="sub-article articleDiv" article="{{$secondSubSub->code}}">
                        <img src="{{action('Blog\ArticlesController@getImage',$secondSubSub->code)}}"
                             alt="article image">
                        <div class="desc2 desc" id="{{$secondSubSub->code}}">
                            <p>
                                <a href="{{action('Blog\ArticlesController@show',$secondSubSub->code)}}">{{$secondSubSub->title}}</a>
                                <span class="main-article-icon2 pull-right articleInfo">
                                  <i class="fa fa-calendar-plus-o"></i> {{$secondSubSub->updated_at}}
                                    <i class="fa fa-user comment-icon"></i> {{$secondSubSub->user->name}} {{$secondSubSub->user->surname}}
                                    <i class="fa fa-commenting comment-icon"></i> {{count($secondSubSub->comments)}}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if($thirdSubSub!=null)
                <div class="col-md-4">
                    <div class="sub-article articleDiv" article="{{$thirdSubSub->code}}">
                        <img src="{{action('Blog\ArticlesController@getImage',$thirdSubSub->code)}}"
                             alt="article image">
                        <div class="desc2 desc" id="{{$thirdSubSub->code}}">
                            <p>
                                <a href="{{action('Blog\ArticlesController@show',$thirdSubSub->code)}}">{{$thirdSubSub->title}}</a>
                                <span class="main-article-icon2 pull-right articleInfo">
                                  <i class="fa fa-calendar-plus-o"></i> {{$thirdSubSub->updated_at}}
                                    <i class="fa fa-user comment-icon"></i> {{$thirdSubSub->user->name}} {{$thirdSubSub->user->surname}}
                                    <i class="fa fa-commenting comment-icon"></i> {{count($thirdSubSub->comments)}}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
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
                            <a href="{{action('Blog\ArticlesController@show',$article->code)}}" class="btn btn-danger">Čítaj
                                ďalej</a>
                        </div>

                        <?php $i++; ?>
                        @endforeach

                        @if(count($articles)!=0)
                    </div>
                </div>
            @endif

            <div id="nextArticles"></div>
    </div>



    @if(count($articles)+6<count(\App\Articles::all()))
        <div class="row read-more">
            <div class="container-fluid">
                <a href="{{action('Blog\TagsController@more',[$tag->code,count($articles)+14])}}"
                   class="btn btn-default btn-read-more">Ďalšie články</a>
            </div>
        </div>
    @endif

@stop

@section('footer')

    @if((isset($articles) && count($articles)!=0) ||!(isset($articles)))
        <div class="footer">
            @else
                <div class="footer stickyfooter">
                    @endif

                    <div class="categories">
                        <div class="container-fluid">
                            <div class="col-md-12">
                    <span class="pull-right copyrightSign"><i class="fa fa-copyright"></i> Lukas Figura 2016
                    </span>
                                <ul>
                                    @foreach(array_slice($periods,0,5) as $period)
                                        <li class="">
                                            <a href="{{action('Blog\TagsController@filterShow',[$tag->code,$period['month'],$period['year']])}}">{{$period['monthName']}} {{$period['year']}}</a>
                                        </li>
                                    @endforeach
                                    @if(count($periods)>5)
                                        <li><a href="">Starsie</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @endsection

            @section('scripts')
                <script>

                    $(document).ready(function () {
                        $('.articleInfo').hide();
                        $('.articleDiv').css('cursor', 'pointer');
                        $('.read-more').hide();

                        var allArticles = '{{count(\App\Articles::all())}}';
                        var countArticles = '{{count($articles)+6}}';
                        var requestPenging = false;

                        $(window).scroll(function () {
                            if ($(window).scrollTop() + $(window).height() == $(document).height()) {

                                if (countArticles < allArticles && !requestPenging) {
                                    requestPenging = true;
                                    $.ajax({
                                        url: '{{url('home/tags/')}}' + '/{{$tag->code}}/next/' + countArticles,
                                        type: 'get',
                                        error: function () {
                                        },
                                        success: function (data) {
                                            countArticles = parseInt(countArticles) + parseInt(4);
                                            $('#nextArticles').replaceWith(data);
                                            requestPenging = false;
                                        }
                                    });
                                }
                            }
                        });
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