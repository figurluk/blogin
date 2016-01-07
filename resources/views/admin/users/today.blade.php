@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Uzivatelia</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <h3>Dnes registrovany uzivatelia</h3>
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Meno</th>
                    <th>Priezviko</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($newUsers as $newUser)
                    <tr>
                        <td>{{$newUser->name}}</td>
                        <td>{{$newUser->surname}}</td>
                        <td>{{$newUser->email}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{action('Admin\UsersController@edit',$article->id)}}"><span class="glyphicon glyphicon-pencil"></span> Upravit</a>
                            <a class="btn btn-danger" href="{{action('Admin\UsersController@remove',$article->id)}}"><span class="glyphicon glyphicon-remove"></span> Zmazat</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection