@extends('auth.app_auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="center-block login-block">
                <div class="text-center m-b-md">
                    <h2>Registrujte sa</h2>

                    @include('errors.show_error')
                </div>
                <div class="row animate-panel setEffect" data-effect="fadeInRight" data-child="hpanel">
                    <div class="hpanel login">
                        <div class="panel-body">
                            <form id="loginForm" role="form" method="POST" action="{{ url('auth/register') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label" for="name">Meno</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="surname">Priezvisko</label>
                                    <input type="text" name="surname" class="form-control" id="surname"
                                           value="{{ old('surname') }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input name="email" type="email" class="form-control" id="email"
                                           placeholder="priklad@email.sk"
                                           value="{{ old('email') }}" required>
                                    <span class="message">Email je Vasim prihlasovacim menom</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Heslo</label>
                                    <input name="password" type="password" class="form-control" id="password" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password_confirmation">Heslo znova</label>
                                    <input name="password_confirmation" type="password" class="form-control"
                                           id="password_confirmation">
                                </div>

                                <button class="btn btn-info btn-block" type="submit">Registrovat sa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p><a href="{{action('Auth\AuthController@getLogin')}}"> » späť na stránku prihlasenia</a></p>
            </div>
        </div>
    </div>
@stop