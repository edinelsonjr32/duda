@section('estilo')
    <link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">
@endsection
@extends('admin.layout')


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin/index"><i class="fa fa-dashboard"></i> Administrador</a></li>
                <li><a href="/admin/proprietario/index"><i class="fa fa-user-secret"></i> Proprietário</a></li>
                <li class="active"> <i class="fa fa-user"></i>  Detalhe</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="/admin/dist/img/proprietario.png" alt="User profile picture">

                            @foreach($dados as $dado)
                                <h3 class="profile-username text-center">{{$dado->nome}}</h3>

                                <p class="text-muted text-center">Corretor</p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Imóvel</b> <a href="{{route('visita.show', $dado->id)}}" class="pull-right">{{$dado->titulo}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Rua:</b> <a class="pull-right">{{$dado->endereco}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Imóvel</b> <a class="pull-right">{{$dado->numero}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Bairro</b> <a class="pull-right">{{$dado->bairro}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Cidade</b> <a class="pull-right">{{$dado->cidade}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>CEP</b> <a class="pull-right">{{$dado->cep}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Data:</b> <a class="pull-right">{{date('d/m/Y', strtotime($dado->data))}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Hora</b> <a class="pull-right">{{$dado->hora}}</a>
                                    </li>
                                    @endforeach
                                    @foreach($dados2 as $dado)
                                        <li class="list-group-item">
                                            <b>Cadastrado Por: </b> <a class="pull-right">{{$dado->nomeUser}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
    <!-- /.content-wrapper -->



@endsection

@section('script')


@endsection
