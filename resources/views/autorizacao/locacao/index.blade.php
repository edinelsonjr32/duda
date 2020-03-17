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
                <li class="active"> <i class="fa fa-hand-o-up"></i>  Autorizações</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Autorizações de Locação</h3>
                            <button type="button" class="btn btn-success col-md-1 col-md-offset-11" data-toggle="modal" data-target="#modal-default">
                                Adicionar
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Adicionar Autorização</h4>
                                        </div>
                                        <form method="POST" action="{{route('autorizacao.locacao.busca_imovel')}}">
                                            @csrf
                                            <div class="modal-body">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">Proprietário</label>
                                                    <div class="col-md-6">
                                                        <select class="form-control select2" style="width: 100%;" name="proprietarioId">
                                                            @foreach($proprietarios as $proprietario)
                                                                @if($proprietario->tipo_proprietario_id == 1)
                                                                    <option value="{{$proprietario->id}}">{{$proprietario->nome}}</option>
                                                                @elseif($proprietario->tipo_proprietario_id == 2)
                                                                    <option value="{{$proprietario->id}}">{{$proprietario->nome_empresa}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
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

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 40%">Nome</th>
                                    <th style="width: 25%">Data Inicio</th>
                                    <th style="width: 20%">Data Fim</th>
                                    <th style="width: 15%">-</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ( $autorizacoes as $dado )
                                    <tr>
                                        <td>
                                            @if($dado->tipo_proprietario_id == 1)
                                                {{$dado->nome}}
                                            @elseif($dado->tipo_proprietario_id == 2)
                                                {{$dado->nome_empresa}}
                                            @endif
                                        </td>
                                        <td>{{date('d/m/Y', strtotime($dado->dataInicio))}}
                                        </td>
                                        <td>{{date('d/m/Y', strtotime($dado->dataFim))}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a class=" btn btn-block btn-success" href="{{route('autorizacao.locacao.show', $dado->id)}}"><span class="fa fa-eye"></span></a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a class=" btn btn-block btn-primary" href="{{route('autorizacao.locacao.edit', $dado->id)}}"><span class="fa fa-pencil"></span></a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a  class=" btn btn-block btn-danger" href="{{route('admin.proprietario.fisico.destroy', $dado->id)}}"><span class="fa fa-trash"></span></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
