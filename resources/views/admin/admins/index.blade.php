@extends('admin.layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administratori
                    <a class="btn btn-success pull-right"
                       href="{{action('Admin\AdminsController@create')}}">Vytvorit</a>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Meno</th>
                    <th>Priezviko</th>
                    <th>Email</th>
                    <th>Pocet clankov</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->surname}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{count($admin->articles)}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{action('Admin\AdminsController@edit',$admin->id)}}"><span
                                        class="glyphicon glyphicon-pencil"></span> Upravit</a>
                            @if($admin->id != Auth::user()->id)
                                <a class="btn btn-danger deleteAdmin" admin="{{$admin->name}} {{$admin->surname}}"
                                   href="{{action('Admin\AdminsController@remove',$admin->id)}}"><span
                                            class="glyphicon glyphicon-remove"></span> Zmazat</a>
                            @else
                                <a class="btn btn-danger deleteAdmin" admin="{{$admin->name}} {{$admin->surname}}"
                                    href="{{action('Admin\AdminsController@remove',$admin->id)}}" disabled><span
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

        $(document).on('click', '.deleteAdmin', function (event) {
            event.preventDefault();
            event.stopPropagation();

            var target = $(event.target);

            if (!$(target).hasClass('.btn-danger')) {
                target = $(target).closest('.btn-danger')[0];
            }

            swal({
                        title: "Urcite vymazat?",
                        text: "Skutocne chcete vymazat admina: " + $(target).attr('admin') + " ? Ak ma admin zverejnene clanky. Autor tychto clankov bude neznamy.",
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