@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Komentare
                    <a class="btn btn-success pull-right"
                       href="{{action('Admin\CommentsController@create')}}">Vytvorit</a>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Autor</th>
                    <th>K clanku</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->user->name}} {{$comment->user->surname}}</td>
                        <td>{{$comment->articles->title}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{action('Admin\CommentsController@edit',$comment->id)}}"><span class="glyphicon glyphicon-pencil"></span> Upravit</a>
                            <a class="btn btn-danger deleteComment" article="{{$comment->articles->title}}" href="{{action('Admin\CommentsController@remove',$comment->id)}}"><span class="glyphicon glyphicon-remove"></span> Zmazat</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $comments->links() !!}

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">

        $(document).on('click', '.deleteComment', function (event) {
            event.preventDefault();
            event.stopPropagation();

            var target = $(event.target);

            if (!$(target).hasClass('.btn-danger')) {
                target = $(target).closest('.btn-danger')[0];
            }

            swal({
                        title: "Urcite vymazat?",
                        text: "Skutocne chcete vymazat komentar k clanku: " + $(target).attr('article') + " ? ",
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