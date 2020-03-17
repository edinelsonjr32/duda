@section('estilo')
    <link rel="stylesheet" href="../../../../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../../../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../../dist/css/skins/_all-skins.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../../../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/decoupled-document/ckeditor.js"></script>


@endsection
@extends('autorizacao.layout')


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Autorização</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin/index"><i class="fa fa-dashboard"></i> Administrador</a></li>
                <li class="active"> <i class="fa fa-user"></i>  Imoveis</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <form method="POST" action="/autorizacao/locacao/salvar">
                    @csrf

                    <div class="col-xs-12">

                        <div class="box box-info">


                                <div class="box-header">
                                    <h3 class="box-title">Editor de Procuração
                                    </h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                                                title="Collapse">
                                            <i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                                title="Remove">
                                            <i class="fa fa-times"></i></button>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                        @csrf
                                        <div id="toolbar-container"></div>
                                    <input type="hidden" name="idProprietario" value="{{$dadosProprietario->id}}">
                                    <input type="hidden" name="taxa" value="{{$dadosAutorizacao->taxa}}">
                                    <input type="hidden" name="taxa2" value="{{$dadosAutorizacao->taxa2}}">
                                    <input type="hidden" name="taxa3" value="{{$dadosAutorizacao->taxa3}}">
                                    <input type="hidden" name="dataInicio" value="{{$dadosAutorizacao->dataInicio}}">
                                    <input type="hidden" name="dataFim" value="{{$dadosAutorizacao->dataFim}}">

                                    @foreach($imoveisAutorizacaoLocacao as $key => $value)
                                        <input type="hidden" name="imovel[{{$key}}]">
                                    @endforeach
                                    <textarea name="texto" rows="80" cols="192">
                                        <div style="text-align: justify">
                                            <p style="text-align: center"><b>CONTRATO DE PRESTAÇÃO DE SERVIÇOS PARA INTERMEDIAÇÃO DE LOCALIZAÇÃO E ADMINISTRAÇÃO DE IMÓVEL COM EXCLUSIVIDADE.</b></p>


                                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Celebram o presente contrato de exclusividade para intermedia&ccedil;&atilde;o e administra&ccedil;&atilde;o de im&oacute;veis, CONTRATANTE E CONTRATADA, abaixo indicados, como abaixo melhor se declara:</font></font></p>

                                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><b>DADOS DO CONTRATO</b></font></font></p>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1 - CONTRATANTE</font></font></p>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1.1&ndash; </font></font><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CONTRATANTE: </font></font></strong><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{$dadosProprietario->nome}},</font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{$dadosProprietario->nacionalidade}}, @if($dadosProprietario->estado_civil == 1) CASADO, @elseif($dadosProprietario->estado_civil == 2) DIVORCIADO, @elseif($dadosProprietario->estado_civil == 3) VIÚVO, @elseif($dadosProprietario->estado_civil == 4) SOTEIRO, @elseif($dadosProprietario->estado_civil == 5) UNIÃO ESTÁVEL, @endif empres&aacute;rio, inscrito no CPF / MF sob o n&ordm; {{$dadosProprietario->cpf}} e portador da C&eacute;dula de Identidade n&ordm; {{$dadosProprietario->rg}} {{$dadosProprietario->orgao_emissor}}, residente e domiciliado em {{$dadosProprietario->cidade}} - {{$dadosProprietario->estado}} na </font></font><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{$dadosProprietario->rua}} {{$dadosProprietario->numero_casa}}, CEP: {{$dadosProprietario->cep}}</font></font></strong>.</p>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1.2 - </font></font><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CONTRATADA</font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> : </font></font><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">M DE JUDA B ALEXANDRE LTDA</font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ., Pessoa jur&iacute;dica com sede nesta cidade, na Av. </font><font style="vertical-align: inherit;">S&atilde;o Sebasti&atilde;o, n&ordm; 2632, Bairro F&aacute;tima, inscrito no CRECI n&ordm; F 401 12&ordf; Regi&atilde;o PA / PA e n&ordm; CNPJ n&ordm; 13.053.532.0001-39, atualmente representado por: </font></font><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Maria de Jesus DUDA BARROSO ALEXANDRE</font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> , Brasileira, casada, ADVOGADA E CORRETORA DE IM&Oacute;VEIS, portadora de C&eacute;dulas de Identidades Profissionais n.&ordm; 10.433 OAB-PA; </font><font style="vertical-align: inherit;">CRECI 12&ordf; REGI&Atilde;O PA / AP N&ordm; F - 3418; </font><font style="vertical-align: inherit;">e, seu PROCURADOR BASTANTE, </font></font><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">JOS&Eacute; ALEXANDRE FILHO</font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">, brasileiro, casado, advogado e CORRETOR DE IM&Oacute;VEIS, portador de C&eacute;dulas de Identidade n.&ordm; 11.032 OAB-PA; </font><font style="vertical-align: inherit;">CRECI 12&ordf; REGI&Atilde;O PA / AP F 03930, com amplos e amplos recursos conforme INSTRUMENTO PROCURAT&Oacute;RIO, ambos residentes e domiciliados nesta cidade, podendo assinar em conjunto ou isoladamente.</font></font></p>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2 - OBJETO DO CONTRATO</font></font></p>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.1 - O presente contrato tem por objeto a loca&ccedil;&atilde;o e administra&ccedil;&atilde;o de im&oacute;veis de propriedade do (a) CONTRATANTE, abaixo discriminado.</font></font></p>

                                            <p style="text-align: center"><b>

                                            @foreach($imoveisAutorizacaoLocacao as $key => $value)
                                                        <input type="hidden" name="imovel[{{$key}}]">
                                                        <?php
                                                        $dados = \Illuminate\Support\Facades\DB::table('imovel')->select('imovel.*')->where('imovel.id', '=', $key)->get();
                                                        ?>
                                                        <ul>
		                                            @foreach($dados as $dado)
                                                                <li>
                                                            <B>Endereço: {{$dado->endereco}}, n° {{$dado->numero}}, {{$dado->complemento}}, Bairro : {{$dado->bairro}}, CEP: {{$dado->cep}}, na cidade de : {{$dado->cidade}} - {{$dado->estado}}. Medindo {{$dado->tamanho_frente}}x{{$dado->tamanho_fundo}} de terreno, área construida: {{$dado->area_util}}.</B>
                                                        </li>
                                                            @endforeach
                                                </ul>
                                            @endforeach
                                                </b>
                                            </p>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.2 - O (A) CONTRATANTE declara que o im&oacute;vel acima listado est&aacute; livre e desimpedido para um fim de destino.</font></font></p>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.3 - Na forma do artigo 22, IV, da Lei 8.245 / 91, O (A) CONTRATANTE </font></font><strong><em><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">&eacute; respons&aacute;vel exclusiva por defeitos e / ou v&iacute;cios ocultos no im&oacute;vel, preexistentes &agrave; loca&ccedil;&atilde;o, devendo usar como suas despesas ou reparos no prazo mais curto poss&iacute;vel , respondendo por eventuais danos causados ​​pela sua omiss&atilde;o</font></font></em></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> .</font></font></p>

