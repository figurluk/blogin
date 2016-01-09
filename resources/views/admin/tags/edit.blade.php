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

            <h5>* Povinné údaje</h5>
            {!! Form::open(['action'=>['Admin\TagsController@update',$tag->id], 'method'=>'POST']) !!}
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="name">*Názov tagu</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$tag->name}}" tabindex="1"
                               pattern="^[0-9a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ.]+$"
                               title="Pole môže obsahovať iba písmená a cislice" required>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole môže obsahovať iba písmená a cislice.</span>
                    </div>
                </div>

            </div>


            {!! Form::button('Uložiť',['class'=>'btn btn-success registerSubmit','type'=>'submit','name'=>'update']) !!}
            {!! Form::button('Uložiť a ukončiť',['class'=>'btn btn-primary registerSubmit','type'=>'submit','name'=>'updateExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\TagsController@index')}}">Zrušiť</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function () {

            $("#name").keyup(function (e) {
                validateAlphabetInput("name");
            });

            $("#name").change(function (e) {
                validateAlphabetInput("name");
            });

            $(".registerSubmit").click(function (e) {
                if (!validatePage()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });

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
                var validTitle = validateAlphabetInput("name");

                return (validTitle);
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