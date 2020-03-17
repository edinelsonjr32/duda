@section('estilo')
  <link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">


  <!-- Adicionando JQuery -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>

  <!-- Adicionando Javascript -->
  <script type="text/javascript" >

      $(document).ready(function() {

          function limpa_formulário_cep() {
              // Limpa valores do formulário de cep.
              $("#rua").val("");
              $("#bairro").val("");
              $("#cidade").val("");
              $("#uf").val("");
              $("#ibge").val("");
          }

          //Quando o campo cep perde o foco.
          $("#cep").blur(function() {

              //Nova variável "cep" somente com dígitos.
              var cep = $(this).val().replace(/\D/g, '');

              //Verifica se campo cep possui valor informado.
              if (cep != "") {

                  //Expressão regular para validar o CEP.
                  var validacep = /^[0-9]{8}$/;

                  //Valida o formato do CEP.
                  if(validacep.test(cep)) {

                      //Preenche os campos com "..." enquanto consulta webservice.
                      $("#rua").val("...");
                      $("#bairro").val("...");
                      $("#cidade").val("...");
                      $("#uf").val("...");
                      $("#ibge").val("...");

                      //Consulta o webservice viacep.com.br/
                      $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                          if (!("erro" in dados)) {
                              //Atualiza os campos com os valores da consulta.
                              $("#rua").val(dados.logradouro);
                              $("#bairro").val(dados.bairro);
                              $("#cidade").val(dados.localidade);
                              $("#uf").val(dados.uf);
                              $("#ibge").val(dados.ibge);
                          } //end if.
                          else {
                              //CEP pesquisado não foi encontrado.
                              limpa_formulário_cep();
                              alert("CEP não encontrado.");
                          }
                      });
                  } //end if.
                  else {
                      //cep é inválido.
                      limpa_formulário_cep();
                      alert("Formato de CEP inválido.");
                  }
              } //end if.
              else {
                  //cep sem valor, limpa formulário.
                  limpa_formulário_cep();
              }
          });
      });

  </script>

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
        <li><a href="/administrativo/index"><i class="fa fa-dashboard"></i> Administrativo</a></li>
        <li class="active"> <i class="fa fa-user"></i>  Proprietário</li>
      </ol>
    </section>

    <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Proprietário</h3>

                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">

                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                            <form method="POST" action="{{ route('administrativo.proprietario.store') }}">
                                @csrf

                                <div class="modal-body">

                                    <div class="form-group row">
                                        <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                        <div class="col-md-6">
                                            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autocomplete="Nome" autofocus>

                                            @error('nome')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="data_nascimento" class="col-md-4 col-form-label text-md-right">{{ __('Data Nascimento') }}</label>

                                        <div class="col-md-6">
                                            <input id="data_nascimento" type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" value="{{ old('data_nascimento') }}" required autocomplete="Nome" autofocus>

                                            @error('data_nascimento')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label for="rg" class="col-md-4 col-form-label text-md-right">{{ __('Rg (Opcional)') }}</label>
                                        <div class="col-md-6">
                                            <input id="rg" type="text" value="{{ old('rg') }} "  class="form-control @error('rg') is-invalid @enderror" name="rg" required autocomplete="rg" >

                                            @error('rg')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('Cpf') }}</label>
                                        <div class="col-md-6">
                                            <input id="cpf" type="text" value="{{ old('cpf') }} "  class="form-control @error('cpf') is-invalid @enderror" name="cpf" required autocomplete="cpf" >

                                            @error('cpf')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('Cnpj') }}</label>
                                        <div class="col-md-6">
                                            <input id="cnpj" type="text" value="{{ old('cnpj') }} "  class="form-control @error('cnpj') is-invalid @enderror" name="cnpj"  autocomplete="cnpj" >

                                            @error('cnpj')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nome_fantasia" class="col-md-4 col-form-label text-md-right">{{ __('Nome Fantasia') }}</label>
                                        <div class="col-md-6">
                                            <input id="nome_fantasia" type="text" value="{{ old('nome_fantasia') }} "  class="form-control @error('nome_fantasia') is-invalid @enderror" name="nome_fantasia"  autocomplete="nome_fantasia" >

                                            @error('nome_fantasia')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tipo_proprietario" class="col-md-4 col-form-label text-md-right">Tipo Proprietário</label>
                                        <div class="col-md-6">
                                            <select class="form-control select2" style="width: 100%;" name="tipo_proprietario_id">
                                                <option value="1" {{ (old('tipo_proprietario_id') == 1 ) }}>Pessoa Física</option>
                                                <option value="2" {{ (old('tipo_proprietario_id') == 2 ) }}>Pessoa Juridica</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="estado_civil" class="col-md-4 col-form-label text-md-right">Estado Civil</label>
                                        <div class="col-md-6">
                                            <select class="form-control select2" style="width: 100%;" name="estado_civil">
                                                <option value="1" {{ (old('estado_civil') == 1 ) }}>Casado</option>
                                                <option value="2" {{ (old('estado_civil') == 2 ) }}>Divorciado</option>
                                                <option value="2" {{ (old('estado_civil') == 3 ) }}>Viúvo</option>
                                                <option value="2" {{ (old('estado_civil') == 4 ) }}>Solteiro</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')}}" required autocomplete="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="banco" class="col-md-4 col-form-label text-md-right">{{ __('banco') }}</label>

                                        <div class="col-md-6">
                                            <input id="banco" type="text" class="form-control @error('banco') is-invalid @enderror" name="banco" value="{{ old('banco')}}" required autocomplete="banco">
                                            @error('banco')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="agencia" class="col-md-4 col-form-label text-md-right">{{ __('Agência') }}</label>

                                        <div class="col-md-6">
                                            <input id="agencia" type="text" class="form-control @error('agencia') is-invalid @enderror" name="agencia" value="{{ old('agencia')}}" required autocomplete="agencia">
                                            @error('agencia')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="conta" class="col-md-4 col-form-label text-md-right">{{ __('Conta') }}</label>

                                        <div class="col-md-6">
                                            <input id="conta" type="text" class="form-control @error('conta') is-invalid @enderror" name="conta" value="{{ old('conta')}}" required autocomplete="conta">
                                            @error('conta')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('telefone') }}</label>
                                        <div class="col-md-6">
                                            <input id="telefone" type="text" value="{{ old('telefone') }} "  class="form-control @error('telefone') is-invalid @enderror" name="telefone" required autocomplete="telefone" >

                                            @error('telefone')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="cep" class="col-md-4 col-form-label text-md-right">{{ __('CEP') }}</label>
                                        <div class="col-md-6">
                                            <input id="cep" type="text"  value="{{ old('cep') }} "  class="form-control @error('cep') is-invalid @enderror" name="cep" required autocomplete="cep" >

                                            @error('cep')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rua" class="col-md-4 col-form-label text-md-right">{{ __('Rua') }}</label>
                                        <div class="col-md-6">
                                            <input id="rua" type="text" value="{{ old('rua') }} "  class="form-control @error('rua') is-invalid @enderror" name="rua" required autocomplete="rua" >

                                            @error('rua')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="numero_casa" class="col-md-4 col-form-label text-md-right">{{ __('N°') }}</label>
                                        <div class="col-md-6">
                                            <input id="numero_casa" type="text" value="{{ old('numero_casa') }} "  class="form-control @error('numero_casa') is-invalid @enderror" name="numero_casa" required autocomplete="numero_casa" >

                                            @error('numero_casa')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>
                                        <div class="col-md-6">
                                            <input id="bairro" type="text" value="{{ old('bairro') }} "  class="form-control @error('bairro') is-invalid @enderror" name="bairro" required autocomplete="bairro" >

                                            @error('bairro')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label for="cidade" class="col-md-4 col-form-label text-md-right">{{ __('Cidade') }}</label>
                                        <div class="col-md-6">
                                            <input id="cidade" type="text" value="{{ old('cidade') }} "  class="form-control @error('cidade') is-invalid @enderror" name="cidade" required autocomplete="cidade" >

                                            @error('cidade')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="uf" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                                        <div class="col-md-6">
                                            <input id="uf" type="text" value="{{ old('estado') }} "  class="form-control @error('estado') is-invalid @enderror" name="estado" required autocomplete="estado" >

                                            @error('estado')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('admin.usuario.index')}}" class="btn btn-default pull-left" data-dismiss="modal">Sair</a>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->


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