<p>2.4 - O (A) CONTRATANTE declara que o im&oacute;vel, passagem, rua ou avenida em que est&aacute; localizado atualmente n&atilde;o sofre com alagamentos, fica isento de CONTRATADA de qualquer responsabilidade em caso de omiss&atilde;o.</p>

<p>2.5 - Apenas os direitos e obriga&ccedil;&otilde;es dispostas neste contrato de contrato &agrave; CONTRATADA.</p>

<p><strong>3 - DO VALOR DO ALUGUEL</strong></p>

<p>3.1 - O valor do aluguel ser&aacute; conforme descri&ccedil;&atilde;o abaixo:</p>

                                            <p style="text-align: center"><b>

                                            @foreach($imoveisAutorizacaoLocacao as $key => $value)
                                                        <input type="hidden" name="imovel[{{$key}}]">
                                                        <?php
                                                        $dados = \Illuminate\Support\Facades\DB::table('imovel')->select('imovel.*', 'tipo_imovel.nome')->join('tipo_imovel', 'tipo_imovel.id', '=', 'imovel.tipo_imovel')->where('imovel.id', '=', $key)->get();
                                                        ?>
                                                        <ul>
                                                            @foreach($dados as $dado)
                                                                <li>
                                                                    <B>Descrição do Imóvel : </B> {{$dado->nome}}, composta por
                                                                    @if($dado->quartos == [])

                                                                    @else
                                                                        @if($dado->quartos == 1)
                                                                            {{$dado->quartos}} QUARTO,
                                                                        @elseif($dado->quartos == 0)
                                                                        @else
                                                                            {{$dado->quartos}} QUARTOS,
                                                                        @endif
                                                                    @endif

                                                                    @if($dado->banheiros == [])

                                                                    @else
                                                                        @if($dado->banheiros == 1)
                                                                            {{$dado->banheiros}} BANHEIRO,
                                                                        @elseif($dado->banheiros == 0)

                                                                        @else
                                                                            {{$dado->banheiros}} BANHEIROS,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->suites == [])

                                                                    @else
                                                                        @if($dado->suites == 1)
                                                                            {{$dado->suites}} SUITE,
                                                                        @elseif($dado->suites == 0)

                                                                        @else
                                                                            {{$dado->suites}} SUITES,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->garagem == [])

                                                                    @else
                                                                        @if($dado->garagem == 1)
                                                                            GARAGEM,
                                                                        @elseif($dado->garagem == 0)

                                                                        @else
                                                                            {{$dado->garagem}} GARAGENS,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->ar_condicionado == [])

                                                                    @else
                                                                        @if($dado->ar_condicionado == 1)
                                                                            {{$dado->ar_condicionado}} CENTRAL DE AR,
                                                                        @elseif($dado->ar_condicionado == 0)

                                                                        @else
                                                                            {{$dado->ar_condicionado}} CENTRAIS DE AR,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->churrasqueira == [])

                                                                    @else
                                                                        @if($dado->churrasqueira == 1)
                                                                            CHURRASQUEIRA,
                                                                        @elseif($dado->churrasqueira == 0)

                                                                        @else
                                                                            {{$dado->churrasqueira}} CHURRASQUEIRAS,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->cozinha_equipada == [])

                                                                    @else
                                                                        @if($dado->cozinha_equipada == 1)
                                                                            COZINHA EQUIPADA,
                                                                        @elseif($dado->cozinha_equipada == 0)

                                                                        @else
                                                                            {{$dado->cozinha_equipada}} COZINHAS EQUIPADAS,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->mobiliado == [])

                                                                    @else
                                                                        @if($dado->mobiliado == 1)
                                                                            MOBILIADO,
                                                                        @elseif($dado->mobiliado == 0)

                                                                        @else
                                                                            {{$dado->mobiliado}} MOBILIADO,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->tamanho_frente == [])

                                                                    @else
                                                                        @if($dado->tamanho_frente == 1)
                                                                            1 M² de fundo,
                                                                        @elseif($dado->tamanho_frente == 0)

                                                                        @else
                                                                            {{$dado->tamanho_frente}} M² de frente,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->tamanho_fundo == [])

                                                                    @else
                                                                        @if($dado->tamanho_fundo == 1)
                                                                            1 M² de fundo,
                                                                        @elseif($dado->tamanho_fundo == 0)

                                                                        @else
                                                                            {{$dado->tamanho_fundo}} M² de fundo,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->escritorio == [])

                                                                    @else
                                                                        @if($dado->escritorio == 1)
                                                                            ESCRITÓRIO,
                                                                        @elseif($dado->escritorio == 0)

                                                                        @else
                                                                            {{$dado->escritorio}} ESCRITÓRIOS,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->lavatorio == [])

                                                                    @else
                                                                        @if($dado->lavatorio == 1)
                                                                            LAVATÓRIO,
                                                                        @elseif($dado->lavatorio == 0)

                                                                        @else
                                                                            {{$dado->lavatorio}} LAVATÓRIOS,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->piscina == [])

                                                                    @else
                                                                        @if($dado->piscina == 1)
                                                                            PISCINA,
                                                                        @elseif($dado->piscina == 0)

                                                                        @else
                                                                            {{$dado->piscina}} PISCINAS,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->quarto_empregada == [])

                                                                    @else
                                                                        @if($dado->quarto_empregada == 1)
                                                                            QUARTO EMPREGADA,
                                                                        @elseif($dado->quarto_empregada == 0)

                                                                        @else
                                                                            {{$dado->quarto_empregada}} QUARTOS EMPREGADA,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->banheiro_empregada == [])

                                                                    @else
                                                                        @if($dado->banheiro_empregada == 1)
                                                                            BANHEIRO EMPREGADA,
                                                                        @elseif($dado->banheiro_empregada == 0)

                                                                        @else
                                                                            {{$dado->banheiro_empregada}} BANHEIROS EMPREGADA,
                                                                        @endif

                                                                    @endif
                                                                    @if($dado->banheiro_social == [])

                                                                    @else
                                                                        @if($dado->banheiro_social == 1)
                                                                            BANHEIRO SOCIAL,
                                                                        @elseif($dado->banheiro_social == 0)

                                                                        @else
                                                                            {{$dado->banheiro_social}} BANHEIROS SOCIAIS,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->cerca_eletrica == [])

                                                                    @else
                                                                        @if($dado->cerca_eletrica == 1)
                                                                            CERCA ELÉTRICA,
                                                                        @elseif($dado->cerca_eletrica == 0)

                                                                        @else
                                                                            {{$dado->cerca_eletrica}} CERCAS ELÉTRICAS,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->portao_eletronico == [])

                                                                    @else
                                                                        @if($dado->portao_eletronico == 1)
                                                                            PORTÃO ELETRÓNICO,
                                                                        @elseif($dado->portao_eletronico == 0)

                                                                        @else
                                                                            {{$dado->portao_eletronico}} PORTÃO ELETRÓNICO,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->elevador == [])

                                                                    @else
                                                                        @if($dado->elevador == 1)
                                                                            ELEVADOR,
                                                                        @elseif($dado->elevador == 0)

                                                                        @else
                                                                            {{$dado->elevador}} ELEVADOR,
                                                                        @endif

                                                                    @endif


                                                                    @if($dado->escada == [])

                                                                    @else
                                                                        @if($dado->escada == 1)
                                                                            ESCADA,
                                                                        @elseif($dado->escada == 0)

                                                                        @else
                                                                            {{$dado->escada}} ESCADA,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->interfone == [])

                                                                    @else
                                                                        @if($dado->interfone == 1)
                                                                            INTERFONE,
                                                                        @elseif($dado->interfone == 0)

                                                                        @else
                                                                            {{$dado->interfone}} INTERFONE,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->cozinha_planejada == [])

                                                                    @else
                                                                        @if($dado->cozinha_planejada == 1)
                                                                            COZINHA PLANEJADA,
                                                                        @elseif($dado->cozinha_planejada == 0)

                                                                        @else
                                                                            {{$dado->cozinha_planejada}} COZINHA PLANEJADA,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->cozinha == [])

                                                                    @else
                                                                        @if($dado->cozinha == 1)
                                                                            COZINHA,
                                                                        @elseif($dado->cozinha == 0)

                                                                        @else
                                                                            {{$dado->cozinha}} COZINHA,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->area_util == [])

                                                                    @else
                                                                        @if($dado->area_util == 1)
                                                                            ÁREA ÚTIL,
                                                                        @elseif($dado->area_util == 0)

                                                                        @else
                                                                            {{$dado->area_util}} M² DE ÁREA ÚTIL,
                                                                        @endif

                                                                    @endif

                                                                    @if($dado->area_total == [])

                                                                    @else
                                                                        @if($dado->area_total == 1)
                                                                            {{$dado->area_total}} M² DE ÁREA TOTAL,
                                                                        @elseif($dado->area_total == 0)

                                                                        @else
                                                                            {{$dado->area_total}} M² DE ÁREA TOTAL,
                                                                        @endif

                                                                    @endif
                                                                    <ul>
                                                                        <li>
                                                                            O valor do aluguel será: <b>R$ {{number_format($dado->valor_aluguel, 2, ',', '.')}}</b>, autorizado pelo contratante, podendo fazer os reajustes previstos na legislação em vigor.
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                            @endforeach
                                                </b>
                                            </p>
<p><strong>4 - DESTINA&Ccedil;&Atilde;O</strong></p>

<p>4.1 - O im&oacute;vel pode ser localizado para <strong>FINS RESIDENCIAIS conforme</strong> (art. 46 e 47 da Lei 8.245 / 91) <strong>.</strong></p>

<p><strong>5 - EXCLUSIVIDADE</strong></p>

<p>5.1 - A (O) CONTRATANTE concede &agrave; <strong>CONTRATADA EXCLUSIVIDADE</strong> para intermedia&ccedil;&atilde;o de loca&ccedil;&atilde;o imobili&aacute;ria mencionada no item 2.1.</p>

<p><strong>6 - PRAZO</strong></p>

<p>6.1 - O presente contrato de <strong>AUTORIZA&Ccedil;&Atilde;O DE LOCALIZA&Ccedil;&Atilde;O</strong> celebrado entre <strong>propriet&aacute;rios</strong> e <strong>IMOBILI&Aacute;RIOS M DE JUDA B ALEXANDRE LTDA - ME</strong> , ter&aacute; prazo renovado automaticamente, salvo cancelamento expresso pelo fornecedor (a), QUE DEVER&Aacute; COMUNICAR UM CONTRADO PELO MENOS 30 (TRINTA) DIAS DE ANTECED&Ecirc;NCIA, sem multa para partes, o mesmo se aplica a contrato, A APRESENTE AUTORIZA&Ccedil;&Atilde;O DE LOCALIZA&Ccedil;&Atilde;O N&Atilde;O ENVOLVE OS LOCAT&Aacute;RIOS, APENAS PROPRIET&Aacute;RIO E IMOBILIARIA.</p>

<p><strong>7 - VALORES DOS SERVI&Ccedil;OS</strong></p>

<p>7.1 - (O) A CONTRATANTE pagar&aacute; CONTRATADA, pelos servi&ccedil;os prestados, pelos valores correspondentes a:</p>

<p>a) <strong>HONOR&Aacute;RIO PELA LOCA&Ccedil;&Atilde;O</strong> : <strong>A CONTRATADA gera apenas {{$dadosAutorizacao->taxa}}% (cem por cento) do primeiro m&ecirc;s de aluguel, desde que efetue a loca&ccedil;&atilde;o do im&oacute;vel referido</strong> , ou qual ser&aacute; o uso inicial no contrato. Ou seja, se os dados do in&iacute;cio de nossa administra&ccedil;&atilde;o ou im&oacute;vel j&aacute; tiverem sido localizados, os honor&aacute;rios n&atilde;o ser&atilde;o devidos.</p>

<p><strong>PAR&Aacute;GRAFO &Uacute;NICO:</strong> Nenhum caso de recupera&ccedil;&atilde;o de aluguel com o mesmo locat&aacute;rio, ou honor&aacute;rio pela loca&ccedil;&atilde;o gerado apenas pelo valor correspondente a {{$dadosAutorizacao->taxa2}}% (Cinquenta por Cento) do primeiro m&ecirc;s de aluguel.</p>

<p><strong>b) ADMINISTRA&Ccedil;&Atilde;O:</strong> o valor correspondente a <strong>{{$dadosAutorizacao->taxa3}}% (dez por cento) sobre o aluguel recebido suas atualiza&ccedil;&otilde;es e multas contratuais</strong> . A CONTRATADA somente recebe ou recebe o valor da administra&ccedil;&atilde;o do caso ou aluguel. <strong><em>Para efeito de c&aacute;lculo, os impostos que tratam este par&aacute;grafo tamb&eacute;m incidem sobre os encargos do aluguel, como multa, juros e atualiza&ccedil;&otilde;es.</em></strong></p>

<p>7.2 - Os valores acima descritos devem ser descontados dos cr&eacute;ditos a serem repassados ​​(a) CONTRATANTE, por ocasi&atilde;o do repasse.</p>

<p><strong>8 - OBRIGACOES DA CONTRATADA</strong></p>

<p>8.1 - Para os im&oacute;veis que chegaram a um local, a CONTRATADA estar&aacute; obrigada a:</p>

<p>a) <strong>PUBLICIDADE:</strong> Realize uma oferta p&uacute;blica do im&oacute;vel sempre que houver necessidade, devendo tanto promover a sua divulga&ccedil;&atilde;o, use placa / adesivo no im&oacute;vel, anunci&aacute;-lo nos jornais locais de grande circula&ccedil;&atilde;o, public&aacute;-lo no seu site na Internet ou em outros sites relacionados, bem como promover a divulga&ccedil;&atilde;o por outros meios legais que julgar convenientes. Os custos de publicidade correr por conta da CONTRATADA, salvo ou disposto na cl&aacute;usula 12 (Rescis&atilde;o).</p>

<p>b) <strong>AN&Aacute;LISE CADASTRAL:</strong> proceder &agrave; avalia&ccedil;&atilde;o e sele&ccedil;&atilde;o posterior dos inqu&eacute;ritos de acordo com sua experi&ecirc;ncia, aceitando ou recusando cadastros.</p>

<p>c) <strong>VISTORIA: realize</strong> um exame de vista sempre que localize um im&oacute;vel, que fa&ccedil;a parte integrante do contrato, descrevendo o estado de conserva&ccedil;&atilde;o do im&oacute;vel e seus acess&oacute;rios <strong>. O im&oacute;vel encontrando-se semi-mobiliado, devendo uma rela&ccedil;&atilde;o de m&oacute;veis integrada ou laudo de visita. (O) A CONTRATATANTE declara estar ciente de que o inquilino &eacute; respons&aacute;vel pela conserva&ccedil;&atilde;o do im&oacute;vel enquanto o mesmo estiver alugado, n&atilde;o est&aacute; autorizado a CONTRATADA respons&aacute;vel por tal conserva&ccedil;&atilde;o.</strong></p>

<p>d) <strong>CONTRATO</strong> : elaborar o Contrato de loca&ccedil;&atilde;o, tend&atilde;o Liberdade para estipular cl&aacute;usulas contratuais e condi&ccedil;&otilde;es, Tais Como prazos, Multas POR atraso e rescis&oacute;rias, foros, cl&aacute;usulas arbitrais, devendo enviar Uma via original &eacute; Propriet&aacute;rio ao (a) assinada.</p>

<p>e) <strong>GARANTIA LOCAT&Iacute;CIA: solicitar</strong> , um crit&eacute;rio, uma das garantias locais aplic&aacute;veis ​​na legisla&ccedil;&atilde;o em vigor (art. 37 da Lei 8.245 / 91), <strong>sem que isso implique transfer&ecirc;ncia de</strong></p>

<p><strong>Responsabilidade por CONTRATADA decorrente de inadimpl&ecirc;ncia do LOCAT&Aacute;RIO e seus garantidores.</strong></p>

<p>f <strong>) PAGAMENTO (REPASSE DO ALUGUEL): repassar os valores recebidos (al&iacute;quotas) at&eacute; 05 (cinco) dias &uacute;teis ap&oacute;s o cr&eacute;dito em sua conta corrente atrav&eacute;s de transfer&ecirc;ncia banc&aacute;ria e ser executada na conta discriminada a seguir: FAVORECIDO (A): {{$dadosProprietario->nome}} </strong><strong>; {{$dadosProprietario->banco}}, AG&Ecirc;NCIA: {{$dadosProprietario->agencia}}</strong>&nbsp;<strong>CONTA / CORRENTE: </strong><strong>{{$dadosProprietario->conta}}, CPF: {{$dadosProprietario->cpf}}.</strong></p>

<p>g) <strong>APRESENTA&Ccedil;&Atilde;O DE CONTAS:</strong> prestar contas dos valores recebidos, emitido para este relat&oacute;rio discriminado demonstrando os valores recebidos e descontos legais, pelo menos 01 (uma) vez por m&ecirc;s, ou sempre que solicitado, sem prazo m&aacute;ximo de 48 (e oito) horas &uacute;teis.</p>

<p><strong>9 - INADIMPL&Ecirc;NCIA </strong></p>

<p>9.1 - Em conformidade com o c&oacute;digo de defesa do consumidor, a CONTRATADA assume a responsabilidade de (a) CONTRATANTE, <strong>OBRIGA&Ccedil;&Atilde;O DE MEIO</strong> e n&atilde;o de fim. Neste sentido, <strong>os servi&ccedil;os prestados pela CONTRATADA ao (a) CONTRATANTE N&Atilde;O ABRANGEM A GARANTIA DOS ALUGUEIS, no caso de inadimpl&ecirc;ncia ou qualquer outra ocorr&ecirc;ncia decorrente do contrato de loca&ccedil;&atilde;o, como manuten&ccedil;&atilde;o e conserva&ccedil;&atilde;o do im&oacute;vel</strong> . No entanto, fica CONTRATADA desde j&aacute; autorizada a promover, em nome dos (a) CONTRATANTE, todas as medidas extrajudiciais e judiciais solicitadas para receber os cr&eacute;ditos de contrato de loca&ccedil;&atilde;o. <strong>Caso uma inadimpl&ecirc;ncia n&atilde;o seja resolvida atrav&eacute;s de medidas extrajudiciais, e seja de interesse de (a) s CONTRATANTES, que CONTRATADA entre com medidas judiciais aplicadas,</strong>ficar com carga de CONTRATADA de custos com assessoria jur&iacute;dica para casos de vendas de contratos de loca&ccedil;&atilde;o firmados ou intermedi&aacute;rios de CONTRATADA e com os (a) CONTRATANTES de custos com custas e emolumentos judiciais de acordo com o processo processual e honor&aacute;rios de sucumb&ecirc;ncia. Uma garantia de alugueis poder&aacute; ser executada pela liberalidade da CONTRATADA, mesmo que prolongada, sem representante em uma obriga&ccedil;&atilde;o cont&iacute;nua e efetiva, salvo estipula&ccedil;&atilde;o indicada no contrato, ficando vedada a concord&acirc;ncia verbal ou t&aacute;cita. <strong>Entretanto, nos casos em que os im&oacute;veis administrados n&atilde;o foram localizados pela CONTRATADA, os honor&aacute;rios advocat&iacute;cios ser&atilde;o cobrados a parte.</strong></p>

<p><strong>10 - OBRIGA&Ccedil;&Otilde;ES DO (A) CONTRATANTE</strong></p>

<p>10.1 - (O) CONTRATANTE tem por obriga&ccedil;&otilde;es:</p>

<p>uma). Manter <strong>uma posse, guarda e conserva&ccedil;&atilde;o do im&oacute;vel enquanto estiver desmarcado</strong> , n&atilde;o ficar&aacute; CONTRATADO respons&aacute;vel por eventuais danos causados ​​por terceiros, salvo se praticados diretamente por seus funcion&aacute;rios.</p>

