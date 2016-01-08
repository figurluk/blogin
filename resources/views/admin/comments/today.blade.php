@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Komentáre
                    <a class="btn btn-success pull-right"
                       href="{{action('Admin\CommentsController@create')}}">Vytvoriť</a>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <h3>Dnes pridané komentáre</h3>
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Autor</th>
                    <th>K článku</th>
                    <th>Obsah komentáru</th>
                    <th>Má podkomentáre</th>
                    <th>Je podkomentárom</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($newComments as $newComment)
                    <tr>
                        <td>{{$newComment->user->name}} {{$newComment->user->surname}}</td>
                        <td>{{$newComment->article->title}}</td>
                        <td>{{(strlen($newComment->content)>20) ? substr($newComment->content,0,20) : $newComment->content}}...</td>
                        <td>{{(count($newComment->comments())!=0) ? 'Áno' : 'Nie'}}</td>
                        <td>{{(count($newComment->belongComments())!=0) ? 'Áno' : 'Nie'}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{action('Admin\CommentsController@edit',$newComment->id)}}"><span class="glyphicon glyphicon-pencil"></span> Upraviť</a>
                            <a class="btn btn-danger deleteComment" article="{{$newComment->article->title}}" href="{{action('Admin\CommentsController@remove',$newComment->id)}}"><span class="glyphicon glyphicon-remove"></span> Zmazať</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $newComments->links() !!}

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
                        title: "Určite vymazať?",
                        text: "Skutočne chcete vymazať komentár k článku: " + $(target).attr('article') + "? Ak komentár obsahuje podkomentáre, tie sa taktiež zmažu!",
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