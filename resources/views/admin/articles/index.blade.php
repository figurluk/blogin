@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <h1 class="page-header">
                    Clanky
                    <a class="btn btn-success pull-right" href="{{action('Admin\ArticlesController@create')}}">Vytvorit</a>
                </h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Nazov</th>
                    <th>Autor</th>
                    <th>Topovany</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->title}}</td>
                        <td>{{$article->user->name}} {{$article->user->surname}}</td>
                        <td>{{($article->topped) ? 'Ano':'Nie'}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{action('Admin\ArticlesController@edit',$article->id)}}"><span
                                        class="glyphicon glyphicon-pencil"></span> Upravit</a>
                            <a class="btn btn-danger" href="{{action('Admin\ArticlesController@remove',$article->id)}}"><span
                                        class="glyphicon glyphicon-remove"></span> Zmazat</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection