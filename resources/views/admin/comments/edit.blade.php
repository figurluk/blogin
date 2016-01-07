@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Komentar</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @include('admin.errors.form')

            {!! Form::open(['action'=>['Admin\CommentsController@update',$comment->id], 'method'=>'POST']) !!}
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="cont">Obsah komentaru</label>
                        <textarea class="form-control" id="cont" name="cont">{{$comment->content}}
                            </textarea>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('article', 'Clanok:', ['class'=>'col-sm-5 control-label']) !!}
                        <div class="col-sm-7">
                            {!! Form::select('article', $articles, $comment->articles->id, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

            </div>


            {!! Form::button('Ulozit',['class'=>'btn btn-success','type'=>'submit','name'=>'update']) !!}
            {!! Form::button('Ulozit a ukoncit',['class'=>'btn btn-primary','type'=>'submit','name'=>'updateExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\CommentsController@index')}}">Zrusit</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection