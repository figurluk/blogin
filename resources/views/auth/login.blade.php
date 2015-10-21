@extends('auth.app_auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="center-block login-block">
                <div class="text-center m-b-md">
                    <h2>Prihlasit sa</h2>

                    @include('errors.show_error')
                </div>
                <div class="row animate-panel setEffect" data-effect="fadeInRight" data-child="hpanel">
                    <div class="hpanel login">
                        <div class="panel-body">
                            <form id="loginForm" role="form" method="POST" action="{{ url('auth/login') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label" for="username">Email</label>
                                    <input name="email" type="email" class="form-control" id="email"
                                           placeholder="priklad@email.sk" tabindex="1"
                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                           required value="{{ old('email') }}">
                                    <span class="help-block small">Prihlasovacie meno je Váš email zadaný pri registrácii</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Password</label>
                                    <input name="password" type="password" class="form-control" id="password"
                                           tabindex="2" required>
                                </div>
                                <div class="text-center">
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="remember-me" class="i-checks">
                                            Pamätaj si ma
                                        </label>
                                    </div>
                                </div>
                                <button class="btn btn-info btn-block" type="submit" tabindex="3">Prihlásiť sa</button>
                                <a class="btn btn-default btn-block"
                                   href="{{action('Auth\AuthController@getRegister')}}">Register</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p><a href="{{action('HomeController@index')}}"> » späť na domovskú stránku</a></p>
            </div>
        </div>
    </div>
@stop