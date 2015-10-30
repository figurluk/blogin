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

<body style="background-image: url({{ URL::asset('img/loginbg.jpg') }})">

@section('navbar')

@show

@include('flash::message')

@section('content')

@show


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