<p>b) Retirar e executar o pagamento das contas inclu&iacute;das no im&oacute;vel, tais como taxas, energia, &aacute;gua e condom&iacute;nio, bem como realizar uma manuten&ccedil;&atilde;o e limpeza no im&oacute;vel, enquanto o mesmo estiver desocupado, puder usar essas atividades usadas pela CONTRATADA (IMOBILI&Aacute;RIA), n&atilde;o implicando transfer&ecirc;ncia de tais exig&ecirc;ncias. O IPTU poder&aacute; ser pago pelos (a) LOCAT&Aacute;RIOS, CONFORME CL&Aacute;USULAS CONTRATUAIS, enquanto o im&oacute;vel estiver ocupado pelos mesmos. <strong>Registre uma carga da CONTRATADA, uma verifica&ccedil;&atilde;o da impress&atilde;o e entrega do carn&ecirc; de pagamento do IPTU pela prefeitura, bem como</strong> caso haja algum imprevisto e os&nbsp;mesmo que n&atilde;o consiga imprimir, solicite a CONTRATADA formalmente ou envie e imprima o mesmo.</p>

<p>c) <strong>SEGURO CONTRA INC&Ecirc;NDIO:</strong> capturar uma carga <strong>exclusiva</strong> do (a) <strong>CONTRATANTE na contrata&ccedil;&atilde;o, pagamento e renova&ccedil;&atilde;o do seguro contra inc&ecirc;ndio</strong> , mesmo que contratualmente ou solicite a solicita&ccedil;&atilde;o de um agradecimento pela realiza&ccedil;&atilde;o ou ressarcimento do seguro da mesma. Nesta hip&oacute;tese, o (a) CONTRATANTE deve informar por escrito a CONTRATADA os valores despendidos com o seguro, sempre que ocorrer.</p>

<p>d) <strong>ENERGIA, TELEFONE, INTERNET, TV A CABO (desligamento):</strong> o im&oacute;vel deve ser entregue com energia, telefone, TV a cabo (sat&eacute;lite), internet e outros servi&ccedil;os, desativados e sem d&eacute;bitos.</p>

<p>e) &Eacute; de responsabilidade &uacute;nica e exclusiva do (a) <strong>CONTRATANTE</strong> manter ou custear (caso haja necessidade) a adequa&ccedil;&atilde;o t&eacute;cnica e a seguran&ccedil;a das instala&ccedil;&otilde;es el&eacute;tricas da (s) unidade (s) unidade (s) consumidora (s) do (s) seu (s) im&oacute;vel (s) (s), atendendo a um contrato de concess&atilde;o de energia el&eacute;trica, de acordo com a Resolu&ccedil;&atilde;o n&ordm;. 414 da ANEEL.</p>

<p>CL&Aacute;USULA DE RESPONSABILIDADE POR TODAS COMO INFORMA&Ccedil;&Otilde;ES PRESTADAS.</p>

<p>&Eacute; DE RESPONSABILIDADE &Uacute;NICA E EXCLUSIVA DO CONTRATANTE, TODAS COMO INFORMA&Ccedil;&Otilde;ES PRESTADAS NA PRESENTE AUTORIZA&Ccedil;&Atilde;O DE LOCALIZA&Ccedil;&Atilde;O, BEM COMO O CONTRATANTE DEVE ENTREGAR O IM&Oacute;VEL EM CONDI&Ccedil;&Otilde;ES DE HABITABILIDADE, TAIS COMO: LICEN&Ccedil;A ANUAL DO CORPO DE BOMBEIRO, ATESTANTE QUE IMPORTA DE USO; EXTINTORES DE INC&Ecirc;NDIO, QUANDO PARA O CASO; EM TRATANDO DE IM&Oacute;VEL COMERCIAL, ALVAR&Aacute; EM DIAS, E DEMAIS LICEN&Ccedil;AS PERTINENTES, ETC.</p>

<p><strong>f)</strong> Todo e qualquer valor pago como <strong>CONTRATADO</strong> pelo <strong>CONTRATANTE</strong> s&oacute; poder&aacute; ser feito diretamente na conta corrente do <strong>titular</strong> da <strong>CONTRATADA</strong> , mediante a aplica&ccedil;&atilde;o de pr&eacute;-requisitos e formalidades dos servi&ccedil;os a serem executados, com uma sa&iacute;da antecipada do recebimento de pagamento pago pelos servi&ccedil;os contratados e / ou despesas est&atilde;o sendo incorretas, e a conta para dep&oacute;sito, e nunca fica diretamente com seus funcion&aacute;rios, mesmo que seja atrav&eacute;s de cheque, inclusive os nominais e / ou cruzados.</p>

