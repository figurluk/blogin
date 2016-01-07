@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Clanok</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @include('admin.errors.form')

            {!! Form::open(['action'=>['Admin\ArticlesController@store'], 'method'=>'POST', 'files'=>true]) !!}
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Nazov clanku</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                    </div>

                    <div class="form-group">
                        <label for="cont">Obsah clanku</label>
                        {!! Form::textarea('cont',old('content'),['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                        <label>
                            {!! Form::hidden('topped', 0) !!}
                            {!! Form::checkbox('topped', 1, old('topped')) !!} <b>Topovanie clanku</b>
                        </label>
                    </div>

                    <div class="form-group">
                        {!! Form::label('tags', 'Tagy:', ['class'=>'col-sm-5 control-label']) !!}
                        <div class="col-sm-7">
                            {!! Form::select('tags[]', $tags, null, ['class'=>'form-control', 'multiple']) !!}
                        </div>
                    </div>

                    <div>
                        <img class="articleImage" src="{{action('Blog\ArticlesController@getImage','default')}}"
                             alt="default.png">
                    </div>
                    <div class="label label-danger">
                        Predvoleny obrazok vidite vyssie.
                    </div>
                    <div class="form-group">
                        <label for="image">Obrazok clanku</label>
                        {!! Form::file('image') !!}
                    </div>
                </div>
            </div>


            {!! Form::button('Ulozit',['class'=>'btn btn-success','type'=>'submit','name'=>'save']) !!}
            {!! Form::button('Ulozit a ukoncit',['class'=>'btn btn-primary','type'=>'submit','name'=>'saveExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\ArticlesController@index')}}">Zrusit</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection