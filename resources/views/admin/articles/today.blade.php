@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Články</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <h3>Dnes pridané články</h3>
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Názov</th>
                    <th>Autor</th>
                    <th>Tagy</th>
                    <th>Počet likov</th>
                    <th>Topovaný</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($newArticles as $newArticle)
                    <tr>
                        <td>{{$newArticle->title}}</td>
                        <td>{{$newArticle->user->name}} {{$newArticle->user->surname}}</td>
                        <td>
                            @foreach($newArticle->tags as $tag)
                                <span class="label label-success">{{$tag->name}}</span>
                            @endforeach
                        </td>
                        <td>{{$newArticle->likes}}</td>
                        <td>{{($newArticle->topped) ? 'Áno':'Nie'}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{action('Admin\ArticlesController@edit',$newArticle->id)}}"><span class="glyphicon glyphicon-pencil"></span> Upraviť</a>
                            <a class="btn btn-danger deleteArticle" data-article="{{$newArticle->title}}" href="{{action('Admin\ArticlesController@remove',$newArticle->id)}}"><span class="glyphicon glyphicon-remove"></span> Zmazať</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $newArticles->links() !!}

    </div>

@endsection


@section('scripts')

    <script type="text/javascript">

        $(document).on('click', '.deleteArticle', function (event) {
            event.preventDefault();
            event.stopPropagation();

            var target = $(event.target);

            if (!$(target).hasClass('.btn-danger')) {
                target = $(target).closest('.btn-danger')[0];
            }

            swal({
                        title: "Určite vymazať?",
                        text: "Skutočne chcete vymazať článok: " + $(target).attr('data-article') + " ? ",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Zrušiť",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Áno zmazať!",
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