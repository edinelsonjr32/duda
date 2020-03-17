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
                <li><a href="/home"><i class="fa fa-dashboard"></i> Corretor</a></li>
                <li class="active">Inicio</li>
            </ol>
        </section>

        <!-- Main content -->

        <section class="content">
            <!-- Small boxes (Stat box) -->

            <!-- /.row -->
            <!-- Main row -->
            @if(session()->exists('message'))
                <div class="alert {{session()->get('class-color')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
                    <h4>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;"></font></font>
                    </h4>
                    {{ session()->get('message') }}
                </div>
                <p class="icon-asterisk"></p>

            @endif

            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <div class="box box-success">
                        <div class="box-header">
                            <i class="fa fa-comments-o"></i>

                            <h3 class="box-title">Home</h3>
                            <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                                <div class="btn-group" data-toggle="btn-toggle">
                                    <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="box-body chat" id="chat-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-aqua-active">

                                        </div>
                                        <div class="widget-user-image">
                                            <?php
                                            $imagemFoto = \Illuminate\Support\Facades\DB::table('user_imagem')->select('user_imagem.path')->where('user_imagem.user_id', '=', \Illuminate\Support\Facades\Auth::id() )->where('user_imagem.status', '=', true)->value('user_imagem.path');

                                            ?>
                                            @if($imagemFoto == [])
                                                <img class="img-circle" src="../../admin/dist/img/proprietario.png" alt="User Avatar">
                                            @else
                                                <img class="img-circle" src="../../usuario/images/{{$imagemFoto}}" style="height: 90px" alt="User Avatar">
                                            @endif
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">

                                                <div class="col-sm-4 col-md-offset-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                                                        <span class="description-text">Corretor</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>

                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                    <!-- /.widget-user -->
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="box box-warning">
                                        <div class="box-header">
                                            <h3 class="box-title">Visitas do dia</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body box-success">
                                            @if($minhasVisitas == '[]')
                                                Sem visitas para hoje
                                            @elseif($minhasVisitas !== '[]')
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 40%">Corretor</th>
                                                        <th style="width: 10%">Data</th>
                                                        <th style="width: 10%">Hora</th>
                                                        <th style="width: 5%">-</th>
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
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <a  class=" btn btn-block btn-info" href="{{route('corretorvisita.show', $dado->id)}}"><span class="fa fa-eye"></span></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                                {{$minhasVisitas->links()}}
                                            @endif
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->


                                    <!-- /.box -->
                                </div>


                                <div class="col-lg-12 col-xs-12">
                                    <!-- small box -->
                                    <div class="small-box bg-lime">
                                        <div class="inner">
                                            <h3> <br></h3>
                                            <p>Visitas</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <a href="{{route('corretorvisita.index')}}" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.chat -->
                        <div class="box-footer">

                        </div>
                    </div>


                </section>

            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



@endsection

