@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Užívatelia
                    <a class="btn btn-success pull-right"
                       href="{{action('Admin\UsersController@create')}}">Vytvoriť</a></h1>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Meno</th>
                    <th>Priezviko</th>
                    <th>Email</th>
                    <th>Komentáre</th>
                    <th>Admin</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->surname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{count($user->comments)}}</td>
                        <td>{{($user->admin==1) ? 'Ano' : 'Nie'}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{action('Admin\UsersController@edit',$user->id)}}"><span
                                        class="glyphicon glyphicon-pencil"></span> Upraviť</a>
                            @if($user->id != Auth::user()->id)
                                <a class="btn btn-danger deleteUser" data-user="{{$user->name}} {{$user->surname}}"
                                   href="{{action('Admin\UsersController@remove',$user->id)}}"><span
                                            class="glyphicon glyphicon-remove"></span> Zmazať</a>
                            @else
                                <a class="btn btn-danger deleteUser" data-user="{{$user->name}} {{$user->surname}}"
                                   href="{{action('Admin\UsersController@remove',$user->id)}}" disabled><span
                                            class="glyphicon glyphicon-remove"></span> Seba zmazať nemôžte!</a>
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
                        title: "Určite vymazať?",
                        text: "Skutočne chcete vymazať užívateľa: " + $(target).attr('data-user') + " ? Ak má užívateľ zverejnené komentáre. Autor týchto komentárov bude neznámy.",
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