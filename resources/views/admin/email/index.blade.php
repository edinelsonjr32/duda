@section('estilo')
    <link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin//dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin//dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin/plugins/iCheck/flat/blue.css">
@endsection
@extends('admin.layout')


@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Duda Mail
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin/index"><i class="fa fa-dashboard"></i> Administrador</a></li>
                <li class="active"> <i class="fa fa-envelope"></i> Mensagens</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-2">
                    <!--<a href="compose.html" class="btn btn-primary btn-block margin-bottom">Escrever</a>-->

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pastas</h3>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a href="{{route('admin.email.index')}}"><i class="fa fa-inbox"></i> Caixa de Entrada
                                        <span class="label label-primary pull-right">{{$emailsRecebidos}}</span></a></li>
                                <!--<li><a href=""><i class="fa fa-envelope-o"></i> Enviadas <span class="label label-danger pull-right"></span></a></li>-->
                                <li><a href="{{route('admin.email.nao_lido')}}"><i class="fa fa-file-text-o"></i> Não Lidas <span class="label label-warning pull-right">{{$emailsNaoLidosCount}}</span></a></li>
                                </li>
                                <li><a href="{{route('admin.email.excluidos')}}"><i class="fa fa-trash-o"></i> Excluidas <span class="label label-info pull-right">{{$emailsExcluidos}}</span></a></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-10">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Caixa de Entrada</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                </div>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box-success">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                    @foreach($emails as $dado)
                                            <tr>
                                                <td class="mailbox-attachment col-md-1">
                                                    <a href="{{route('admin.email.show', $dado->id)}}"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td class="mailbox-name col-md-2"><a href="{{route('admin.email.show', $dado->id)}}">{{$dado->nome}}</a></td>
                                                <td class="mailbox-subject col-md-7"><b>{{$dado->titulo}}</b> - {{substr($dado->mensagem, 0, 30) . '...'}}
                                                    @if($dado->lido == 1)
                                                        <a href="#"><i class="fa fa-check"></i> Visualizado</a>
                                                    @else

                                                    @endif

                                                </td>
                                                <td class="mailbox-date col-md-2">
                                                        {{date('H:i -  d/m/Y ', strtotime($dado->created_at)) . "  -  "}}
                                                        <a href="{{route('admin.email.destroy', $dado->id)}}" class="text-danger"> <i class="fa fa-trash "></i></a>
                                                </td>
                                            </tr>
                                    @endforeach

                                        <div class="row">
                                            <div style="margin-right: auto; margin-left: auto">
                                                {{$emails->links()}}
                                            </div>
                                        </div>
                                    </tbody>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-padding">

                        </div>
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>


@endsection

@section('script')



    <!-- jQuery 3 -->
    <script src="/admin/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Slimscroll -->
    <script src="/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/admin/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="/admin/dist/js/adminlte.min.js"></script>
    <!-- iCheck -->
    <script src="/admin/plugins/iCheck/icheck.min.js"></script>
    <!-- Page Script -->
    <script>
        $(function () {
            //Enable iCheck plugin for checkboxes
            //iCheck for checkbox and radio inputs
            $('.mailbox-messages input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            //Enable check and uncheck all functionality
            $(".checkbox-toggle").click(function () {
                var clicks = $(this).data('clicks');
                if (clicks) {
                    //Uncheck all checkboxes
                    $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                    $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                } else {
                    //Check all checkboxes
                    $(".mailbox-messages input[type='checkbox']").iCheck("check");
                    $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                }
                $(this).data("clicks", !clicks);
            });

            //Handle starring for glyphicon and font awesome
            $(".mailbox-star").click(function (e) {
                e.preventDefault();
                //detect type
                var $this = $(this).find("a > i");
                var glyph = $this.hasClass("glyphicon");
                var fa = $this.hasClass("fa");

                //Switch states
                if (glyph) {
                    $this.toggleClass("glyphicon-star");
                    $this.toggleClass("glyphicon-star-empty");
                }

                if (fa) {
                    $this.toggleClass("fa-star");
                    $this.toggleClass("fa-star-o");
                }
            });
        });
    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="/admin/dist/js/demo.js"></script>

@endsection
