@section('estilo')
  <link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">
  <style>
      .example-modal .modal {
          position: relative;
          top: auto;
          bottom: auto;
          right: auto;
          left: auto;
          display: block;
          z-index: 1;
      }

      .example-modal .modal {
          background: transparent !important;
      }
  </style>
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

        @if(session()->exists('message'))
            <div class="alert {{session()->get('class-color')}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
                {{ session()->get('message') }}
            </div>
            <p class="icon-asterisk"></p>

        @endif
        @foreach($dadosImovel as $dados)
        <div class="panel box box-primary">
            <?php
                $contador = 0;
            ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-yellow">
                                <div class="widget-user-image">
                                    <img class="" style="" src="/font-imobiliaria/png/house-4.png" alt="User Avatar">
                                    <br>
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username"><b>{{$dados->titulo}}</b></h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Responsável: <span class="pull-right badge bg-blue">{{$dados->nomeCorretor}}</span></a></li>
                                    <li><a href="#">Tipo Imóvel <span class="pull-right badge bg-blue">{{$dados->nomeTipo}}</span></a></li>
                                    <li><a href="#">Proprietário <span class="pull-right badge bg-blue">{{$dados->nome}}</span></a></li>
                                    @if($dados->aluguel == 1)
                                        <li><a href="#">Valor Aluguel<span class="pull-right badge bg-blue">R${{$dados->valor_aluguel}},00</span></a></li>
                                    @endif
                                    @if($dados->venda == 1)
                                        <li><a href="#">Valor Venda<span class="pull-right badge bg-blue">R${{$dados->valor_venda}},00</span></a></li>
                                    @endif

                                    @if($dados->impostos == null )
                                    @elseif($dados->impostos !== null)
                                        <li><a href="#">Impostos <span class="pull-right badge bg-blue">R${{$dados->impostos}}</span></a></li>
                                    @endif


                                    @if($dados->endereco == null )
                                    @elseif($dados->endereco !== null)
                                        <li><a href="#">Endereço <span class="pull-right badge bg-red">{{$dados->endereco}}</span></a></li>
                                    @endif


                                    @if($dados->bairro == null )
                                    @elseif($dados->bairro !== null)
                                        <li><a href="#">Bairro <span class="pull-right badge bg-red">{{$dados->bairro}}</span></a></li>
                                    @endif


                                    @if($dados->complemento == null )
                                    @elseif($dados->complemento !== null)
                                        <li><a href="#">Complemento <span class="pull-right badge bg-red">{{$dados->complemento}}</span></a></li>
                                    @endif

                                    @if($dados->cidade == null )
                                    @elseif($dados->cidade !== null)
                                        <li><a href="#">Cidade <span class="pull-right badge bg-red">{{$dados->cidade}}</span></a></li>
                                    @endif


                                    @if($dados->estado == null )
                                    @elseif($dados->estado !== null)
                                        <li><a href="#">Estado <span class="pull-right badge bg-red">{{$dados->estado}}</span></a></li>
                                    @endif

                                    @if($dados->garagem == null )
                                    @elseif($dados->garagem !== null)
                                        <li><a href="#">Garagem <span class="pull-right badge bg-green">{{$dados->garagem}}</span></a></li>
                                    @endif

                                    @if($dados->banheiros == null )
                                    @elseif($dados->banheiros !== null)
                                        <li><a href="#">Banheiros<span class="pull-right badge bg-green">{{$dados->banheiros}}</span></a></li>
                                    @endif



                                    @if($dados->suites == null )
                                    @elseif($dados->suites !== null)
                                        <li><a href="#">Suites<span class="pull-right badge bg-green">{{$dados->suites}}</span></a></li>
                                    @endif
                                    @if($dados->quartos == null )
                                    @elseif($dados->quartos !== null)
                                        <li><a href="#">Quartos<span class="pull-right badge bg-green">{{$dados->quartos}}</span></a></li>
                                    @endif

                                    @if($dados->salas == null )
                                    @elseif($dados->salas !== null)
                                        <li><a href="#">Salas<span class="pull-right badge bg-green">{{$dados->salas}}</span></a></li>
                                    @endif
                                    @if($dados->banheiros == null )
                                    @elseif($dados->banheiros !== null)
                                        <li><a href="#">Banheiros<span class="pull-right badge bg-green">{{$dados->banheiros}}</span></a></li>
                                    @endif
                                    @if($dados->area_total == null )
                                    @elseif($dados->area_total !== null)
                                        <li><a href="#">Área Total<span class="pull-right badge bg-green">{{$dados->area_total}} M²</span></a></li>
                                    @endif
                                    @if($dados->area_util == null )
                                    @elseif($dados->area_util !== null)
                                        <li><a href="#">Área Útil<span class="pull-right badge bg-green">{{$dados->area_util}} M²</span></a></li>
                                    @endif

                                    @if($dados->taxas_extras == null )
                                    @elseif($dados->taxas_extras !== null)
                                        <li><a href="#">Taxa Rateio<span class="pull-right badge bg-green">R${{$dados->taxas_extras}},00</span></a></li>
                                    @endif


                                    @if($dados->contribuicao == null )
                                    @elseif($dados->contribuicao !== null)
                                        <li><a href="#">Contribuição<span class="pull-right badge bg-green">R${{$dados->contribuicao}},00</span></a></li>
                                    @endif

                                    @if($dados->impostos == null )
                                    @elseif($dados->impostos !== null)
                                        <li><a href="#">Imposto<span class="pull-right badge bg-green">R${{$dados->impostos}},00</span></a></li>
                                    @endif

                                    @if($dados->condominio == null )
                                    @elseif($dados->condominio !== null)
                                        <li><a href="#">Condominio<span class="pull-right badge bg-green">R${{$dados->condominio}},00</span></a></li>
                                    @endif
                                    @if($dados->tamanho_frente == null )
                                    @elseif($dados->tamanho_frente !== null)
                                        <li><a href="#">Tamanho Frente<span class="pull-right badge bg-green">{{$dados->tamanho_frente}} M²</span></a></li>
                                    @endif
                                    @if($dados->tamanho_fundo == null )
                                    @elseif($dados->tamanho_fundo !== null)
                                        <li><a href="#">Tamanho Fundo<span class="pull-right badge bg-green">{{$dados->tamanho_fundo}} M²</span></a></li>
                                    @endif
                                    @if($dados->matricula_celpa == null )
                                    @elseif($dados->matricula_celpa !== null)
                                        <li><a href="#">Matricula Celpa<span class="pull-right badge bg-green">{{$dados->matricula_celpa}} </span></a></li>
                                    @endif


                                    @if($dados->matricula_cosanpa == null )
                                    @elseif($dados->matricula_cosanpa !== null)
                                        <li><a href="#">Matricula Cosanpa<span class="pull-right badge bg-green">{{$dados->matricula_cosanpa}} </span></a></li>
                                    @endif

                                @if($dados->ar_condicionado == 1)
                                        <li><a href="#">Ar condicionado<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif
                                    @if($dados->bar == 1)
                                        <li><a href="#">Bar<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif
                                    @if($dados->livraria == 1)
                                        <li><a href="#">Livraria<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->cozinha == 1)
                                        <li><a href="#">Cozinha<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->cozinha_planejada == 1)
                                        <li><a href="#">Cozinha Planejada<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif
                                    @if($dados->churrasqueira == 1)
                                        <li><a href="#">Churrasqueira<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif


                                    @if($dados->cozinha_equipada == 1)
                                        <li><a href="#">Cozinha Equipada<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->cozinha_americana == 1)
                                        <li><a href="#">Cozinha Americanas<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->escritorio == 1)
                                        <li><a href="#">Escritório<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->lavatorio == 1)
                                        <li><a href="#">Lavatório<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->piscina == 1)
                                        <li><a href="#">Piscina<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->despensa == 1)
                                        <li><a href="#">Despensa<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->edicula == 1)
                                        <li><a href="#">Edicula<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->copa == 1)
                                        <li><a href="#">Copa<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->terraco == 1)
                                        <li><a href="#">Terraço<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->quarto_empregada == 1)
                                        <li><a href="#">Quarto Empregada<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->banheiro_empregada == 1)
                                        <li><a href="#">Banheiro Empregada<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->sala_com_lareira == 1)
                                        <li><a href="#">Sala Com Lareira<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif


                                    @if($dados->banheiro_social == 1)
                                        <li><a href="#">Banheiro Social<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->placa == 1)
                                        <li><a href="#">Placa<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->documentado == 1)
                                        <li><a href="#">Documentado<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->exclusividade == 1)
                                        <li><a href="#">Exclusividade<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif


                                    @if($dados->cerca_eletrica == 1)
                                        <li><a href="#">Cerca Elétrica<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->poco_artesiano == 1)
                                        <li><a href="#">Poço Artesiano<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->portao_eletronico == 1)
                                        <li><a href="#">Portão Eletrônico<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->concertina == 1)
                                        <li><a href="#">Concertina<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->elevador == 1)
                                        <li><a href="#">Elevador<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif

                                    @if($dados->interfone == 1)
                                        <li><a href="#">Interfone<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif





                                    @if($dados->sala_com_lareira == 1)
                                        <li><a href="#">Sala Com Lareira<span class="pull-right badge bg-green">Sim</span></a></li>
                                    @endif


                                </ul>
                            </div>
                        </div>
                            <div class="box box-warning ">
                                <div class="box-header with-border">
                                    <i class="fa fa-text-width"></i>

                                    <h3 class="box-title">Descrição</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p style="text-align: justify-all"><?php printf($dados->descricao)?></p>
                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        <div class="box box-warning ">
                            <div class="box-header with-border">
                                <i class="fa fa-image"></i>

                                <h3 class="box-title">Imagens</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-dark">
                                    <tr>
                                        <th style="width: 10%">#</th>
                                        <th>Nome</th>
                                        <th style="width: 10%">Principal</th>
                                        <th style="width: 10%">-</th>
                                    </tr>
                                    @foreach($imagensImoveis as $imagem)
                                        <tr>
                                            <td>{{$imagem->id}}</td>
                                            <td>
                                                <img src="{{ URL::to('/') }}/imovel/images/{{ $imagem->path }}" class="img-thumbnail" width="90"/>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    @if($imagem->principal == 1)
                                                    <div class="col-md-12">
                                                        <a type="button" href="{{route('admin.imoveis.venda.imagem.principal.desativar', ['id' => $imagem->id])}}" class=" btn btn-block btn-success"><span class="fa fa-check"></span></a>
                                                    </div>
                                                    @else
                                                        <div class="col-md-12">
                                                            <a type="button" href="{{route('admin.imoveis.venda.imagem.principal.ativar', ['id' => $imagem->id])}}" class="btn btn-warning btn-block"><span class="fa  fa-times"></span></a>
                                                        </div>
                                                    @endif
                                                </div>

                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a type="button" href="{{route('admin.imoveis.venda.imagem.principal.delete', ['id' => $imagem->id])}}" class="btn btn-block btn-danger"><span class="fa fa-trash"></span></a>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>


                                </div>
                            <!-- /.box-body -->
                        </div>

                        <div class="box box-success ">
                            <div class="box-header with-border">
                                <i class="fa fa-image"></i>

                                <h3 class="box-title">Adicionar Imagens</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form action="{{route('admin.imoveis.venda.imagem.store')}}" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="imovel_id" value="{{$dados->idImovel}}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Inserir Imagem</label>
                                            <input required type="file" class="form-control" name="images[]" multiple>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="box-footer">
                                            <button  type="submit" class="btn btn-primary col-md-10">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                </div>

                    <div class="col-md-4">
                        <div class="row">

                            <div id="carousel-example-generic" class="carousel slide col-md-12" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    @for($contador =0; $contador > $contador1; $contador+1){
                                    @if($contador == 0)
                                        <li data-target="#carousel-example-generic" data-slide-to="{{$contador}}" class="active"></li>
                                    @endif
                                    <li data-target="#carousel-example-generic" data-slide-to="{{$contador}}" class=""></li>


                                    @endfor
                                </ol>
                                <?php
                                $contador2 = 0;
                                ?>
                                <div class="carousel-inner">
                                    @foreach($imagensImoveis as $active)
                                        @if($contador2 == 0)
                                            <div class="item active">
                                                <img src="{{ URL::to('/') }}/imovel/images/{{ $active->path }}" alt="First slide">
                                            </div>
                                            <?php
                                            $contador2 = 1;
                                            ?>
                                        @elseif($contador2 !== 0)
                                            <div class="item">
                                                <img src="{{ URL::to('/') }}/imovel/images/{{ $active->path }}" alt="Second slide">
                                            </div>
                                            <?php
                                            $contador2 = $contador2 +1;
                                            ?>
                                        @endif


                                    @endforeach
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                                <br>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><img class="" style="width: 80%" src="/font-imobiliaria/png/house.png" alt="User Avatar">
                                    </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Área Total</span>
                                        <span class="info-box-number">{{$dados->area_total}} M²</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><img class="" style="width: 80%" src="/font-imobiliaria/png/location.png" alt="User Avatar"></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Cidade/Estado</span>
                                        <span class="info-box-number">Santarém/Pá</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <div class="info-box">
                                    <span class="info-box-icon bg-blue"><i class="fa fa-flag-o"></i></span>

                                    @if($dados->aluguel == 1)
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tipo de Transação</span>
                                        <span class="info-box-number">Aluguel</span>
                                    </div>
                                    @endif

                                    @if($dados->venda == 1)
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tipo de Transação</span>
                                            <span class="info-box-number">Venda</span>
                                        </div>
                                @endif
                                    <!-- /.info-box-content -->
                                </div>

                                <button type="button" class="btn btn-info col-md-12" data-toggle="modal" data-target="#modal-default" >
                                    Adicionar Visita
                                </button>

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
                                            <form method="POST" action="{{ route('visita.store') }}">
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
                                                    <input type="hidden" name="imovel_id" value="{{$dados->id}}">
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
                                <!-- /.modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
