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
            <table class="table table-bordered">
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
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection