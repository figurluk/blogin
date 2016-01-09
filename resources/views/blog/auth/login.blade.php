@extends('blog.layout.app_auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="center-block login-block">
                <div class="text-center m-b-md">
                    <h2>Prihlásenie</h2>

                    @include('blog.errors.show_error')
                </div>
                <div class="row animate-panel setEffect" data-effect="fadeInRight" data-child="hpanel">
                    <div class="hpanel login">
                        <div class="panel-body">
                            <form id="loginForm" role="form" method="POST" action="{{ url('auth/login') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label" for="username">Email</label>
                                    <input name="email" type="email" class="form-control custom-form" id="email"
                                           placeholder="priklad@email.sk" tabindex="1"
                                           value="{{ old('email') }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                           title="Pole musí obsahovať validnú emailovú adresu."
                                           required>
                                    <span class="glyphicon glyphicon-remove remove-glyph" style="display:none"></span>
                                    <span class="glyphicon glyphicon-ok ok-glyph" style="display:none"></span>
                                    <span class="help-block small">Prihlasovacie meno je Váš email zadaný pri registrácii</span>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                    Pole musí obsahovať validnú emailovú adresu.</span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="password">Heslo</label>
                                    <input name="password" type="password" class="form-control custom-form"
                                           id="password"
                                           tabindex="2" pattern=".{6,}" title="Pole musí obsahovať minimálne 6 znakov!"
                                           required>
                                    <span class="glyphicon glyphicon-remove remove-glyph" style="display:none"></span>
                                    <span class="glyphicon glyphicon-ok ok-glyph" style="display:none"></span>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole musí obsahovať minimálne 6 znakov!</span>
                                </div>

                                <button class="btn btn-info btn-block" type="submit" tabindex="4" id="loginSubmit">
                                    Prihlásiť sa
                                </button>
                                <a class="btn btn-default btn-block"
                                   href="{{action('Blog\Auth\AuthController@getRegister')}}" tabindex="5">Registrácia</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center dark-back-link-div">
                <a href="{{action('Blog\HomeController@index')}}" tabindex="6"> » späť na domovskú stránku</a>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {

            $("#email").keyup(function (e) {
                validateEmail();
            });

            $("#email").change(function (e) {
                validateEmail();
            });

            $("#loginSubmit").click(function (e) {
                if (!validatePage()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });

            function validateEmail() {
                var val = $('#email').val();
                validEmail = (val.length != 0);
                if (validEmail) {
                    var re = /\S+@\S+\.\S+/;
                    validEmail = re.test(val);

                    if (validEmail) {
                        validityShow($('#email'), "");
                    } else {
                        validityShow($('#email'), "invalid");
                    }
                } else {
                    validityShow($('#email'), "empty");
                }
                return validEmail;
            }

            function validatePage(parent) {
                var validEmail = validateEmail();

                return (validEmail);
            }

            function validityShow(input, status) {
                var parent = input.parent().closest('div');

                if (status == "empty") {
                    parent.addClass("has-error");
                    parent.removeClass("has-success");
                    parent.find('.register-error-empty').css('display', '');
                    parent.find('.remove-glyph').css('display', '');
                    parent.find('.ok-glyph').css('display', 'none');
                    parent.find('.register-error-invalid').css('display', 'none');
                } else if (status == "invalid") {
                    parent.addClass("has-error");
                    parent.removeClass("has-success");
                    parent.find('.register-error-empty').css('display', 'none');
                    parent.find('.register-error-invalid').css('display', '');
                    parent.find('.remove-glyph').css('display', '');
                    parent.find('.ok-glyph').css('display', 'none');
                } else {
                    parent.addClass("has-success");
                    parent.removeClass("has-error");
                    parent.find('.register-error-empty').css('display', 'none');
                    parent.find('.register-error-invalid').css('display', 'none');
                    parent.find('.remove-glyph').css('display', 'none');
                    parent.find('.ok-glyph').css('display', '');
                }
            }
        });
    </script>
@stop