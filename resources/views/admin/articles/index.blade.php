@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Clanky</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nazov</th>
                    <th>Autor</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->title}}</td>
                        <td>{{$article->user->name}} {{$article->user->surname}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection