@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administrator</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @include('admin.errors.form')

            {!! Form::open(['action'=>['Admin\AdminsController@store'], 'method'=>'POST']) !!}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Meno</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="surname">Priezvisko</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="{{old('surname')}}">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
                    </div>
                </div>


                <div class="col-lg-6">
                    <h2><span class="label label-danger">Heslo bude vygenerovane a pride emailom.</span></h2>
                </div>
            </div>


            {!! Form::button('Ulozit',['class'=>'btn btn-success','type'=>'submit','name'=>'save']) !!}
            {!! Form::button('Ulozit a ukoncit',['class'=>'btn btn-primary','type'=>'submit','name'=>'saveExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\AdminsController@index')}}">Zrusit</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection