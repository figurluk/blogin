@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administratori</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

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
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->surname}}</td>
                        <td>{{$admin->email}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection