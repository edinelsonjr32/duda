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
                <li><a href="/admin/index"><i class="fa fa-dashboard"></i> Site</a></li>
                <li class="active"> <i class="fa fa-user"></i>  Destaques</li>
            </ol>
        </section>

        <section class="content">

            @if(session()->exists('message'))
                <div class="alert {{session()->get('class-color')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
                    {{ session()->get('message') }}
                </div>
                <p class="icon-asterisk"></p>

            @endif
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning ">
                                <div class="box-header with-border">
                                    <i class="fa fa-home"></i>

                                    <h3 class="box-title">Imóveis Destaques</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <a type="button" class="btn btn-success col-md-1 col-md-offset-11"  href="{{route('admin.imoveis.destaque.create')}}">
                                        Adicionar
                                    </a>
                                    @if($destaques == '[]')
                                        Nenhum imóvel
                                    @else
                                        <table class="table table-dark">
                                            <tr>
                                                <th style="width: 10%">#</th>
                                                <th>Nome</th>
                                                <th>Titulo</th>
                                                <th style="width: 10%">-</th>
                                            </tr>
                                            @foreach($destaques as $imagem)
                                                <tr>
                                                    <td>{{$imagem->idDestaque}}</td>
                                                    <td>
                                                        <img src="{{ URL::to('/') }}/imovel/images/{{ $imagem->path }}" class="img-thumbnail" width="90"/>
                                                    </td>
                                                    <td>{{$imagem->titulo}}</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <a type="button" href="{{route('admin.imoveis.imagem.principal.delete', ['id' => $imagem->idDestaque])}}" class="btn btn-block btn-danger"><span class="fa fa-trash"></span></a>
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

                        </div>

                    </div>
                </div>
        </section>
    </div>
    <!-- /.content-wrapper -->



@endsection

@section('script')

@endsection
