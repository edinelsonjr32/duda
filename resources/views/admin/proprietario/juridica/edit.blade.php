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
        <li class="active"> <i class="fa fa-user"></i>  Proprietário</li>
      </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                    <form method="POST" action="{{ route('admin.proprietario.juridico.update', ['proprietario'=> $dadosProprietario->id]) }}">
                        @csrf
                        @method('PUT')
                    <input type="hidden" name="tipo_proprietario_id" value="2">

                    <!--Inicio Dados empressa-->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados Empresa</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label>Nome Empresa</label>
                                <input type="text" value="{{ old('nome_empresa') ?? $dadosProprietario->nome_empresa}} "class="form-control" placeholder="Nome" name="nome_empresa">
                                @error('nome_empresa')
                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nome Fantasia</label>
                                <input type="text" value="{{ old('nome_fantasia') ?? $dadosProprietario->nome_fantasia}}" class="form-control" placeholder="Nome Fantasia" name="nome_fantasia">
                                @error('nome_fantasia')
                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>CNPJ</label>
                                <input type="text" value="{{ old('cnpj') ?? $dadosProprietario->cnpj}}" class="form-control" placeholder="CNPJ" name="cnpj">
                                @error('cnpj')
                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <input type="text" value="{{ old('email') ?? $dadosProprietario->email}}" class="form-control" placeholder="Email" name="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contrato Social</label>
                                <input type="text" value="{{ old('contrato_social') ?? $dadosProprietario->contrato_social}}" class="form-control" placeholder="Contrato Social" name="contrato_social">
                                @error('contrato_social')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <!--Fim Dados empressa-->

                    <!--Inicio Endereço empressa-->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Endereço</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group col-md-2">
                                <label>CEP</label>
                                <input id="cep" type="text" value="{{ old('cep') ?? $dadosProprietario->cep}}" class="form-control" placeholder="CEP" name="cep">
                                @error('cep')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-8">
                                <label>Rua</label>
                                <input id="rua" type="text" value="{{ old('rua') ?? $dadosProprietario->rua}}" class="form-control" placeholder="Nome Fantasia" name="rua">
                                @error('rua')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label>Número</label>
                                <input type="text" class="form-control" value="{{ old('numero_casa') ?? $dadosProprietario->numero_casa}}" placeholder="Número" name="numero_casa">
                                @error('numero_casa')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Bairro</label>
                                <input id="bairro" type="text" class="form-control" value="{{ old('bairro') ?? $dadosProprietario->bairro}}" placeholder="Bairro" name="bairro">
                                @error('bairro')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Cidade</label>
                                <input id="cidade" type="text" class="form-control" value="{{ old('cidade') ?? $dadosProprietario->cidade}}" placeholder="Cidade" name="cidade">
                                @error('cidade')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Estado</label>
                                <input id="uf" type="text" class="form-control" value="{{ old('estado') ?? $dadosProprietario->estado}}" placeholder="Estado" name="estado">
                                @error('estado')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <!--Fim Endereço empressa-->

                    <!--Inicio Dados Bancários empressa-->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados Bancários</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group col-md-4">
                                <label>Tipo Conta</label>
                                <select class="form-control" name="tipo_conta">
                                    <option value="1" {{ (old('tipo_conta') == 1 ? 'selected' : ($dadosProprietario->tipo_conta  == 1 ? 'selected' : '')) }}>Corrente</option>
                                    <option value="2" {{ (old('tipo_conta') == 2 ? 'selected' : ($dadosProprietario->tipo_conta  == 2 ? 'selected' : '')) }}>Poupança</option>
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label>Nome Banco</label>
                                <input  type="text" class="form-control" value="{{ old('banco') ?? $dadosProprietario->banco}}" placeholder="Banco" name="banco">
                                @error('banco')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Número Agência</label>
                                <input type="text" class="form-control" value="{{ old('agencia') ?? $dadosProprietario->agencia}}" placeholder="Agência" name="agencia">
                                @error('agencia')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Número Conta</label>
                                <input type="text" class="form-control" value="{{ old('conta') ?? $dadosProprietario->conta}}" placeholder="Conta" name="conta">
                                @error('conta')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Variação/Operação</label>
                                <input  type="text" class="form-control" value="{{ old('variacao_poupanca') ?? $dadosProprietario->variacao_poupanca}}"  placeholder="Variação/Operação" name="variacao_poupanca">
                                @error('variacao_poupanca')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <!--Fim Dados Bancários empressa-->

                    <!--Inicio Dados Bancários empressa-->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados Sócio/Proprietário</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group col-md-3">
                                <label>Nome</label>
                                <input  type="text" class="form-control"  value="{{ old('nome') ?? $dadosProprietario->nome}}" placeholder="Nome" name="nome">
                                @error('nome')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label>Data Nascimento</label>
                                <input  type="date" class="form-control" value="{{ old('data_nascimento') ?? $dadosProprietario->data_nascimento}}"  name="data_nascimento">
                                @error('data_nascimento')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label>RG/CI</label>
                                <input  type="text" class="form-control" value="{{ old('rg') ?? $dadosProprietario->rg}}"  name="rg">
                                @error('rg')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label>Orgão Emissor</label>
                                <input  type="text" class="form-control" value="{{ old('orgao_emissor') ?? $dadosProprietario->orgao_emissor}}"  name="orgao_emissor">
                                @error('orgao_emissor')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-4">
                                <label>CPF</label>
                                <input  id="cpf" type="text" class="form-control" value="{{ old('cpf') ?? $dadosProprietario->cpf}}"  name="cpf">
                                @error('cpf')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Telefone</label>
                                <input  id="telefone" type="text" class="form-control" value="{{ old('telefone') ?? $dadosProprietario->telefone}}"  name="telefone">
                                @error('telefone')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Estado Civil</label>
                                <select class="form-control" name="estado_civil">
                                    <option value="1" {{ (old('estado_civil') == 1 ? 'selected' : ($dadosProprietario->estado_civil  == 1 ? 'selected' : '')) }}>Casado</option>
                                    <option value="2" {{ (old('estado_civil') == 2 ? 'selected' : ($dadosProprietario->estado_civil  == 2 ? 'selected' : '')) }}>Divorciado</option>
                                    <option value="2" {{ (old('estado_civil') == 3 ? 'selected' : ($dadosProprietario->estado_civil  == 3 ? 'selected' : '')) }}>Viúvo</option>
                                    <option value="2" {{ (old('estado_civil') == 4 ? 'selected' : ($dadosProprietario->estado_civil  == 4 ? 'selected' : '')) }}>Solteiro</option>
                                    <option value="5" {{ (old('estado_civil') == 5 ? 'selected' : ($dadosProprietario->estado_civil  == 5 ? 'selected' : '')) }}>União Estável</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="{{route('admin.proprietario.juridico.index')}}" class="btn btn-default pull-left" data-dismiss="modal">Sair</a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <!-- /.box-body -->
                        </div>

                    </div>

                    <!--Fim Dados Bancários empressa-->
                </form>


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
    <script>
        $(document).ready(function() {
            $("#input-res-1").fileinput({
                uploadUrl: "/site/upload-file-chunks",
                enableResumableUpload: true,
                maxFileCount: 5,
                theme: 'fas',
                deleteUrl: '/site/file-delete',
                fileActionSettings: {
                    showZoom: function(config) {
                        if (config.type === 'pdf' || config.type === 'image') {
                            return true;
                        }
                        return false;
                    }
                }
            });
        });
    </script>

<script src="/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->

<script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
          })
        })
      </script>

<script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
        $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()

          //Datemask dd/mm/yyyy
          $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          //Datemask2 mm/dd/yyyy
          $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
          //Money Euro
          $('[data-mask]').inputmask()

          //Date range picker
          $('#reservation').daterangepicker()
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
          //Date range as a button
          $('#daterange-btn').daterangepicker(
            {
              ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate  : moment()
            },
            function (start, end) {
              $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
          )

          //Date picker
          $('#datepicker').datepicker({
            autoclose: true
          })

          //iCheck for checkbox and radio inputs
          $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
          })
          //Red color scheme for iCheck
          $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
          })
          //Flat red color scheme for iCheck
          $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
          })

          //Colorpicker
          $('.my-colorpicker1').colorpicker()
          //color picker with addon
          $('.my-colorpicker2').colorpicker()

          //Timepicker
          $('.timepicker').timepicker({
            showInputs: false
          })
        })
      </script>
@endsection
