<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blogin admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link href="{{asset('css/sweetalert.css')}}" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="flashesDiv">
    @include('blog.flash.flash')
</div>

<div id="wrapper">

    {{-- */
                $controller = str_replace('App\\Http\\Controllers\\','', substr(Route::currentRouteAction(), 0, (strpos(Route::currentRouteAction(), '@'))));
                /* --}}

            <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('Admin\AdminController@index')}}"><i class="fa fa-home fa-fw"></i> Blogin
                administrátor</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="{{action('Blog\HomeController@index')}}">Blogin</a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> {{Auth::user()->name}} {{Auth::user()->surname}} <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{action('Admin\UsersController@profile')}}"><i class="fa fa-user fa-fw"></i> Váš profil</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{action('Admin\Auth\AuthController@getLogout')}}"><i class="fa fa-sign-out fa-fw"></i>
                            Odhlásiť sa</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="{{($controller=='Admin\UsersController' || $controller=='Admin\AdminsController') ? 'active':''}}">
                        <a href="#"><i class="fa fa-users fa-fw"></i> Užívatelia<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="{{($controller=='Admin\UsersController') ? 'active':''}}">
                                <a href="{{action('Admin\UsersController@index')}}"><i class="fa fa-users fa-fw"></i> Užívatelia
                                    blogu</a>
                            </li>
                            <li class="{{($controller=='Admin\AdminsController') ? 'active':''}}">
                                <a href="{{action('Admin\AdminsController@index')}}"><i class="fa fa-users fa-fw"></i>
                                    Administrátori</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li class="{{($controller=='Admin\TagsController') ? 'active':''}}">
                        <a href="{{action('Admin\TagsController@index')}}"><i class="fa fa-tags fa-fw"></i> Tagy</a>
                    </li>
                    <li class="{{($controller=='Admin\ArticlesController') ? 'active':''}}">
                        <a href="{{action('Admin\ArticlesController@index')}}"><i class="fa fa-newspaper-o fa-fw"></i> Články</a>
                    </li>
                    <li class="{{($controller=='Admin\CommentsController') ? 'active':''}}">
                        <a href="{{action('Admin\CommentsController@index')}}"><i class="fa fa-comments-o fa-fw"></i>
                            Komentáre</a>
                    </li>
                    <li class="{{($controller=='Admin\SettingsController') ? 'active':''}}">
                        <a href="{{action('Admin\SettingsController@index')}}"><i class="fa fa-wrench fa-fw"></i>
                            Nastavenia</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    @yield('content')

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{asset('js/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('js/metisMenu.min.js')}}"></script>

<!-- SweetAlert Plugin JavaScript -->
<script src="{{asset('js/sweetalert.min.js')}}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{asset('js/sb-admin-2.js')}}"></script>

@yield('scripts')

<script>

    setTimeout(function () {
        $('.flashMessage').fadeOut('fast');
    }, 3000);

</script>

</body>

</html>
