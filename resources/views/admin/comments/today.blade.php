@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Komentare</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <h3>Dnes pridane komentare</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Autor</th>
                    <th>K clanku</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($newComments as $newComment)
                    <tr>
                        <td>{{$newComment->user->name}} {{$newComment->user->surname}}</td>
                        <td>{{$newComment->article->title}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection