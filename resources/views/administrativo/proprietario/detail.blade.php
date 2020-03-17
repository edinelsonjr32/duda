@section('estilo')
    <link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">
@endsection
@extends('administrativo.layout')


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

                            <h3 class="profile-username text-center">{{$proprietario->nome}}</h3>

                            <p class="text-muted text-center">Proprietário</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Email:</b> <a class="pull-right">{{$proprietario->email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Telefone</b> <a class="pull-right">{{$proprietario->telefone}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Data Nascimento</b> <a class="pull-right">{{$proprietario->data_nascimento}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>CPF/CNPJ</b> <a class="pull-right">{{$proprietario->cpf}}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>CEP</b> <a class="pull-right">{{$proprietario->cep}},  N {{$proprietario->cep}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Rua</b> <a class="pull-right">{{$proprietario->rua}},  N {{$proprietario->numero_casa}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Bairro</b> <a class="pull-right">{{$proprietario->bairro}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Cidade</b> <a class="pull-right">{{$proprietario->cidade}}/ {{$proprietario->estado}}</a>
                                </li>
                            </ul>

                            <br>

                            <h3 class="profile-username text-center">Imóveis Para Alugar</h3>
                            <table class="table table-dark">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Titulo</th>
                                    <th style="width: 40px">-</th>
                                </tr>
                                @foreach($imoveisAluguel as $imovel)
                                    <tr>
                                        <td>{{$imovel->id}}</td>
                                        <td>{{$imovel->titulo}}</td>
                                        <td>
                                            @if($imovel->aluguel == 1)

                                                <a class=" btn btn-block btn-success" href="{{route('admin.imoveis.aluguel.detail', $imovel->id)}}"><span class="fa fa-eye"></span></a>

                                            @elseif($imovel->venda == 1)
                                                <a class=" btn btn-block btn-success" href="{{route('admin.imoveis.venda.detail', $imovel->id)}}"><span class="fa fa-eye"></span></a>

                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>



                            <h3 class="profile-username text-center">Imóveis Para Venda</h3>
                            @if($imoveisVenda == '[]')
                                Sem dados
                            @elseif($imoveisVenda !== '[]')
                                <table class="table table-dark">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Titulo</th>
                                        <th style="width: 40px">-</th>
                                    </tr>
                                    @foreach($imoveisVenda as $imovel)
                                        <tr>
                                            <td>{{$imovel->id}}</td>
                                            <td>{{$imovel->titulo}}</td>
                                            <td>
                                                @if($imovel->aluguel == 1)

                                                    <a class=" btn btn-block btn-success" href="{{route('admin.imoveis.aluguel.detail', $imovel->id)}}"><span class="fa fa-eye"></span></a>

                                                @elseif($imovel->venda == 1)
                                                    <a class=" btn btn-block btn-success" href="{{route('admin.imoveis.venda.detail', $imovel->id)}}"><span class="fa fa-eye"></span></a>

                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="box box-warning ">
                        <div class="box-header with-border">
                            <i class="fa fa-file-archive-o"></i>

                            <h3 class="box-title">Documentos</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{route('administrativo.proprietario.documento.store')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="proprietario_id" value="{{$proprietario->id}}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nome Documento</label>
                                        <input required type="text" class="form-control" name="nome">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Inserir Documento</label>
                                        <input required type="file" class="form-control" name="images[]" multiple>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="box-footer">
                                        <button  type="submit" class="btn btn-primary col-md-10">Enviar</button>
                                    </div>
                                </div>
                            </form>
                            @if($documentos == '[]')

                            @elseif($documentos !== '[]')
                             <table class="table table-dark">
                            <tr>
                                <th style="width: 10%">#</th>
                                <th>Nome</th>
                                <th style="width: 10%">-</th>
                            </tr>
                            @foreach($documentos as $dado)
                                <tr>
                                    <td>{{$dado->id}}</td>
                                    <td>
                                        {{$dado->nome}}
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a type="button" href="{{route('administrativo.proprietario.documento.download', ['id' => $dado->id])}}" class="btn btn-block btn-success"><span class="fa fa-download"></span></a>
                                            </div>
                                            <div class="col-md-6">
                                                <a type="button" href="{{route('administrativo.proprietario.documento.delete', ['id' => $dado->id])}}" class="btn btn-block btn-danger"><span class="fa fa-trash"></span></a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                            @endif

                        </div>
                        <!-- /.box-body -->
                    </div>


                    <!-- /.box -->
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
