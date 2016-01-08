@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Komentár</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @include('admin.errors.form')

            {!! Form::open(['action'=>['Admin\CommentsController@store'], 'method'=>'POST']) !!}
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="cont">Obsah komentáru</label>
                        <textarea class="form-control" id="cont" name="cont" tabindex="1" required>{{old('cont')}}
                        </textarea>
                        <span class="register-error-empty"
                              style="display:none">Toto pole musí byť vyplnené!</span>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('article', 'Clanok:', ['class'=>'col-sm-5 control-label']) !!}
                        <div class="col-sm-7">
                            {!! Form::select('article', $articles, 0, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

            </div>


            {!! Form::button('Uložiť',['class'=>'btn btn-success registerSubmit','type'=>'submit','name'=>'save']) !!}
            {!! Form::button('Uložiť a ukončiť',['class'=>'btn btn-primary registerSubmit','type'=>'submit','name'=>'saveExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\CommentsController@index')}}">Zrusiť</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function () {

            $("#cont").keyup(function (e) {
                validateTextarea("cont");
            });

            $("#cont").change(function (e) {
                validateTextarea("cont");
            });

            $(".registerSubmit").click(function (e) {
                if (!validatePage()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });

            function validateTextarea(inputId) {
                var val = $('#' + inputId).val();
                validInput = (val.length != 0);
                if (validInput) {
                    validityShow($('#' + inputId), "");
                } else {
                    validityShow($('#' + inputId), "empty");
                }
                return validInput;
            }

            function validatePage(parent) {
                var validContent = validateTextarea("cont");

                return (validContent);
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