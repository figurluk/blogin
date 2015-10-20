@extends('app')

@section('navbar')

        <!-- Navigation -->
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
                        <a href="">Home</a>
                    </li>
                    <li>
                        <a href="">About</a>
                    </li>
                    <li>
                        <a href="">Sample Post</a>
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
                        <a href="{{action('Auth\AuthController@getLogout')}}"><span class="glyphicon glyphicon-log-out"></span></a>
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

@stop



<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('img/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Clean Blog</h1>
                    <hr class="small">
                    <span class="subheading">A Clean Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>

@section('content')

        <!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                        Man must explore, and this is exploration at its greatest
                    </h2>

                    <h3 class="post-subtitle">
                        Problems look mighty small from 150 miles up
                    </h3>
                </a>

                <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on September 24, 2014</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                        I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.
                    </h2>
                </a>

                <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on September 18, 2014</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                        Science has not yet mastered prophecy
                    </h2>

                    <h3 class="post-subtitle">
                        We predict too much for the next year and yet far too little for the next ten.
                    </h3>
                </a>

                <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on August 24, 2014</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                        Failure is not an option
                    </h2>

                    <h3 class="post-subtitle">
                        Many say exploration is part of our destiny, but it’s actually our duty to future generations.
                    </h3>
                </a>

                <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on July 8, 2014</p>
            </div>
            <hr>
            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    <a href="#">Older Posts &rarr;</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop


@section('scripts')

@stop