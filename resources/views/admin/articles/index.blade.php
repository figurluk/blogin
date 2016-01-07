@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <h1 class="page-header">
                    Clanky
                    <a class="btn btn-success pull-right"
                       href="{{action('Admin\ArticlesController@create')}}">Vytvorit</a>
                </h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Nazov</th>
                    <th>Autor</th>
                    <th>Tagy</th>
                    <th>Topovany</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->title}}</td>
                        <td>{{$article->user->name}} {{$article->user->surname}}</td>
                        <td>
                            @foreach($article->tags as $tag)
                                <span class="label label-success">{{$tag->name}}</span>
                            @endforeach
                        </td>
                        <td>{{($article->topped) ? 'Ano':'Nie'}}</td>
                        <td>
                            <a class="btn btn-warning"
                               href="{{action('Admin\ArticlesController@edit',$article->id)}}"><span
                                        class="glyphicon glyphicon-pencil"></span> Upravit</a>
                            <a class="btn btn-danger deleteArticle" article="{{$article->title}}"
                               href="{{action('Admin\ArticlesController@remove',$article->id)}}"><span
                                        class="glyphicon glyphicon-remove"></span> Zmazat</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $articles->links() !!}

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
                        title: "Urcite vymazat?",
                        text: "Skutocne chcete vymazat clanok: " + $(target).attr('article') + " ? ",
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