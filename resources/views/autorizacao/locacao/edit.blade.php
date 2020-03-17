@section('estilo')
    <link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">


@endsection
@extends('autorizacao.layout')


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
                <li class="active"> <i class="fa fa-file"></i>  Autorização</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Autorização de Locação</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @if(session()->exists('message'))
                                <div class="alert {{session()->get('class-color')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
                                    <h4>
                                        <i class="icon fa fa-hand-peace-o"></i>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"> Sucesso!</font></font>
                                    </h4>
                                    {{ session()->get('message') }}
                                </div>
                                <p class="icon-asterisk"></p>
                            @endif


                                @foreach($dadosAutorizacao as $dado)
                                <form method="POST" action="{{route('autorizacao.locacao.update')}}">
                                    @csrf
                                    <input type="hidden" name="idAutorizacao" value="{{$dado->idAutorizacao}}">
                                    <div class="modal-body">
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>Nome</b> <a class="pull-right">{{$dado->nome}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Email</b> <a class="pull-right">{{$dado->email}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Telefone</b> <a class="pull-right">{{$dado->telefone}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>CPF</b> <a class="pull-right">{{$dado->cpf}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Documento - Orgão Emissor</b> <a class="pull-right">{{$dado->rg}} - {{$dado->orgao_emissor}}</a>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="form-group row">
                                                    <label for="taxa" class="col-md-2 col-form-label text-md-right">{{ __('Taxa Honorário') }}</label>

                                                    <div class="col-md-2">
                                                        <input id="taxa" type="text" class="form-control @error('taxa') is-invalid @enderror" name="taxa"  value="{{$dado->taxa}}" required >

                                                        @error('taxa')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>


                                                    <label for="taxa2" class="col-md-2 col-form-label text-md-right">{{ __('Taxa Primeiro Mês') }}</label>

                                                    <div class="col-md-2">
                                                        <input id="taxa2" type="text" class="form-control @error('taxa2') is-invalid @enderror" value="{{$dado->taxa2}}" name="taxa2" >

                                                        @error('taxa2')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>

                                                    <label for="taxa" class="col-md-2 col-form-label text-md-right">{{ __('Taxa Administração') }}</label>

                                                    <div class="col-md-2">
                                                        <input id="taxa3" type="text" class="form-control @error('taxa3')  is-invalid @enderror" value="{{$dado->taxa3}}" name="taxa3" >

                                                        @error('taxa3')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="form-group row">
                                                    <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Data Inicio Autorização') }}</label>

                                                    <div class="col-md-4">
                                                        <input id="dataInicio" type="date" class="form-control @error('dataInicio') is-invalid @enderror" value="{{$dado->dataInicio}}" name="dataInicio" required >

                                                        @error('dataInicio')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                    <label for="dataFIm" class="col-md-2 col-form-label text-md-right">{{ __('Data Fim Autorização') }}</label>

                                                    <div class="col-md-4">
                                                        <input id="dataFim" type="date" class="form-control @error('dataFim')  is-invalid @enderror" value="{{$dado->dataFim}}" name="dataFim" required >
                                                        @error('dataFim')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>






                                        <input type="hidden" name="proprietarioId" value="{{$dado->proprietarioId}}">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left col-md-4" data-dismiss="modal"><i class="fa fa-check"></i>Cancelar</button>
                                        <button type="submit" class="btn btn-primary col-md-4 pull-right">Avançar <i class="fa fa-flag"></i></button>
                                    </div>
                                </form>
                                @endforeach
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
