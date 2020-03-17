@section('estilo')
    <link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">
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
                <li><a href="/corretor/index"><i class="fa fa-dashboard"></i> Administrativo</a></li>
                <li class="active"> <i class="fa fa-user"></i>  Visita</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Visitas Hoje</h3>
                            <button type="button" class="btn btn-success col-md-2 col-md-offset-10" data-toggle="modal" data-target="#modal-default">
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
                                        <form method="POST" action="{{ route('administrativovisita.store') }}">
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
                                                    <label for="imovel_id" class="col-md-4 col-form-label text-md-right">Imóvel</label>
                                                    <div class="col-md-6">
                                                        <select class="form-control select2" style="width: 100%;" name="imovel_id">
                                                            @foreach($imoveis as $dado)
                                                                <option value="{{$dado->id}}">
                                                                    Cod {{$dado->id}} - {{$dado->titulo}}
                                                                </option>
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
                            @if($visitas == '[]')
                                Sem dados cadastrados
                            @elseif($visitas !== '[]')
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 40%">Corretor</th>
                                        <th style="width: 10%">Data</th>
                                        <th style="width: 10%">Hora</th>
                                        <th style="width: 40%">-</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $visitas as $dado )
                                        <tr>
                                            <td cla>{{$dado->nome}}</td>
                                            <td>{{date('d/m/Y', strtotime($dado->data))}}
                                            </td>
                                            <td>{{$dado->hora}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4 col-xs-4">
                                                        <a  class=" btn btn-block btn-info" href="{{route('administrativovisita.show', $dado->id)}}"><span class="fa fa-eye"></span></a>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4">
                                                        <a class=" btn btn-block btn-primary" href="{{route('administrativovisita.edit', $dado->id)}}"><span class="fa fa-pencil"></span></a>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4">
                                                        <a  class=" btn btn-block btn-danger" href="{{route('administrativo.visita.destroy', $dado->id)}}"><span class="fa fa-trash"></span></a>
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
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-6 col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header">
                            <h3 class="box-title">Minhas Visitas</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box-success">
                            @if($minhasVisitas == '[]')
                                Sem dados cadastrados
                            @elseif($minhasVisitas !== '[]')
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 40%">Corretor</th>
                                        <th style="width: 10%">Data</th>
                                        <th style="width: 10%">Hora</th>
                                        <th style="width: 40%">-</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $minhasVisitas as $dado )
                                        <tr>
                                            <td cla>{{$dado->nome}}</td>
                                            <td>{{date('d/m/Y', strtotime($dado->data))}}
                                            </td>
                                            <td>{{$dado->hora}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4 col-xs-4">
                                                        <a  class=" btn btn-block btn-info" href="{{route('administrativovisita.show', $dado->id)}}"><span class="fa fa-eye"></span></a>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4">
                                                        <a class=" btn btn-block btn-primary" href="{{route('administrativovisita.edit', $dado->id)}}"><span class="fa fa-pencil"></span></a>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4">
                                                        <a  class=" btn btn-block btn-danger" href="{{route('administrativo.visita.destroy', $dado->id)}}"><span class="fa fa-trash"></span></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{$visitasTotais->links()}}
                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Todas Visitas</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box-success">
                            @if($visitasTotais == '[]')
                                Sem dados cadastrados
                            @elseif($visitasTotais !== '[]')
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 40%">Corretor</th>
                                        <th style="width: 10%">Data</th>
                                        <th style="width: 10%">Hora</th>
                                        <th style="width: 20%">-</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $visitasTotais as $dado )
                                        <tr>
                                            <td cla>{{$dado->nome}}</td>
                                            <td>{{date('d/m/Y', strtotime($dado->data))}}
                                            </td>
                                            <td>{{$dado->hora}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4 col-xs-4">
                                                        <a  class=" btn btn-block btn-info" href="{{route('administrativovisita.show', $dado->id)}}"><span class="fa fa-eye"></span></a>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4">
                                                        <a class=" btn btn-block btn-primary" href="{{route('administrativovisita.edit', $dado->id)}}"><span class="fa fa-pencil"></span></a>
                                                    </div>
                                                    <div class="col-md-4 col-xs-4">
                                                        <a  class=" btn btn-block btn-danger" href="{{route('administrativo.visita.destroy', $dado->id)}}"><span class="fa fa-trash"></span></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{$visitasTotais->links()}}
                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
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
