<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog">
    <meta name="author" content="Lukas Figura">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}"/>

    <title>Blogin</title>

    <link href="{{asset("css/bootstrap.css")}}" rel="stylesheet">
    <link href="{{asset("css/bootstrap-theme.css")}}" rel="stylesheet">
    <link href="{{asset("css/clean-blog.css")}}" rel="stylesheet">
    <link href="{{asset("css/style.css")}}" rel="stylesheet">

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{action('HomeController@index')}}">Home</a>
                    </li>
                    <li>
                        <a href="">About</a>
                    </li>
                    <li>
                        <a href="">Contact</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a>{{\Illuminate\Support\Facades\Auth::user()->name}} {{\Illuminate\Support\Facades\Auth::user()->surname}}</a>
                    </li>
                    <li>
                        <a href="">Profile</a>
                    </li>
                    <li>
                        <a href="{{action('Auth\AuthController@getLogout')}}"><span
                                    class="glyphicon glyphicon-log-out"></span></a>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{action('Auth\AuthController@getLogin')}}">Prihlasit sa</a>
                    </li>
                    <li>
                        <a href="{{action('Auth\AuthController@getRegister')}}">Registrovat sa</a>
                    </li>
                </ul>
            @endif
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

@include('flash::message')
@section('content')

@show

<hr>


<!-- Footer -->
<footer>
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        {{--<ul class="list-inline text-center">--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<span class="fa-stack fa-lg">--}}
        {{--<i class="fa fa-circle fa-stack-2x"></i>--}}
        {{--<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>--}}
        {{--</span>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<span class="fa-stack fa-lg">--}}
        {{--<i class="fa fa-circle fa-stack-2x"></i>--}}
        {{--<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>--}}
        {{--</span>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<span class="fa-stack fa-lg">--}}
        {{--<i class="fa fa-circle fa-stack-2x"></i>--}}
        {{--<i class="fa fa-github fa-stack-1x fa-inverse"></i>--}}
        {{--</span>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        <p class="copyright text-muted">Copyright &copy; Lukas Figura 2015</p>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/clean-blog.js')}}"></script>
@section('scripts')
@show
</body>
</html>
