@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tag</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @include('admin.errors.form')

            {!! Form::open(['action'=>['Admin\TagsController@store'], 'method'=>'POST']) !!}
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="name">Nazov tagu</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    </div>
                </div>

            </div>


            {!! Form::button('Ulozit',['class'=>'btn btn-success','type'=>'submit','name'=>'save']) !!}
            {!! Form::button('Ulozit a ukoncit',['class'=>'btn btn-primary','type'=>'submit','name'=>'saveExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\TagsController@index')}}">Zrusit</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection