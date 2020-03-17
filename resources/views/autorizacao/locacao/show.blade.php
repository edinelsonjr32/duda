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
                <li class="active"> <i class="fa fa-user"></i>  Usuário</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary box-solid">
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

                                    <div class="modal-body">

                                        <ul class="list-group list-group-unbordered">
                                            @foreach($dadosAutorizacao as $dado)
                                                <div class="box box-warning box-solid">
                                                    <div class="box-header with-border">
                                                        <i class="fa fa-user"></i>
                                                        <h3 class="box-title">Dados Proprietário</h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
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
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>


                                                <div class="box box-success box-solid ">
                                                    <div class="box-header with-border">
                                                        <i class="fa fa-file-archive-o"></i>

                                                        <h3 class="box-title">Documentos</h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <form action="{{route('autorizacao.locacao.documento.store')}}" enctype="multipart/form-data" method="post">
                                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
                                                                    <button  type="submit" class="btn btn-success col-md-10">Enviar</button>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="idAutorizacao" value="{{$dado->idAutorizacao}}">
                                                        </form>


                                                        <table class="table table-dark box-solid">
                                                            <tr>
                                                                <th>Nome</th>
                                                                <th style="width: 10%">-</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-success"><b> Autorização</b> <i class="fa fa-file-pdf-o"></i></td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <a type="button" href="{{route('autorizacao.locacao.download', ['id' => $dado->idAutorizacao])}}" class="btn btn-block btn-default"><span class="fa fa-download"></span></a>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>

                                                            @if($anexos == [])

                                                            @elseif($anexos !== [])
                                                                @foreach($anexos as $dado)
                                                                    <tr>
                                                                        <td> {{$dado->nome}} <i class="fa fa-paperclip"></i></td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <a type="button" href="{{route('autorizacao.locacao.download.file', ['id' => $dado->id])}}" class="btn btn-block btn-success"><span class="fa fa-download"></span></a>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <a type="button" href="{{route('autorizacao.locacao.documento.destroy', ['id' => $dado->id])}}" class="btn btn-block btn-danger"><span class="fa fa-trash"></span></a>
                                                                                </div>
                                                                            </div>

                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </table>

                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>


                                                <div class="box box-info box-solid">
                                                    <div class="box-header with-border">
                                                        <i class="fa fa-home"></i>

                                                        <h3 class="box-title">Imóveis vinculados</h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        @foreach($imoveisAutorizacao as $imoveis)
                                                            <li class="list-group-item">
                                                                <b>{{$imoveis->titulo}} - </b> <span class="pull-right text-blue"> R$: {{number_format($imoveis->valor_aluguel, 2, ',', '.')}}</span>
                                                            </li>
                                                        @endforeach
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>







                                            @endforeach
                                        </ul>
                                    </div>
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
