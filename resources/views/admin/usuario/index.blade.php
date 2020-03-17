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
                    <h3 class="box-title">Usuários</h3>
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
                                      <h4 class="modal-title">Criar Usuário</h4>
                                    </div>
                                    <form method="POST" action="{{ route('admin.usuario.save') }}">
                                            @csrf
                                    <div class="modal-body">

                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                        <div class="form-group row">
                                            <label for="apelido" class="col-md-4 col-form-label text-md-right">{{ __('Apelido') }}</label>

                                            <div class="col-md-6">
                                                <input id="apelido" type="text" class="form-control @error('apelido') is-invalid @enderror" name="apelido" value="{{ old('apelido') }}" required autocomplete="apelido" autofocus>

                                                @error('apelido')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                                    <div class="form-group row">
                                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                        <div class="form-group row">
                                            <label for="creci" class="col-md-4 col-form-label text-md-right">{{ __('CRECI') }}</label>

                                            <div class="col-md-6">
                                                <input id="creci" type="text" class="form-control @error('creci') is-invalid @enderror" name="creci" value="{{ old('creci') }}"  autocomplete="creci">

                                                @error('creci')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                                    <div class="form-group row">
                                                            <label for="email" class="col-md-4 col-form-label text-md-right">Tipo Usuário</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control select2" style="width: 100%;" name="tipoUsers">
                                                                    <option value="1">Administrador</option>
                                                                    <option value="2">Corretor</option>
                                                                    <option value="3">Financeiro</option>
                                                                    <option value="4">Administrativo</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    <div class="form-group row">
                                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                        </div>
                                                    </div>
                                    </div>
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
                          <th style="width: 8%">Foto</th>
                        <th style="width: 40%">Nome</th>
                        <th style="width: 10%">Tipo Usuário</th>
                        <th style="width: 20%">Email</th>
                        <th style="width: 15%">-</th>
                      </tr>
                      </thead>
                      <tbody>
                          @foreach ( $usuarios as $usuario )
                          <tr>
                                <td>
                                    <?php
                                        $imagem = \Illuminate\Support\Facades\DB::table('user_imagem')->select('user_imagem.path')->where('user_imagem.user_id', '=', $usuario->id)->value('user_imagem.path');
                                    ?>
                                    @if($imagem == [])
                                        <img src="../../admin/dist/img/proprietario.png" class="img-thumbnail" style="width: 90px; height :90px" alt="User Image">
                                    @elseif($imagem !== [])
                                        <img src="../../../../usuario/images/{{$imagem}}" class="img-thumbnail" style="width: 90px; height :90px" />
                                    @endif

                                </td>
                                <td >{{$usuario->name}}</td>
                                <td>{{$usuario->nomeTipo}}
                                </td>
                                <td>{{$usuario->email}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                                <a class=" btn btn-block btn-primary" href="{{route('admin.usuario.edit', $usuario->id)}}"><span class="fa fa-pencil"></span></a>
                                        </div>
                                        <div class="col-md-6">
                                                <a  class=" btn btn-block btn-danger" href="{{route('admin.usuario.destroy', $usuario->id)}}"><span class="fa fa-trash"></span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                      </tfoot>
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
