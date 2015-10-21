@extends('auth.app_auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="center-block login-block">
                <div class="text-center m-b-md">
                    <h2>Registrujte sa</h2>
                    <h5>Všetky polia sú povinné</h5>

                    @include('errors.show_error')
                </div>
                <div class="row animate-panel setEffect" data-effect="fadeInRight" data-child="hpanel">
                    <div class="hpanel login">
                        <div class="panel-body">
                            <form id="loginForm" role="form" method="POST" action="{{ url('auth/register') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label" for="name">Meno</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           value="{{ old('name') }}" tabindex="1"
                                           pattern="^[a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ.]+$"
                                           title="Pole môže obsahovať iba písmená." required>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole môže obsahovať iba písmená.</span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="surname">Priezvisko</label>
                                    <input type="text" name="surname" class="form-control" id="surname"
                                           value="{{ old('surname') }}" tabindex="2"
                                           pattern="^[a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ.]+$"
                                           title="Pole môže obsahovať iba písmená." required>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole môže obsahovať iba písmená.</span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input name="email" type="email" class="form-control" id="email"
                                           placeholder="priklad@email.sk" tabindex="3"
                                           value="{{ old('email') }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                           title="Pole musí obsahovať validnú emailovú adresu."
                                           required>

                                    <div class="message">Email je Vasim prihlasovacim menom.</div>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                    Pole musí obsahovať validnú emailovú adresu.</span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="password">Heslo</label>
                                    <input name="password" type="password" class="form-control" id="password"
                                           tabindex="4" pattern=".{6,}" title="Pole musí obsahovať minimálne 6 znakov!"
                                           required>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole musí obsahovať minimálne 6 znakov!</span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="password_confirmation">Heslo znova</label>
                                    <input name="password_confirmation" type="password" class="form-control"
                                           id="password_confirmation" tabindex="5" pattern=".{6,}"
                                           title="Pole musí obsahovať minimálne 6 znakov!" required>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole musí obsahovať minimálne 6 znakov!</span>
                                </div>

                                <button class="btn btn-info btn-block" type="submit" id="registerSubmit" tabindex="6">
                                    Registrovat
                                    sa
                                </button>
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

@section('scripts')

    <script>
        $(document).ready(function () {

            $("#email").keyup(function (e) {
                validateEmail();
            });

            $("#email").change(function (e) {
                validateEmail();
            });

            $("#name").keyup(function (e) {
                validateAlphabetInput("name");
            });

            $("#name").change(function (e) {
                validateAlphabetInput("name");
            });

            $("#surname").keyup(function (e) {
                validateAlphabetInput("surname");
            });

            $("#surname").change(function (e) {
                validateAlphabetInput("surname");
            });

            $("#password").keyup(function (e) {
                validatePassword("password");
            });

            $("#password").change(function (e) {
                validatePassword("password");
            });

            $("#password_confirmation").keyup(function (e) {
                validatePassword("password_confirmation");
            });

            $("#password_confirmation").change(function (e) {
                validatePassword("password_confirmation");
            });


            $("#registerSubmit").click(function (e) {
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

            function validatePassword(inputId) {
                var val = $('#' + inputId).val();
                validInput = (val.length != 0);
                if (validInput) {

                    var patt = new RegExp("^[a-záäčďéěíĺľňóôöőŕřšťúüűůýžA-ZÁÄČĎĚÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ.,;0-9´'’()/\"\\- ]{6,}$");
                    var res = val.search(patt);

                    validInput = (res != -1);

                    if (this.validInput) {
                        validityShow($('#' + inputId), "");
                    } else {
                        validityShow($('#' + inputId), "invalid");
                    }
                } else {
                    validityShow($('#' + inputId), "empty");
                }
                return validInput;
            }

            function validateAlphabetInput(inputId) {
                var val = $('#' + inputId).val();
                validInput = (val.length != 0);
                if (validInput) {

                    var patt = new RegExp("^[a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ.]+$");
                    var res = val.search(patt);

                    validInput = (res != -1);

                    if (this.validInput) {
                        validityShow($('#' + inputId), "");
                    } else {
                        validityShow($('#' + inputId), "invalid");
                    }
                } else {
                    validityShow($('#' + inputId), "empty");
                }
                return validInput;
            }

            function validatePage(parent) {
                var validEmail = validateEmail();
                var validName = validateAlphabetInput("name");
                var validSurname = validateAlphabetInput("surname");
                var validPass = validatePassword("password");
                var validPassConf = validatePassword("password_confirmation");

                return (validEmail && validName && validSurname && validPass && validPassConf);
            }

            function validityShow(input, status) {
                var parent = input.parent().closest('div');

                if (status == "empty") {
                    parent.addClass("has-error");
                    parent.removeClass("has-success");
                    parent.find('.register-error-empty').css('display', '');
                    parent.find('.register-error-invalid').css('display', 'none');
                } else if (status == "invalid") {
                    parent.addClass("has-error");
                    parent.removeClass("has-success");
                    parent.find('.register-error-empty').css('display', 'none');
                    parent.find('.register-error-invalid').css('display', '');
                } else {
                    parent.addClass("has-success");
                    parent.removeClass("has-error");
                    parent.find('.register-error-empty').css('display', 'none');
                    parent.find('.register-error-invalid').css('display', 'none');
                }
            }

        });
    </script>
@stop