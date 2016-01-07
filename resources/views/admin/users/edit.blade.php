@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Uzivatel</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @include('admin.errors.form')

            {!! Form::open(['action'=>['Admin\AdminsController@update',$user->id], 'method'=>'POST']) !!}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Meno</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="surname">Priezvisko</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="checkbox">
                        <label>
                            {!! Form::hidden('admin', 0) !!}
                            {!! Form::checkbox('admin', 1, $user->admin) !!} <b>Administrator</b>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            {!! Form::hidden('password', 0) !!}
                            {!! Form::checkbox('password', 1, null) !!} <b>Poslat nove heslo</b>
                        </label>
                    </div>
                </div>
            </div>

            {!! Form::button('Ulozit',['class'=>'btn btn-success','type'=>'submit','name'=>'update']) !!}
            {!! Form::button('Ulozit a ukoncit',['class'=>'btn btn-primary','type'=>'submit','name'=>'updateExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\AdminsController@index')}}">Zrusit</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection