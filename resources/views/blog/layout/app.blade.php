<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Blogin project">
    <meta name="author" content="Lukas Figura">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}"/>

    <title>Blogin</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom'.\App\Settings::first()->design.'.css')}}" rel="stylesheet">

    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    @yield('styles')


    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300,300italic,400italic,500italic,700italic&subset=latin,greek,greek-ext,cyrillic-ext,latin-ext,cyrillic'
          rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div id="flashesDiv">
    @include('blog.flash.flash')
</div>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('Blog\HomeController@index')}}">Blogin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($menuTags as $menuTag)
                    <li>
                        <a href="{{action('Blog\TagsController@show',\App\Tags::find($menuTag->id)->code)}}">#{{\App\Tags::find($menuTag->id)->name}}</a>
                    </li>
                @endforeach
            </ul>

            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a>{{\Illuminate\Support\Facades\Auth::user()->name}} {{\Illuminate\Support\Facades\Auth::user()->surname}}</a>
                    </li>
                    <li>
                        <a href="{{action('Blog\UserController@edit')}}">Profil</a>
                    </li>
                    <li>
                        <a href="{{action('Blog\Auth\AuthController@getLogout')}}"><span
                                    class="glyphicon glyphicon-log-out"></span></a>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{action('Blog\Auth\AuthController@getLogin')}}">Prihlásiť sa</a>
                    </li>
                    <li>
                        <a href="{{action('Blog\Auth\AuthController@getRegister')}}">Registrovať sa</a>
                    </li>
                </ul>
            @endif
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

@yield('content')

@yield('footer')
        <!-- Bootstrap core JavaScript
            ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery-ui.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">

    setTimeout(function () {
        $('.flashMessage').fadeOut('fast');
    }, 3000);

</script>
@section('scripts')
@show
</body>
</html>
