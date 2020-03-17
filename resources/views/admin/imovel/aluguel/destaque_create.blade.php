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
                <li class="active"> <i class="fa fa-user"></i>  Destaques</li>
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
                                <form method="POST" action="{{ route('admin.imoveis.destaque.store') }}">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Imóvel</label>
                                            <div class="col-md-6">
                                                <select class="form-control select2" style="width: 100%;" name="imovel_id">
                                                    @foreach($imoveis as $imovel)
                                                        <option value="{{$imovel->id}}" {{ (old('imovel_id') == 1 ) }}>{{$imovel->titulo}}</option>
                                                    @endforeach
                                                </select>
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

                    </div>

                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->



@endsection

@section('script')

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
