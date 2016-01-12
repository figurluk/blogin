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
                        Červený
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="design" id="optionsRadios2" class="changeDesign"
                               value="2" {{($settings->design==2) ? 'checked' : ''}}>
                        Zelený
                    </label>
                </div>
                <hr>
                {!! Form::submit('Uložiť',['class'=>'form-control btn-success']) !!}
            </div>

            <div class="radio col-lg-6">
                <h5>Náhľad</h5>

                <img class="col-lg-12" src="{{asset('public/img/design1.png')}}" alt="Design blogu"
                     id="design1" {{($settings->design!=1) ? 'style=display:none' : ''}}>
                <img class="col-lg-12" src="{{asset('public/img/design2.png')}}" alt="Design blogu"
                     id="design2" {{($settings->design!=2) ? 'style=display:none' : ''}}>
            </div>
            {!! Form::close() !!}
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
        });

    </script>
@endsection