<p><strong>11 - DIREITO DE USO DE IMAGEM</strong></p>

<p>11.1 - <strong>Autorizar</strong> uma empresa <strong>M JDUDA B ALEXANDRE LTDA - ME </strong><strong>,</strong> a utilizar como imagens do im&oacute;vel objeto do presente contrato em seus informes publicit&aacute;rios, tais como sites, jornais, panfletos, materiais impressos, redes sociais (face book, instagram, Whatsapp , twitter ...) e outros meios de comunica&ccedil;&atilde;o ainda que aqui n&atilde;o s&atilde;o exibidos de forma expressa, sempre de forma gratuita, durante o prazo do contrato de presta&ccedil;&atilde;o de servi&ccedil;os e ainda ap&oacute;s o t&eacute;rmino deste, por tempo indeterminado</p>

<p><strong>12 - RESCIS&Atilde;O </strong></p>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.1 - Este contrato pode ser rescindido por qualquer parte, unilateralmente, impedindo que seja publicado por outra pessoa por escrito e com anteced&ecirc;ncia m&iacute;nima de 30 (trinta) dias. </font><font style="vertical-align: inherit;">Caso a rescis&atilde;o ocorra dentro do per&iacute;odo de vig&ecirc;ncia do contrato de loca&ccedil;&atilde;o, pe&ccedil;a que solicite uma rescis&atilde;o do valor correspondente a 50% (cinquenta por cento) do valor do aluguel. </font><font style="vertical-align: inherit;">Caso ocorra ap&oacute;s o per&iacute;odo contratado, n&atilde;o haver&aacute; multa rescis&oacute;ria, devendo ainda assim ser respeitado pela comunica&ccedil;&atilde;o pr&eacute;via de 30 (trinta dias). </font></font><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mesmo ap&oacute;s a rescis&atilde;o do contrato, se o im&oacute;vel estiver localizado posteriormente, como fruto do trabalho inicial da CONTRATADA, os seus honor&aacute;rios ser&atilde;o devidos integralmente.</font></font></strong></p>

<p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">13 - FORO</font></font></strong></p>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">13.1 - Por estar justos e contratados, assinar o presente contrato em duas vias, com duas (02) testemunhas, eleger o </font></font><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Foro da Comarca de Santar&eacute;m-PA</font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> , para toda e qualquer a&ccedil;&atilde;o oriunda deste instrumento, renunciar a qualquer outro por mais privil&eacute;gio que venha a ser.</font></font></p>

                                            <br>
<p style="text-align: right"><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Santar&eacute;m (PA), </font></font></strong><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php print(date('d'). '/'. date('m'). '/20' . date('y'))?></font></font></strong><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">.</font></font></strong></p>

<p>&nbsp;</p>

                                            <div style="text-align: center">
                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">____________________________________________</font></font></strong></p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$dadosProprietario->nome}}</font></font></strong></p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CPF: {{$dadosProprietario->cpf}}</font></font></strong></p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CONTRATANTE</font></font></strong></p>

                                                <p>&nbsp;</p>

                                                <p>&nbsp;</p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">_________________________________________</font></font></strong></p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">M DE J DUDA B ALEXANDRE LTDA - ME</font></font></strong></p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CNPJ 13.053.532 / 0001-39</font></font></strong></p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CONTRATADA</font></font></strong></p>

                                                <p>&nbsp;</p>

                                                <p>&nbsp;</p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">TESTEMUNHAS:</font></font></strong></p>

                                                <p>&nbsp;</p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">__________________________________________________</font></font></strong></p>

                                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CPF:&nbsp;</font></font></p>

                                                <p>&nbsp;</p>

                                                <p><strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">__________________________________________________</font></font></strong></p>

                                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CPF:&nbsp;</font></font></p>
                                                <br>
                                            </div>



                                        </div>
                                    </textarea>
                                </div>
                                <div class=" box-footer">
                                    <div class="row">
                                        <a href="#" class="btn btn-default col-md-4 col-md-offset-1" data-dismiss="modal">Sair</a>
                                        <button type="submit" class="btn btn-primary col-md-4 col-md-offset-1">Salvar</button>
                                    </div>
                                </div>
                        </div>

                    </div>
                </form>


            </div>
            <!-- /.row -->
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')

    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- CK Editor -->
    <script src="../../admin/bower_components/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../../admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>



@endsection
