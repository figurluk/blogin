@extends('admin.layouts.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row col-lg-8 col-lg-offset-2">

            <h2>Nastavenia blogu</h2>
            <hr>

            {!! Form::open(['action'=>['Admin\SettingsController@update'], 'method'=>'POST']) !!}

            <div class="radio col-lg-6">
                <h4>Design blogu</h4>
                <div>
                    <label>
                        <input type="radio" name="design" id="optionsRadios1" class="changeDesign"
                               value="1" {{($settings->design==1) ? 'checked' : ''}}>
                        Cerveny
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="design" id="optionsRadios2" class="changeDesign"
                               value="2" {{($settings->design==2) ? 'checked' : ''}}>
                        Zelenkavy
                    </label>
                </div>
                <hr>
                {!! Form::submit('Ulozit',['class'=>'form-control btn-success']) !!}
            </div>

            <div class="radio col-lg-6">
                <h5>Nahlad</h5>

                <a href="{{asset('img/design1.png')}}" target="_blank" class="col-lg-12" id="design1" {{($settings->design!=1) ? 'style=display:none' : ''}}>
                    <img class="col-lg-12"  src="{{asset('img/design1.png')}}" alt="Design blogu">
                </a>
                <a href="{{asset('img/design1.png')}}" target="_blank" class="col-lg-12" id="design2" {{($settings->design!=2) ? 'style=display:none' : ''}}>
                    <img class="col-lg-12"  src="{{asset('img/design2.png')}}" alt="Design blogu">
                </a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>


    <!-- Creates the bootstrap modal where the image will appear -->
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Image preview</h4>
                </div>
                <div class="modal-body">
                    <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')


    <script type="text/javascript">

        $(document).ready(function (event) {
            $('.changeDesign').click(function (event) {
                var target = $(event.target);
                if (target.val() == 1) {
                    $('#design2').hide();
                    $('#design1').fadeIn();
                }
                else {
                    $('#design1').hide();
                    $('#design2').fadeIn();
                }
            });

            $("#pop").on("click", function() {
                $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
                $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
            });
        });

    </script>
@endsection