@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Domov</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <h3>Dnesne novinky</h3>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($newUsers)}}</div>
                                <div>Uzivatelia!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{action('Admin\UsersController@today')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Zobrazit</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-newspaper-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($newArticles)}}</div>
                                <div>Clanky!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{action('Admin\ArticlesController@today')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Zobrazit</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($newComments)}}</div>
                                <div>Komentare!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{action('Admin\CommentsController@today')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Zobrazit</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection