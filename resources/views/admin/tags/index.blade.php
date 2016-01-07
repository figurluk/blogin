@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <h1 class="page-header">
                    Tagy
                    <a class="btn btn-success pull-right"
                       href="{{action('Admin\TagsController@create')}}">Vytvorit</a>
                </h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Nazov</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{$tag->name}}</td>
                        <td>
                            <a class="btn btn-warning"
                               href="{{action('Admin\TagsController@edit',$tag->id)}}"><span
                                        class="glyphicon glyphicon-pencil"></span> Upravit</a>
                            <a class="btn btn-danger deleteTag" tag="{{$tag->name}}"
                               href="{{action('Admin\TagsController@remove',$tag->id)}}"><span
                                        class="glyphicon glyphicon-remove"></span> Zmazat</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">

        $(document).on('click', '.deleteTag', function (event) {
            event.preventDefault();
            event.stopPropagation();

            var target = $(event.target);

            if (!$(target).hasClass('.btn-danger')) {
                target = $(target).closest('.btn-danger')[0];
            }

            swal({
                        title: "Urcite vymazat?",
                        text: "Skutocne chcete vymazat tag: " + $(target).attr('tag') + " ? ",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Zrusit",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ano zmazat!",
                        closeOnConfirm: false
                    },
                    function () {
                        window.location.href = $(target).attr('href');
                        swal.close();
                    }
            )
        });

    </script>

@endsection