@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Clanok</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @include('admin.errors.form')

            {!! Form::open(['action'=>['Admin\ArticlesController@update',$article->id], 'method'=>'POST', 'files'=>true]) !!}
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Nazov clanku</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$article->title}}"
                               tabindex="1"
                               pattern="^[0-9a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ .]+$"
                               title="Pole môže obsahovať iba písmená, cislice a medzery" required>
                                    <span class="register-error-empty"
                                          style="display:none">Toto pole musí byť vyplnené!</span>
                                    <span class="register-error-invalid" style="display:none">Toto pole nie je vyplnené správne!
                                        Pole môže obsahovať iba písmená, cislice a medzery.</span>
                    </div>

                    <div class="form-group">
                        <label for="cont">Obsah clanku</label>
                        {!! Form::textarea('cont',$article->content,['class'=>'form-control','tabindex'=>'2','required','id'=>'cont']) !!}
                        <span class="register-error-empty"
                              style="display:none">Toto pole musí byť vyplnené!</span>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                        <label>
                            {!! Form::hidden('topped', 0) !!}
                            {!! Form::checkbox('topped', 1, $article->topped) !!} <b>Topovanie clanku</b>
                        </label>
                    </div>

                    <div class="form-group">
                        {!! Form::label('tags', 'Tagy:', ['class'=>'col-sm-5 control-label']) !!}
                        <div class="col-sm-7">
                            {!! Form::select('tags[]', $tags, $article->tags_id(), ['class'=>'form-control', 'multiple']) !!}
                        </div>
                    </div>

                    <div>
                        <img class="articleImage" src="{{action('Blog\ArticlesController@getImage',$article->code)}}"
                             alt="{{$article->image}}">
                    </div>
                    @if($article->image=='default.png')
                        <span class="label label-warning">Momentalne je clanku prideleny predvoleny obrazok.</span>
                    @endif
                    <div class="form-group">
                        <label for="image">Obrazok clanku</label>
                        {!! Form::file('image') !!}
                    </div>
                </div>
            </div>


            {!! Form::button('Ulozit',['class'=>'btn btn-success','type'=>'submit','name'=>'update']) !!}
            {!! Form::button('Ulozit a ukoncit',['class'=>'btn btn-primary','type'=>'submit','name'=>'updateExit']) !!}
            <a class="btn btn-danger" href="{{action('Admin\ArticlesController@index')}}">Zrusit</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function () {

            $("#title").keyup(function (e) {
                validateAlphabetInput("title");
            });

            $("#title").change(function (e) {
                validateAlphabetInput("title");
            });

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

            function validateAlphabetInput(inputId) {
                var val = $('#' + inputId).val();
                validInput = (val.length != 0);
                if (validInput) {

                    var patt = new RegExp("^[a-záäčďéíĺľňóôöőŕřšťúüűýžA-ZÁÄČĎÉÍĹĽŇÓÔÖŐŘŔŠŤÚÜŰÝŽ .]+$");
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
                var validTitle = validateAlphabetInput("title");
                var validContent = validateTextarea("cont");

                return (validTitle && validContent);
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