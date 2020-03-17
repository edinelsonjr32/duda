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
                <li class="active"> <i class="fa fa-user"></i>  Banners</li>
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
                                <button type="button" class="btn btn-success col-md-1 col-md-offset-11" data-toggle="modal" data-target="#modal-default">
                                    Adicionar
                                </button>

                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Novo Banner</h4>
                                            </div>
                                            <form method="POST" action="{{ route('site.banner.save') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('titulo') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}"  autocomplete="titulo" autofocus>

                                                            @error('titulo')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="subtitulo" class="col-md-4 col-form-label text-md-right">{{ __('Sub Título') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="subtitulo" type="text" class="form-control @error('subtitulo') is-invalid @enderror" name="subtitulo" value="{{ old('subtitulo') }}"  autocomplete="subtitulo" autofocus>

                                                            @error('subtitulo')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="descricao" type="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{ old('descricao') }}"  autocomplete="descricao">

                                                            @error('descricao')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Imagem') }}</label>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Multiple File Select</label>
                                                                <input required type="file" class="form-control" name="images[]" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                @if($banner == '[]')
                                    Nenhum Banner
                                @else
                                    <table class="table table-dark">
                                        <tr>
                                            <th style="width: 10%">#</th>
                                            <th>Imagem</th>
                                            <th>Título</th>
                                            <th>Sub-Título</th>
                                            <th>Descrição</th>
                                            <th style="width: 10%">-</th>
                                        </tr>
                                        @foreach($banner as $dados)
                                            <tr>
                                                <td>{{$dados->id}}</td>
                                                <td>
                                                    <img src="{{ URL::to('/') }}/imovel/images/banner/{{ $dados->path }}" class="img-thumbnail" width="90"/>
                                                </td>
                                                <td>{{$dados->titulo}}</td>
                                                <td>{{$dados->subtitulo}}</td>
                                                <td>{{$dados->descricao}}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <a type="button" href="{{route('site.destroy', ['id' => $dados->id])}}" class="btn btn-block btn-danger"><span class="fa fa-trash"></span></a>
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
