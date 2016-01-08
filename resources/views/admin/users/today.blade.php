@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Uzivatelia
                    <a class="btn btn-success pull-right"
                       href="{{action('Admin\UsersController@create')}}">Vytvorit</a>
                </h1>
            </div>
        </div>

        <h3>Dnes registrovany uzivatelia</h3>
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Meno</th>
                    <th>Priezviko</th>
                    <th>Email</th>
                    <th>Komentare</th>
                    <th>Admin</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($newUsers as $newUser)
                    <tr>
                        <td>{{$newUser->name}}</td>
                        <td>{{$newUser->surname}}</td>
                        <td>{{$newUser->email}}</td>
                        <td>{{count($newUser->comments)}}</td>
                        <td>{{($newUser->admin==1) ? 'Ano' : 'Nie'}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{action('Admin\UsersController@edit',$newUser->id)}}"><span class="glyphicon glyphicon-pencil"></span> Upravit</a>
                            @if($newUser->id != Auth::user()->id)
                                <a class="btn btn-danger deleteUser" user="{{$newUser->name}} {{$newUser->surname}}"
                                   href="{{action('Admin\UsersController@remove',$newUser->id)}}"><span
                                            class="glyphicon glyphicon-remove"></span> Zmazat</a>
                            @else
                                <a class="btn btn-danger deleteUser" user="{{$newUser->name}} {{$newUser->surname}}"
                                   href="{{action('Admin\UsersController@remove',$newUser->id)}}" disabled><span
                                            class="glyphicon glyphicon-remove"></span> Seba zmazat nemozte!</a>
                            @endif
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

        $(document).on('click', '.deleteUser', function (event) {
            event.preventDefault();
            event.stopPropagation();

            var target = $(event.target);

            if (!$(target).hasClass('.btn-danger')) {
                target = $(target).closest('.btn-danger')[0];
            }

            swal({
                        title: "Urcite vymazat?",
                        text: "Skutocne chcete vymazat uzivatela: " + $(target).attr('user') + " ? Ak ma uzivatela zverejnene komentare. Autor tychto komentarov bude neznamy.",
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