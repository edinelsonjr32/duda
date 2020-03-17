@section('estilo')

  <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">
  <style>
      .example-modal .modal {
          position: relative;
          top: auto;
          bottom: auto;
          right: auto;
          left: auto;
          display: block;
          z-index: 1;
      }

      .example-modal .modal {
          background: transparent !important;
      }
  </style>
@endsection
@extends('corretor.layout')


@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/corretor/index"><i class="fa fa-dashboard"></i> Corretor</a></li>
        <li class="active"> <i class="fa fa-user"></i>  Usuário</li>
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
        @foreach($dadosImovel as $dados)
        <div class="panel box box-primary">
            <?php
                $contador = 0;
            ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-yellow">
                                <div class="widget-user-image">
                                    <img class="" style="" src="/font-imobiliaria/png/house-4.png" alt="User Avatar">
                                    <br>
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username"><b>{{$dados->titulo}}</b></h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Responsável: <span class="pull-right badge bg-blue">{{$dados->nomeCorretor}}</span></a></li>
                                    <li><a href="#">Tipo Imóvel <span class="pull-right badge bg-blue">{{$dados->nomeTipo}}</span></a></li>
                                    <li><a href="#">Proprietário <span class="pull-right badge bg-blue">{{$dados->nome}}</span></a></li>
                                    @if($dados->aluguel == 1)
                                        <li><a href="#">Valor Aluguel<span class="pull-right badge bg-blue">R$:{{$dados->valor_aluguel}}</span></a></li>
                                    @endif
                                    @if($dados->venda == 1)
                                        <li><a href="#">Valor Venda<span class="pull-right badge bg-blue">R$:{{$dados->valor_venda}}</span></a></li>
                                    @endif

                                    @if($dados->impostos == null )
                                    @elseif($dados->impostos !== null)
                                        <li><a href="#">Impostos <span class="pull-right badge bg-blue">R$:{{$dados->impostos}}</span></a></li>
                                    @endif

                                    <li><a href="#">Endereço <span class="pull-right badge bg-red">{{$dados->endereco}}</span></a></li>
                                    <li><a href="#">Bairro <span class="pull-right badge bg-red">{{$dados->bairro}}</span></a></li>
                                    <li><a href="#">Complemento <span class="pull-right badge bg-red">{{$dados->complemento}}</span></a></li>
                                    <li><a href="#">Cidade <span class="pull-right badge bg-red">{{$dados->cidade}}</span></a></li>
                                    <li><a href="#">Estado <span class="pull-right badge bg-red">{{$dados->estado}}</span></a></li>
                                    <li><a href="#">Garagem <span class="pull-right badge bg-green">{{$dados->garagem}}</span></a></li>
                                    <li><a href="#">Garagem Coberta<span class="pull-right badge bg-green">{{$dados->garagem_coberta}}</span></a></li>

                                    <li><a href="#">Banheiros<span class="pull-right badge bg-green">{{$dados->banheiros}}</span></a></li>
                                    <li><a href="#">Suites<span class="pull-right badge bg-green">{{$dados->suites}}</span></a></li>
                                    <li><a href="#">Salas<span class="pull-right badge bg-green">{{$dados->salas}}</span></a></li>

                                    @if($dados->ar_condicionado == 1)
                                        <li><a href="#">Ar condicionado<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif
                                    @if($dados->bar == 1)
                                        <li><a href="#">Bar<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif
                                    @if($dados->livraria == 1)
                                        <li><a href="#">Livraria<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif
                                    @if($dados->churrasqueira == 1)
                                        <li><a href="#">Churrasqueira<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif





                                </ul>
                            </div>
                        </div>
                            <div class="box box-warning ">
                                <div class="box-header with-border">
                                    <i class="fa fa-text-width"></i>

                                    <h3 class="box-title">Descrição</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p style="text-align: justify-all"><?php printf($dados->descricao)?></p>
                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        <div class="box box-warning ">
                            <div class="box-header with-border">
                                <i class="fa fa-image"></i>

                                <h3 class="box-title">Imagens</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-dark">
                                    <tr>
                                        <th style="width: 10%">#</th>
                                        <th>Imagem</th>
                                    </tr>
                                    @foreach($imagensImoveis as $imagem)
                                        <tr>
                                            <td>{{$imagem->id}}</td>
                                            <td>
                                                <img src="{{ URL::to('/') }}/imovel/images/{{ $imagem->path }}" class="img-thumbnail" width="90"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>


                                </div>
                            <!-- /.box-body -->
                        </div>


                </div>

                    <div class="col-md-4">
                        <div class="row">

                            <div id="carousel-example-generic" class="carousel slide col-md-12" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    @for($contador =0; $contador > $contador1; $contador+1){
                                    @if($contador == 0)
                                        <li data-target="#carousel-example-generic" data-slide-to="{{$contador}}" class="active"></li>
                                    @endif
                                    <li data-target="#carousel-example-generic" data-slide-to="{{$contador}}" class=""></li>


                                    @endfor
                                </ol>
                                <?php
                                $contador2 = 0;
                                ?>
                                <div class="carousel-inner">
                                    @foreach($imagensImoveis as $active)
                                        @if($contador2 == 0)
                                            <div class="item active">
                                                <img src="{{ URL::to('/') }}/imovel/images/{{ $active->path }}" alt="First slide">
                                            </div>
                                            <?php
                                            $contador2 = 1;
                                            ?>
                                        @elseif($contador2 !== 0)
                                            <div class="item">
                                                <img src="{{ URL::to('/') }}/imovel/images/{{ $active->path }}" alt="Second slide">
                                            </div>
                                            <?php
                                            $contador2 = $contador2 +1;
                                            ?>
                                        @endif


                                    @endforeach
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                                <br>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><img class="" style="width: 80%" src="/font-imobiliaria/png/house.png" alt="User Avatar">
                                    </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Área Total</span>
                                        <span class="info-box-number">{{$dados->area_total}} M²</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><img class="" style="width: 80%" src="/font-imobiliaria/png/location.png" alt="User Avatar"></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Cidade/Estado</span>
                                        <span class="info-box-number">Santarém/Pá</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <div class="info-box">
                                    <span class="info-box-icon bg-blue"><i class="fa fa-flag-o"></i></span>

                                    @if($dados->aluguel == 1)
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tipo de Transação</span>
                                        <span class="info-box-number">Aluguel</span>
                                    </div>
                                    @endif

                                    @if($dados->venda == 1)
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tipo de Transação</span>
                                            <span class="info-box-number">Venda</span>
                                        </div>
                                @endif
                                    <!-- /.info-box-content -->
                                </div>

                                <button type="button" class="btn btn-info col-md-12" data-toggle="modal" data-target="#modal-default" >
                                    Adicionar Visita
                                </button>

                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Adicionar Visita</h4>
                                            </div>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form method="POST" action="{{ route('visita.store') }}">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group row">
                                                        <label for="email" class="col-md-4 col-form-label text-md-right">Corretor</label>
                                                        <div class="col-md-6">
                                                            <select class="form-control select2" style="width: 100%;" name="users_id">
                                                                @foreach($users as $dado)
                                                                    <option value="{{$dado->id}}">{{$dado->nome}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="data" class="col-md-4 col-form-label text-md-right">{{ __('Data') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="data" type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="{{ old('data') }}" required autocomplete="data">

                                                            @error('data')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="imovel_id" value="{{$dados->id}}">
                                                    <div class="form-group row">
                                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="hora" type="time" class="form-control @error('password') is-invalid @enderror" name="hora" required autocomplete="hora">

                                                            @error('hora')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
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
                                <!-- /.modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
  </section>
  </div>
  <!-- /.content-wrapper -->



@endsection

@section('script')


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
