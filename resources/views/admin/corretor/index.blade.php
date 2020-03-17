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
                <li class="active"> <i class="fa fa-user"></i> Corretores</li>
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

                                <h3 class="box-title">Coretores Cadastrados</h3>
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
                                                <h4 class="modal-title">Novo Corretor</h4>
                                            </div>
                                            <form method="POST" action="{{ route('corretor.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}"  autocomplete="Nome" autofocus>

                                                            @error('nome')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Código') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}"  autocomplete="codigo" autofocus>

                                                            @error('codigo')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="telefone" type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}"  autocomplete="telefone">

                                                            @error('telefone')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="path" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input required type="file" class="form-control" name="path[]" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                @if($corretores == '[]')
                                    Nenhum Corretor
                                @else
                                    <table class="table table-dark">
                                        <tr>
                                            <th style="width: 10%">#</th>
                                            <th>Nome</th>
                                            <th>Código</th>
                                            <th>Telefone</th>
                                            <th style="width: 10%">-</th>
                                        </tr>
                                        @foreach($corretores as $dados)
                                            <tr>
                                                <td>
                                                    <img src="{{ URL::to('/') }}/imovel/images/corretor/{{ $dados->path }}" class="img-thumbnail" width="90"/>
                                                </td>
                                                <td>{{$dados->nome}}</td>
                                                <td>{{$dados->codigo}}</td>
                                                <td>{{$dados->telefone}}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a type="button" href="{{route('admin.corretor.edit', ['id' => $dados->id])}}" class="btn btn-block btn-default"><span class="fa fa-pencil"></span></a>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <a type="button" href="{{route('admin.corretor.destroy', ['id' => $dados->id])}}" class="btn btn-block btn-danger"><span class="fa fa-trash"></span></a>

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

    <!-- Adicionando Javascript -->
    <script type="text/javascript">
        /* Máscaras ER */
        function mascara(o,f){
            v_obj=o
            v_fun=f
            setTimeout("execmascara()",1)
        }
        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }
        function mtel(v){
            v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
            v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
            v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }
        function id( el ){
            return document.getElementById( el );
        }
        window.onload = function(){
            id('telefone').onkeyup = function(){
                mascara( this, mtel );
            }
        }
    </script>
@endsection
