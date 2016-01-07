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

            {!! Form::open(['action'=>['Admin\AdminsController@update',$admin->id], 'method'=>'POST']) !!}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Meno</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$admin->name}}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="surname">Priezvisko</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="{{$admin->surname}}">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$admin->email}}">
                    </div>
                </div>

                @if($admin->id == Auth::user()->id)
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password">Nove heslo</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Nove heslo znova</label>
                            <input type="text" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                @endif
            </div>


            {!! Form::button('Ulozit',['class'=>'btn btn-success','type'=>'submit','name'=>'update']) !!}
            {!! Form::button('Ulozit a ukoncit',['class'=>'btn btn-primary','type'=>'submit','name'=>'updateExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\AdminsController@index')}}">Zrusit</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection