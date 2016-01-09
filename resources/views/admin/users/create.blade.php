@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Užívateľ</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @include('admin.errors.form')

            {!! Form::open(['action'=>['Admin\UsersController@store'], 'method'=>'POST']) !!}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Meno</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" tabindex="1"
                               pattern="^[a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ.]+$"
                               title="Pole môže obsahovať iba písmená" required>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole môže obsahovať iba písmená.</span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="surname">Priezvisko</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="{{old('surname')}}"
                               tabindex="2"
                               pattern="^[a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ.]+$"
                               title="Pole môže obsahovať iba písmená" required>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole môže obsahovať iba písmená.</span>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" tabindex="3"
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                               title="Pole musí obsahovať validnú emailovú adresu"
                               required>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                    Pole musí obsahovať validnú emailovú adresu.</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4><span class="label label-danger">Heslo bude vygenerované a príde novému užívateľovi emailom.</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkbox">
                        <label>
                            {!! Form::hidden('notification', 0) !!}
                            {!! Form::checkbox('notification', 1, old('notification')) !!} <b>Emailová notifikácia</b>
                        </label>
                        <p class="help-block">Pri komentovaní užívateľovho komentáru mu príde email.</p>
                    </div>
                    <div class="checkbox">
                        <label>
                            {!! Form::hidden('admin', 0) !!}
                            {!! Form::checkbox('admin', 1, old('admin')) !!} <b>Administrátor</b>
                        </label>
                    </div>
                </div>
            </div>


            {!! Form::button('Uložiť',['class'=>'btn btn-success registerSubmit','type'=>'submit','name'=>'save']) !!}
            {!! Form::button('Uložiť a ukončiť',['class'=>'btn btn-primary registerSubmit','type'=>'submit','name'=>'saveExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\UsersController@index')}}">Zrušiť</a>
            {!! Form::close() !!}

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

            $(".registerSubmit").click(function (e) {
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
                return (validEmail && validName && validSurname);
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

@endsection