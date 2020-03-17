@section('estilo')
  <link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">


  <!-- Adicionando JQuery -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>

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


                  <form method="POST" action="{{ route('admin.proprietario.fisico.store') }}">
                      @csrf
                      <input type="hidden" name="tipo_proprietario_id" value="1">

                      <!--Inicio Dados Bancários empressa-->
                      <div class="box box-default">
                          <div class="box-header with-border">
                              <h3 class="box-title">Dados Pessoais</h3>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                              <div class="form-group col-md-3">
                                  <label>Nome</label>
                                  <input  type="text" class="form-control"  value="{{ old('nome') }}" placeholder="Nome" name="nome">
                                  @error('nome')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>

                              <div class="form-group col-md-3">
                                  <label>Data Nascimento</label>
                                  <input  type="date" class="form-control" value="{{ old('data_nascimento') }}"  name="data_nascimento">
                                  @error('data_nascimento')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-3">
                                  <label>RG/CI</label>
                                  <input  type="text" class="form-control" value="{{ old('rg') }}"  name="rg">
                                  @error('rg')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-3">
                                  <label>Orgão Emissor</label>
                                  <input  type="text" class="form-control" value="{{ old('orgao_emissor') }}"  name="orgao_emissor">
                                  @error('orgao_emissor')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>


                              <div class="form-group col-md-3">
                                  <label>CPF</label>
                                  <input  id="cpf" type="text" class="form-control" value="{{ old('cpf') }}"  name="cpf">
                                  @error('cpf')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-3">
                                  <label>Telefone</label>
                                  <input  id="telefone" type="text" class="form-control" value="{{ old('telefone') }}"  name="telefone">
                                  @error('telefone')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-3">
                                  <label>Email</label>
                                  <input  id="email" type="text" class="form-control" value="{{ old('email') }}"  name="email">
                                  @error('email')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>

                              <div class="form-group col-md-3">
                                  <label>Estado Civil</label>
                                  <select class="form-control" name="estado_civil">
                                      <option value="1" {{ (old('estado_civil') == 1 ) }}>Casado</option>
                                      <option value="2" {{ (old('estado_civil') == 2 ) }}>Divorciado</option>
                                      <option value="2" {{ (old('estado_civil') == 3 ) }}>Viúvo</option>
                                      <option value="2" {{ (old('estado_civil') == 4 ) }}>Solteiro</option>
                                      <option value="5" {{ (old('estado_civil') == 4 ) }}>União Estável</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-6">
                                  <label>Profissão</label>
                                  <input  id="profissao" type="text" class="form-control" value="{{ old('profissao') }}"  name="profissao">
                                  @error('profissao')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-6">
                                  <label>Nacionalidade</label>
                                  <input  id="nacionalidade" type="text" class="form-control" value="{{ old('nacionalidade') }}"  name="nacionalidade">
                                  @error('nacionalidade')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                          </div>

                      </div>

                      <!--Fim Dados Bancários empressa-->

                      <!--Inicio Endereço empressa-->
                      <div class="box box-danger">
                          <div class="box-header with-border">
                              <h3 class="box-title">Endereço</h3>

                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                              <div class="form-group col-md-2">
                                  <label>CEP</label>
                                  <input id="cep" type="text" value="{{ old('cep') }}" class="form-control" placeholder="CEP" name="cep">
                                  @error('cep')
                                      <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              <div class="form-group col-md-8">
                                  <label>Rua</label>
                                  <input id="rua" type="text" value="{{ old('rua') }}" class="form-control" placeholder="Nome Fantasia" name="rua">
                                  @error('rua')
                                      <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              <div class="form-group col-md-2">
                                  <label>Número</label>
                                  <input type="text" class="form-control" value="{{ old('numero_casa') }}" placeholder="Número" name="numero_casa">
                                  @error('numero_casa')
                                      <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              <div class="form-group col-md-4">
                                  <label>Bairro</label>
                                  <input id="bairro" type="text" class="form-control" value="{{ old('bairro') }}" placeholder="Bairro" name="bairro">
                                  @error('bairro')
                                      <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              <div class="form-group col-md-4">
                                  <label>Cidade</label>
                                  <input id="cidade" type="text" class="form-control" value="{{ old('cidade') }}" placeholder="Cidade" name="cidade">
                                  @error('cidade')
                                      <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              <div class="form-group col-md-4">
                                  <label>Estado</label>
                                  <input id="uf" type="text" class="form-control" value="{{ old('estado') }}" placeholder="Estado" name="estado">
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
                                      <option value="1">Corrente</option>
                                      <option value="2">Poupança</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-8">
                                  <label>Nome Banco</label>
                                  <input  type="text" class="form-control" value="{{ old('banco') }}" placeholder="Banco" name="banco">
                                  @error('banco')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-4">
                                  <label>Número Agência</label>
                                  <input type="text" class="form-control" value="{{ old('agencia') }}" placeholder="Agência" name="agencia">
                                  @error('agencia')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-4">
                                  <label>Número Conta</label>
                                  <input type="text" class="form-control" value="{{ old('conta') }}" placeholder="Conta" name="conta">
                                  @error('conta')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-4">
                                  <label>Variação/Operação</label>
                                  <input  type="text" class="form-control" value="{{ old('variacao_poupanca') }}"  placeholder="Variação/Operação" name="variacao_poupanca">
                                  @error('variacao_poupanca')
                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                              </div>
                              <div class="modal-footer">
                                  <a href="{{route('admin.proprietario.juridico.index')}}" class="btn btn-default pull-left" data-dismiss="modal">Sair</a>
                                  <button type="submit" class="btn btn-primary">Salvar</button>
                                  <!-- /.box-body -->
                              </div>
                          </div>
                          <!-- /.box-body -->
                      </div>


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
