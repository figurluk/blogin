@extends('blog.layout.app')

@section('content')

    <div class="containerUser container">
        @include('blog.errors.show_error')
        <h3>Vaše údaje</h3>
        <h5>* Povinné údaje</h5>
        <form method="POST" action="{{ action('Blog\UserController@update') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="control-label" for="name">*Meno</label>
                <input type="text" name="name" class="form-control custom-form" id="name"
                       value="{{ $user->name }}" tabindex="1"
                       pattern="^[a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ.]+$"
                       title="Pole môže obsahovať iba písmená." required>
                <span class="glyphicon glyphicon-remove remove-glyph" style="display:none"></span>
                <span class="glyphicon glyphicon-ok ok-glyph" style="display:none"></span>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole môže obsahovať iba písmená.</span>
            </div>

            <div class="form-group">
                <label class="control-label" for="surname">*Priezvisko</label>
                <input type="text" name="surname" class="form-control custom-form" id="surname"
                       value="{{ $user->surname }}" tabindex="2"
                       pattern="^[a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ.]+$"
                       title="Pole môže obsahovať iba písmená." required>
                <span class="glyphicon glyphicon-remove remove-glyph" style="display:none"></span>
                <span class="glyphicon glyphicon-ok ok-glyph" style="display:none"></span>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole môže obsahovať iba písmená.</span>
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        {!! Form::hidden('notification', 0) !!}
                        {!! Form::checkbox('notification', 1, $user->notification) !!} <b>Emailová notifikácia</b>
                    </label>
                    @if($user->admin)
                        <p class="help-block">Pri komentovaní Vášho článku alebo komentáru Vám príde email.</p>
                    @else
                        <p class="help-block">Pri komentovaní Vášho komentáru Vám príde email.</p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label" for="email">*Email</label>
                <input name="email" type="email" class="form-control custom-form" id="email"
                       placeholder="priklad@email.sk" tabindex="3"
                       value="{{ $user->email }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                       title="Pole musí obsahovať validnú emailovú adresu."
                       required>
                <span class="glyphicon glyphicon-remove remove-glyph" style="display:none"></span>
                <span class="glyphicon glyphicon-ok ok-glyph" style="display:none"></span>

                <div class="message">Email je Vasim prihlasovacim menom.</div>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                    Pole musí obsahovať validnú emailovú adresu.</span>
            </div>
            <hr>
            <div class="form-group">
                <label class="control-label" for="password">Heslo</label>
                <input name="password" type="password" class="form-control custom-form" value=""
                       id="password"
                       tabindex="4">
                <span class="help-block">Vyplňte v prípade zadávania nového hesla.</span>
                <span class="glyphicon glyphicon-remove remove-glyph" style="display:none"></span>
                <span class="glyphicon glyphicon-ok ok-glyph" style="display:none"></span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole musí obsahovať minimálne 6 znakov!</span>
            </div>

            <div class="form-group">
                <label class="control-label" for="newpassword">Nové heslo</label>
                <input name="newpassword" type="password" class="form-control custom-form"
                       id="newpassword"
                       tabindex="5">
                <span class="glyphicon glyphicon-remove remove-glyph" style="display:none"></span>
                <span class="glyphicon glyphicon-ok ok-glyph" style="display:none"></span>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole musí obsahovať minimálne 6 znakov!</span>
            </div>

            <div class="form-group">
                <label class="control-label" for="newpassword_confirmation">Nové heslo znova</label>
                <input name="newpassword_confirmation" type="password" class="form-control custom-form"
                       id="newpassword_confirmation" tabindex="6">
            </div>
            <hr>

            <button class="btn btn-danger btn-block" type="submit" id="saveChanges" tabindex="6">
                Ulozit zmeny
            </button>
        </form>
    </div>
@endsection

@section('footer')
    <div class="footer">
        <div class="categories">
            <div class="container-fluid">
                <div class="col-md-12">
                    <span class="pull-right copyrightSign"><i class="fa fa-copyright"></i> Lukas Figura 2016
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
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

            $("#newpassword").keyup(function (e) {
                validatePassword("newpassword");
            });

            $("#newpassword").change(function (e) {
                validatePassword("newpassword");
            });

            $("#saveChanges").click(function (e) {
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
                var validPass = true;
                var validNewPass = true;
                if ($('#newpassword').val() != "") {
                    validPass = validatePassword("password");
                    validNewPass = validatePassword("newpassword");
                }
                return (validEmail && validName && validSurname && validPass && validNewPass);
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

@endsection