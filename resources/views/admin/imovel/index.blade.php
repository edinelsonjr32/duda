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
        <li class="active"> <i class="fa fa-user"></i>  Usuário</li>
      </ol>
    </section>

    <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Imóveis</h3>
                    <a type="button" class="btn btn-success col-md-1 col-md-offset-11"  href="{{route('admin.imoveis.create')}}">
                            Adicionar
                    </a>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">

                      <h2>Imóveis para Venda</h2>
                    <table id="example2" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                              <th style="width: 5%">Destaque</th>
                              <th style="width: 20%">Titulo</th>
                              <th style="width: 20%">Tipo Imóvel</th>
                              <th style="width: 15%">-</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach ( $dadosImoveis as $dados )
                              <tr>
                                  <td>
                                      <div class="col-12">
                                          <img src="{{ URL::to('/') }}/imovel/images/{{ $dados->path }}" class="img-thumbnail" width="120"/>
                                      </div>
                                  </td>
                                  <td >
                                      <div class="row invoice-info">
                                          <div class="col-sm-12 invoice-col">
                                              <address>
                                                  {{$dados->titulo}}
                                              </address>
                                          </div>
                                      </div>
                                  </td>
                                  <td >
                                      <!-- /.col -->
                                      <div class="col-sm-12 invoice-col">
                                          <address>
                                              <?php
                                              printf($dados->nomeTipoImovel);
                                              ?>
                                          </address>
                                      </div>
                                  </td>
                                  <td>
                                      <div class="row">
                                          @if($dados->status == 1)
                                              <div class="col-md-3">
                                                  <a type="button" href="{{route('admin.imoveis.desativar', ['id' => $dados->id])}}" class=" btn btn-block btn-success"><span class="fa fa-unlock"></span></a>
                                              </div>
                                          @elseif($dados->status == 0)
                                              <div class="col-md-3">
                                                  <a type="button" href="{{route('admin.imoveis.ativar', ['id' => $dados->id])}}" class=" btn btn-block btn-danger"><span class="fa fa-lock"></span></a>
                                              </div>
                                          @endif
                                          <div class="col-md-3">
                                              <a type="button" href="{{route('admin.imoveis.detail', ['id' => $dados->id])}}" class=" btn btn-block btn-info"><span class="fa fa-eye"></span></a>
                                          </div>
                                          <div class="col-md-3">
                                              <a type="button" href="{{route('admin.imoveis.edit', ['id' => $dados->id])}}" class=" btn btn-block btn-primary"><span class="fa fa-pencil"></span></a>
                                          </div>
                                          <div class="col-md-3">
                                              <a type="button" href="{{route('admin.imoveis.destroy', ['id' => $dados->id])}}" class=" btn btn-block btn-danger"><span class="fa fa-trash"></span></a>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                          @endforeach
                      </table>
                      {{$dadosImoveis->links()}}


                      <h2>Imóveis para Alugar</h2>
                      <table id="example3" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                              <th style="width: 5%">Destaque</th>
                              <th style="width: 20%">Titulo</th>
                              <th style="width: 20%">Tipo Imóvel</th>
                              <th style="width: 15%">-</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach ( $dadosImoveis2 as $dados )
                              <tr>
                                  <td>
                                      <div class="col-12">
                                          <img src="{{ URL::to('/') }}/imovel/images/{{ $dados->path }}" class="img-thumbnail" width="120"/>
                                      </div>
                                  </td>
                                  <td >
                                      <div class="row invoice-info">
                                          <div class="col-sm-12 invoice-col">
                                              <address>
                                                  {{$dados->titulo}}
                                              </address>
                                          </div>
                                      </div>
                                  </td>
                                  <td >
                                      <!-- /.col -->
                                      <div class="col-sm-12 invoice-col">
                                          <address>
                                              <?php
                                              printf($dados->nomeTipoImovel);
                                              ?>
                                          </address>
                                      </div>
                                  </td>
                                  <td>
                                      <div class="row">
                                          @if($dados->status == 1)
                                              <div class="col-md-3">
                                                  <a type="button" href="{{route('admin.imoveis.desativar', ['id' => $dados->id])}}" class=" btn btn-block btn-success"><span class="fa fa-unlock"></span></a>
                                              </div>
                                          @elseif($dados->status == 0)
                                              <div class="col-md-3">
                                                  <a type="button" href="{{route('admin.imoveis.ativar', ['id' => $dados->id])}}" class=" btn btn-block btn-danger"><span class="fa fa-lock"></span></a>
                                              </div>
                                          @endif
                                          <div class="col-md-3">
                                              <a type="button" href="{{route('admin.imoveis.detail', ['id' => $dados->id])}}" class=" btn btn-block btn-info"><span class="fa fa-eye"></span></a>
                                          </div>
                                          <div class="col-md-3">
                                              <a type="button" href="{{route('admin.imoveis.edit', ['id' => $dados->id])}}" class=" btn btn-block btn-primary"><span class="fa fa-pencil"></span></a>
                                          </div>
                                          <div class="col-md-3">
                                              <a type="button" href="{{route('admin.imoveis.destroy', ['id' => $dados->id])}}" class=" btn btn-block btn-danger"><span class="fa fa-trash"></span></a>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                          @endforeach
                          </tfoot>
                      </table>
                      {{$dadosImoveis2->links()}}
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
          $('#example3').DataTable()
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
