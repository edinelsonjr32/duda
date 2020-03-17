<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Duda imobiliária | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/admin/bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="/font-imobiliaria/font/flaticon.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
@yield('estilo')
<!-- AdminLTE Skins. Choose a skin from the css/skins
       venda instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/admin//bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/admin//bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/admin//bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{route('admin.index')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="/images/duda.png" alt="" width="50px"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b style="color: #ffc236">Duda</b> <span style="color: #ffc236">Imobiliária</span></span>

        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-user"></span>
                            <span class="hidden-xs">{{ Auth::user()->apelido }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <?php
                                $imagemFoto = \Illuminate\Support\Facades\DB::table('user_imagem')->select('user_imagem.path')->where('user_imagem.user_id', '=', \Illuminate\Support\Facades\Auth::id() )->where('user_imagem.status', '=', true)->value('user_imagem.path');

                                ?>
                                @if($imagemFoto == [])
                                    <img src="/admin/dist/img/proprietario.png" class="img-circle" alt="User Image">
                                @else
                                    <img src="../../usuario/images/{{$imagemFoto}}" class="img-circle" alt="User Image">
                                @endif
                                <p>
                                    {{ Auth::user()->apelido }}
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('perfil')}}" class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sair</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>
    <?php
    $tipoUsuario = \Illuminate\Support\Facades\DB::table('users')->select('users.tipo_user_id')->where('users.id', '=', \Illuminate\Support\Facades\Auth::id())->value('users.tipo_user_id');

    ?>

    @if($tipoUsuario == 2)
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <?php
                        $imagemFoto = \Illuminate\Support\Facades\DB::table('user_imagem')->select('user_imagem.path')->where('user_imagem.user_id', '=', \Illuminate\Support\Facades\Auth::id() )->where('user_imagem.status', '=', true)->value('user_imagem.path');
                        ?>
                        @if($imagemFoto == [])
                            <img src="../admin/dist/img/proprietario.png" class="img-circle" alt="User Image">
                        @else
                            <img src="../../../usuario/images/{{$imagemFoto}}" class="img-circle"style="height: 50px; " alt="User Image">
                        @endif
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->apelido }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <span>Proprietário</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('corretor.proprietario.juridico.index')}}"><i class="fa fa-circle-o"></i> Pessoa Jurídica</a></li>
                            <li><a href="{{route('corretor.proprietario.fisico.index')}}"><i class="fa fa-circle-o"></i> Pessoa Física</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span>Imóveis</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('corretor.imoveis.aluguel.index')}}"><i class="fa fa-circle-o"></i> Aluguel</a></li>
                            <li><a href="{{route('corretor.imoveis.venda.index')}}"><i class="fa fa-circle-o"></i> Venda</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('corretorvisita.index')}}">
                            <i class="fa fa-key"></i> <span>Visitas</span>
                            <span class="pull-right-container">
              </span>
                        </a>
                    </li>




                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
    @elseif($tipoUsuario ==1)

        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <?php
                        $imagemFoto = \Illuminate\Support\Facades\DB::table('user_imagem')->select('user_imagem.path')->where('user_imagem.user_id', '=', \Illuminate\Support\Facades\Auth::id() )->where('user_imagem.status', '=', true)->value('user_imagem.path');

                        ?>
                        @if($imagemFoto == '[]')
                            <img src="../admin/dist/img/proprietario.png" class="img-circle" alt="User Image">
                        @else
                            <img src="../../../usuario/images/{{$imagemFoto}}" class="img-circle"style="height: 50px; " alt="User Image">
                        @endif
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->apelido }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <ul class="sidebar-menu" data-widget="tree">

                    <li>
                        <a href="/admin/usuario/index">
                            <i class="fa fa-th"></i> <span>Usuários</span>
                            <span class="pull-right-container">
            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('tipo_imovel.index')}}">
                            <i class="fa fa-home"></i> <span>Tipo Imóvel</span>
                            <span class="pull-right-container">
            </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <span>Proprietário</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('admin.proprietario.juridico.index')}}"><i class="fa fa-circle-o"></i> Pessoa Jurídica</a></li>
                            <li><a href="{{route('admin.proprietario.fisico.index')}}"><i class="fa fa-circle-o"></i> Pessoa Física</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span>Imóveis</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('admin.imoveis.aluguel.index')}}"><i class="fa fa-circle-o"></i> Aluguel</a></li>
                            <li><a href="{{route('admin.imoveis.venda.index')}}"><i class="fa fa-circle-o"></i> Venda</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('admin.email.index')}}">
                            <?php
                            $dadosEmails = \Illuminate\Support\Facades\DB::table('email')->select('email.*')->where('email.lido', '=', 0)->count();
                            ?>
                            <i class="fa fa-envelope"></i>
                            <span> Mensagens
                          <span class="label label-danger pull-right">
                              <?php
                              printf($dadosEmails)
                              ?>
                          </span>
                      </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('visita.index')}}">
                            <i class="fa fa-key"></i> <span>Visitas</span>
                            <span class="pull-right-container">
              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-file-pdf-o"></i> <span>Procurações</span>
                            <span class="pull-right-container">
              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-file"></i> <span>Contratos</span>
                            <span class="pull-right-container">
              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-hand-o-up"></i> <span>Autorização</span>
                            <span class="pull-right-container">
              </span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-code-o"></i>
                            <span>Site</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('admin.imoveis.destaque')}}"><i class="fa fa-circle-o"></i> Destaques</a></li>
                            <li><a href="{{route('site.banner')}}"><i class="fa fa-circle-o"></i> Banner Principal</a></li>
                            <li><a href="/admin/corretor"><i class="fa fa-circle-o"></i> Corretores</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
    @elseif($tipoUsuario == 4)

    <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <?php
                        $imagemFoto = \Illuminate\Support\Facades\DB::table('user_imagem')->select('user_imagem.path')->where('user_imagem.user_id', '=', \Illuminate\Support\Facades\Auth::id() )->where('user_imagem.status', '=', true)->value('user_imagem.path');

                        ?>
                        @if($imagemFoto == [])
                            <img src="../admin/dist/img/proprietario.png" class="img-circle" alt="User Image">
                        @else
                            <img src="../../../usuario/images/{{$imagemFoto}}" class="img-circle"style="height: 50px; " alt="User Image">
                        @endif
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->apelido }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <span>Proprietário</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('administrativo.proprietario.juridico.index')}}"><i class="fa fa-circle-o"></i> Pessoa Jurídica</a></li>
                            <li><a href="{{route('administrativo.proprietario.fisico.index')}}"><i class="fa fa-circle-o"></i> Pessoa Física</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span>Imóveis</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('administrativo.imoveis.venda.index')}}"><i class="fa fa-circle-o"></i> Venda</a></li>
                            <li><a href="{{route('administrativo.imoveis.aluguel.index')}}"><i class="fa fa-circle-o"></i> Aluguel</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('administrativovisita.index')}}">
                            <i class="fa fa-key"></i> <span>Visitas</span>
                            <span class="pull-right-container">
              </span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>


    @endif


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Perfil
            </h1>
            <ol class="breadcrumb">

                @if($tipoUsuario == 1)
                        <li><a href="/admin/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Perfil</li>
                @elseif($tipoUsuario == 2)
                        <li><a href="/corretor/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Perfil</li>
                @elseif($tipoUsuario == 3)
                        <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Perfil</li>
                @elseif($tipoUsuario == 4)
                        <li><a href="/administrativo/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Perfil</li>
                @endif



            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <!-- Profile Image -->
                    @foreach($dadosUsuario as $dado)
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="row">
                                @if($imagemFoto == [])
                                    <img class="profile-user-img img-responsive img-circle" src="../../admin/dist/img/proprietario.png" alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-responsive img-circle" src="../../usuario/images/{{$imagemFoto}}" style="height: 100px" alt="User profile picture">
                                @endif

                            </div>


                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Alterar Foto</h4>
                                        </div>

                                        <form method="POST" enctype="multipart/form-data" action="{{route('perfil.foto.store')}}">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="images" class="col-md-2 col-form-label text-md-right">{{ __('Foto') }}</label>

                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <input required type="file" class="form-control" name="images[]" multiple>
                                                        </div>
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
                            <br>


                            <button href="#" class="btn btn-primary col-md-2 col-md-offset-5"  data-toggle="modal" data-target="#modal-default"><b>Alterar Foto</b></button>


                            <br>
                            <br>

                                <h3 class="profile-username text-center">{{$dado->name}}</h3>

                                <p class="text-muted text-center">{{$dado->nomeTipo}}</p>


                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="pull-right">{{$dado->email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Apelido</b> <a class="pull-right">{{$dado->apelido}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>CRECI</b> <a class="pull-right">{{$dado->creci}}</a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-default2"><b>Editar dados</b></a>

                            <div class="modal fade" id="modal-default2">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Alterar Dados</h4>
                                        </div>

                                        <form method="POST" action="{{route('perfil.update')}}">
                                            @csrf

                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <input type="hidden" name="idUsuario" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $dado->name }}" required autocomplete="name" autofocus>

                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="apelido" class="col-md-4 col-form-label text-md-right">{{ __('apelido') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="apelido" type="text" class="form-control @error('apelido') is-invalid @enderror" name="apelido" value="{{ old('apelido') ?? $dado->apelido }}" required autocomplete="apelido" autofocus>

                                                        @error('apelido')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="apelido" class="col-md-4 col-form-label text-md-right">{{ __('CRECI') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="creci" type="text" class="form-control @error('creci') is-invalid @enderror" name="creci" value="{{ old('creci') ?? $dado->creci }}" required autocomplete="CRECI" autofocus>

                                                        @error('creci')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $dado->email }}" required autocomplete="email">

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password"   class="form-control @error('password') is-invalid @enderror" name="password"  >

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
                                                        <input id="password-confirm"   type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{route('admin.usuario.index')}}" class="btn btn-default pull-left" data-dismiss="modal">Sair</a>
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                                @endforeach
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->






    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Versão</b> 1.0
        </div>
        <strong>Copyright &copy; 2019 <a href="https://cod3cafe.com.br">Cod3 Café</a>.</strong> Todos os Direitos Reservados
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/admin/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="/admin/bower_components/raphael/raphael.min.js"></script>
<script src="/admin/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin//bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/admin//bower_components/moment/min/moment.min.js"></script>
<script src="/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/admin/dist/js/demo.js"></script>
@yield('script')
</body>
</html>
