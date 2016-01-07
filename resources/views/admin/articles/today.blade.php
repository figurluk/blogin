@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Clanky</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <h3>Dnes pridane clanky</h3>
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Nazov</th>
                    <th>Autor</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($newArticles as $newArticle)
                    <tr>
                        <td>{{$newArticle->title}}</td>
                        <td>{{$newArticle->user->name}} {{$newArticle->user->surname}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{action('Admin\ArticlesController@edit',$article->id)}}"><span class="glyphicon glyphicon-pencil"></span> Upravit</a>
                            <a class="btn btn-danger" href="{{action('Admin\ArticlesController@remove',$article->id)}}"><span class="glyphicon glyphicon-remove"></span> Zmazat</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection