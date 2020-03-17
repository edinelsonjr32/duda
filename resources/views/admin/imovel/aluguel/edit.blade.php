@section('estilo')
    <link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

    <link rel="stylesheet" href="/admin/plugins/iCheck/all.css">

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script language="javascript">
        //-----------------------------------------------------
        //Funcao: MascaraMoeda
        //Sinopse: Mascara de preenchimento de moeda
        //Parametro:
        //   objTextBox : Objeto (TextBox)
        //   SeparadorMilesimo : Caracter separador de milésimos
        //   SeparadorDecimal : Caracter separador de decimais
        //   e : Evento
        //Retorno: Booleano
        //Autor: Gabriel Fróes - www.codigofonte.com.br
        //-----------------------------------------------------
        function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
            var sep = 0;
            var key = '';
            var i = j = 0;
            var len = len2 = 0;
            var strCheck = '0123456789';
            var aux = aux2 = '';
            var whichCode = (window.Event) ? e.which : e.keyCode;
            if (whichCode == 13) return true;
            key = String.fromCharCode(whichCode); // Valor para o código da Chave
            if (strCheck.indexOf(key) == -1) return false; // Chave inválida
            len = objTextBox.value.length;
            for(i = 0; i < len; i++)
                if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
            aux = '';
            for(; i < len; i++)
                if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
            aux += key;
            len = aux.length;
            if (len == 0) objTextBox.value = '';
            if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
            if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
            if (len > 2) {
                aux2 = '';
                for (j = 0, i = len - 3; i >= 0; i--) {
                    if (j == 3) {
                        aux2 += SeparadorMilesimo;
                        j = 0;
                    }
                    aux2 += aux.charAt(i);
                    j++;
                }
                objTextBox.value = '';
                len2 = aux2.length;
                for (i = len2 - 1; i >= 0; i--)
                    objTextBox.value += aux2.charAt(i);
                objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
            }
            return false;
        }
    </script>
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

        //adiciona mascara de cep
        function MascaraCep(cep){
            if(mascaraInteiro(cep)==false){
                event.returnValue = false;
            }
            return formataCampo(cep, '00.000-000', event);
        }
    </script>

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
                <li class="active"> <i class="fa fa-user"></i>  Imoveis</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.imoveis.aluguel.update', ['id' => $imovel->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <input type="hidden" name="aluguel" value="1">
                                <input type="hidden" name="venda" value="0">
                                <div class="form-group row">
                                    <label for="titulo" class="col-md-2 col-form-label text-md-right">Titulo Imóvel</label>
                                    <div class="col-md-10">
                                        <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') ?? $imovel->titulo}}"  autocomplete="titulo" autofocus>
                                        @error('titulo')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipo_imovel" class="col-md-1 col-form-label text-md-right">Tipo</label>
                                    <div class="col-md-3">
                                        <select class="form-control select2" style="width: 100%;" name="tipo_imovel">
                                            @foreach($tipoImovel as $tipoImoveis)
                                                <option value="{{$tipoImoveis->id}}" {{ (old('tipo_imovel') == $tipoImoveis->id ? 'selected'  : ($imovel->tipo_imovel  == $tipoImoveis->id ? 'selected' : '')) }}>{{$tipoImoveis->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label for="proprietario" class="col-md-1 col-form-label text-md-right">Proprietário</label>
                                    <div class="col-md-3">
                                        <select class="form-control select2" style="width: 100%;" name="proprietario_id">
                                            @foreach($proprietarios as $proprietario)
                                                @if($proprietario->tipo_proprietario_id == 1)
                                                    <option value="{{$proprietario->id}}" {{ (old('proprietario_id') == $proprietario->id ? 'selected'  : ($imovel->proprietario_id  == $proprietario->id ? 'selected' : '')) }}>{{$proprietario->nome}}</option>
                                                @elseif($proprietario->tipo_proprietario_id == 2)
                                                    <option value="{{$proprietario->id}}" {{ (old('proprietario_id') == $proprietario->id ? 'selected'  : ($imovel->proprietario_id  == $proprietario->id ? 'selected' : '')) }}>{{$proprietario->nome_empresa}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <label for="email" class="col-md-1 col-form-label text-md-right">Status </label>
                                    <div class="col-md-3">
                                        <select class="form-control select2" style="width: 100%;" name="status">
                                            <option value="1" {{ (old('status') == 1 ? 'selected'  : ($imovel->status  == 1 ? 'selected' : '')) }}>Disponivel</option>
                                            <option value="2" {{ (old('status') == 2 ? 'selected'  : ($imovel->status  == 2 ? 'selected' : '')) }}>Indisponivel</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="alert alert-info alert-dismissible">
                                        <label class="col-md-4">
                                            Precificação
                                        </label>

                                        <br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valor_aluguel" class="col-md-1 col-form-label text-md-right">Aluguel</label>

                                    <div class="col-md-5">
                                        <input onKeyPress="return(MascaraMoeda(this,'.',',',event))" id="valor_aluguel" type="text" class="form-control @error('valor_aluguel') is-invalid @enderror" name="valor_aluguel" value="{{ number_format(old('valor_aluguel') ?? $imovel->valor_aluguel, 2, ',', '.')}}"  autocomplete="valor_aluguel" autofocus>

                                        @error('valor_aluguel')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                    <label for="imposto" class="col-md-1 col-form-label text-md-right">Insc. Imobiliária</label>

                                    <div class="col-md-5">
                                        <input id="imposto" type="text" class="form-control @error('imposto') is-invalid @enderror" name="imposto" value="{{ old('imposto') ?? $imovel->imposto}}"  autocomplete="imposto" autofocus>

                                        @error('imposto')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="condominio" class="col-md-1 col-form-label text-md-right">Condominio</label>

                                    <div class="col-md-3">
                                        <input onKeyPress="return(MascaraMoeda(this,'.',',',event))" id="condominio" type="text" class="form-control @error('condominio') is-invalid @enderror" name="condominio" value="{{ number_format(old('condominio') ?? $imovel->condominio, 2, ',', '.')}}"  autocomplete="condominio" autofocus>

                                        @error('condominio')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="taxas_extras" class="col-md-1 col-form-label text-md-right">Taxa Rateio</label>
                                    <div class="col-md-3">
                                        <input id="taxas_extras" onKeyPress="return(MascaraMoeda(this,'.',',',event))" type="text" class="form-control @error('taxas_extras') is-invalid @enderror" name="taxas_extras" value="{{ number_format(old('taxas_extras') ?? $imovel->taxas_extras, 2, ',', '.')}}"  autocomplete="taxas_extras" autofocus>

                                        @error('taxas_extras')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="matricula_celpa" class="col-md-2 col-form-label text-md-right">Conta Contrato Celpa</label>

                                    <div class="col-md-4">
                                        <input id="matricula_celpa" type="text" class="form-control @error('matricula_celpa') is-invalid @enderror" name="matricula_celpa" value="{{ old('matricula_celpa') ?? $imovel->matricula_celpa}}"  autocomplete="matricula_celpa" autofocus>

                                        @error('matricula_celpa')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="matricula_cosanpa" class="col-md-2 col-form-label text-md-right">Matrícula Cosanpa</label>
                                    <div class="col-md-4">
                                        <input id="matricula_cosanpa" type="text" class="form-control @error('matricula_cosanpa') is-invalid @enderror" name="matricula_cosanpa" value="{{ old('matricula_cosanpa') ?? $imovel->matricula_cosanpa}}"  autocomplete="matricula_cosanpa" autofocus>

                                        @error('matricula_cosanpa')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="alert alert-info alert-dismissible">
                                        <label class="col-md-4">
                                            Caracteristícas
                                        </label>

                                        <br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <textarea id="editor2" name="descricao" rows="10" cols="190">
                                                <?php
                                            printf($imovel->descricao);

                                            ?>
                                        </textarea>
                                </div>
                                <div class="form-group row">
                                    <label for="quartos" class="col-md-1 col-form-label text-md-right">Quarto</label>
                                    <div class="col-md-2">
                                        <input id="quartos" type="text" class="form-control @error('quartos') is-invalid @enderror" name="quartos" value="{{ old('quartos') ?? $imovel->quartos }}"  autocomplete="quartos" autofocus>

                                        @error('quartos')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="suites" class="col-md-1 col-form-label text-md-right">Suite</label>

                                    <div class="col-md-2">
                                        <input id="suites" type="text" class="form-control @error('suites') is-invalid @enderror" name="suites" value="{{ old('suites') ?? $imovel->suites}}"  autocomplete="suites" autofocus>

                                        @error('suites')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                    <label for="salas" class="col-md-1 col-form-label text-md-right">Salas</label>

                                    <div class="col-md-2">
                                        <input id="salas" type="text" class="form-control @error('salas') is-invalid @enderror" name="salas" value="{{ old('salas') ?? $imovel->salas}}"  autocomplete="salas" autofocus>

                                        @error('salas')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="banheiros" class="col-md-1 col-form-label text-md-right">Banheiros</label>

                                    <div class="col-md-2">
                                        <input id="banheiros" type="text" class="form-control @error('banheiros') is-invalid @enderror" name="banheiros" value="{{ old('banheiros') ?? $imovel->banheiros}}"  autocomplete="banheiros" autofocus>

                                        @error('banheiros')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="garagem" class="col-md-1 col-form-label text-md-right">Garagem</label>
                                    <div class="col-md-2">
                                        <input id="garagem" type="text" class="form-control @error('garagem') is-invalid @enderror" name="garagem" value="{{ old('garagem') ?? $imovel->garagem}}"  autocomplete="garagem" autofocus>

                                        @error('garagem')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="garagem_coberta" class="col-md-1 col-form-label text-md-right">Garagem Coberta</label>

                                    <div class="col-md-2">
                                        <input id="garagem_coberta" type="text" class="form-control @error('garagem_coberta') is-invalid @enderror" name="garagem_coberta" value="{{ old('garagem_coberta') ?? $imovel->garagem_coberta}}"  autocomplete="Nome" autofocus>

                                        @error('garagem_coberta')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                    <label for="area_util" class="col-md-1 col-form-label text-md-right">Área Útil</label>

                                    <div class="col-md-2">
                                        <input id="area_util" type="text" class="form-control @error('area_util') is-invalid @enderror" name="area_util" value="{{ old('area_util') ?? $imovel->area_util}}"  autocomplete="area_util" autofocus>

                                        @error('area_util')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="area_total" class="col-md-1 col-form-label text-md-right">Área Total</label>

                                    <div class="col-md-2">
                                        <input id="area_total" type="text" class="form-control @error('area_total') is-invalid @enderror" name="area_total" value="{{ old('area_total') ?? $imovel->area_total}}"  autocomplete="area_total" autofocus>

                                        @error('area_total')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="alert alert-info alert-dismissible">
                                        <label class="col-md-4">
                                            Endereço
                                        </label>

                                        <br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cep" class="col-md-1 col-form-label text-md-right">Cep</label>
                                    <div class="col-md-2">
                                        <input id="cep" type="text" class="form-control @error('cep') is-invalid @enderror" name="cep" value="{{ old('cep') ?? $imovel->cep}}"  autocomplete="cep" autofocus >

                                        @error('cep')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="endereco" class="col-md-1 col-form-label text-md-right">Endereço</label>

                                    <div class="col-md-3">
                                        <input id="rua" type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco" value="{{ old('endereco') ?? $imovel->endereco}}"  autocomplete="endereco" autofocus>

                                        @error('endereco')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="complemento" class="col-md-1 col-form-label text-md-right">Complemento</label>

                                    <div class="col-md-4">
                                        <input id="complemento" type="text" class="form-control @error('complemento') is-invalid @enderror" name="complemento" value="{{ old('complemento') ?? $imovel->complemento}}"  autocomplete="complemento" autofocus>

                                        @error('complemento')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="numero" class="col-md-1 col-form-label text-md-right">Número</label>

                                    <div class="col-md-2">
                                        <input id="numero" required type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero') ?? $imovel->numero}}"  autocomplete="numero" autofocus>

                                        @error('numero')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="bairro" class="col-md-1 col-form-label text-md-right">Bairro</label>

                                    <div class="col-md-2">
                                        <input id="bairro" type="text" class="form-control @error('bairro') is-invalid @enderror" name="bairro" value="{{ old('bairro') ?? $imovel->bairro}}"  autocomplete="bairro" autofocus>

                                        @error('bairro')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                    <label for="cidade" class="col-md-1 col-form-label text-md-right">Cidade</label>

                                    <div class="col-md-2">
                                        <input id="cidade" type="text" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="{{ old('cidade') ?? $imovel->cidade}}"  autocomplete="cidade" autofocus>

                                        @error('cidade')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                    <label for="estado" class="col-md-1 col-form-label text-md-right">Estado</label>

                                    <div class="col-md-2">
                                        <input id="uf" type="text" class="form-control @error('estado') is-invalid @enderror" name="estado" value="{{ old('estado') ?? $imovel->estado}}"  autocomplete="estado" autofocus>

                                        @error('estado')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="mapa" class="col-md-1 col-form-label text-md-right">Mapa</label>

                                    <div class="col-md-11">
                                        <input id="mapa" type="text" class="form-control @error('mapa') is-invalid @enderror" name="mapa" value="{{ old('mapa') ?? $imovel->mapa}}"  autocomplete="mapa" autofocus>

                                        @error('mapa')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="ar_condicionado" {{ (old('ar_condicionado') == 'on' || old('ar_condicionado') == true ? 'checked' : ($imovel->ar_condicionado == true ? 'checked' : '')) }}>
                                            Ar condicionado
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2" >
                                            <input type="checkbox" name="bar" {{ (old('bar') == 'on' || old('bar') == true ? 'checked' : ($imovel->bar == true ? 'checked' : '')) }}>
                                            Bar
                                        </label>
                                    </div>


                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="livraria" {{ (old('livraria') == 'on' || old('livraria') == true ? 'checked' : ($imovel->livraria == true ? 'checked' :  '')) }}>
                                            livraria
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="churrasqueira" {{ (old('churrasqueira') == 'on' || old('churrasqueira') == true ? 'checked' : ($imovel->churrasqueira == true ? 'checked' : '')) }}>
                                            Churrasqueira
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="cozinha_americana" {{ (old('cozinha_americana') == 'on' || old('cozinha_americana') == true ? 'checked' : ($imovel->cozinha_americana == true ? 'checked' : '')) }}>
                                            Cozinha Americana
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="cozinha_equipada" {{ (old('cozinha_equipada') == 'on' || old('cozinha_equipada') == true ? 'checked' : ($imovel->cozinha_equipada == true ? 'checked' : '')) }}>
                                            Cozinha Equipada
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="despensa" {{ (old('despensa') == 'on' || old('despensa') == true ? 'checked' : ($imovel->despensa == true ? 'checked' : '')) }}>
                                            Despensa
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="edicula" {{ (old('edicula') == 'on' || old('edicula') == true ? 'checked' : ($imovel->edicula == true ? 'checked' : '')) }}>
                                            Edicula
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="escritorio" {{ (old('escritorio') == 'on' || old('escritorio') == true ? 'checked' : ($imovel->escritorio == true ? 'checked' : '')) }}>
                                            Escritório
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="lavatorio" {{ (old('lavatorio') == 'on' || old('lavatorio') == true ? 'checked' : ($imovel->lavatorio == true ? 'checked' : '')) }}>
                                            Lavatorio
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="mobiliado" {{ (old('mobiliado') == 'on' || old('mobiliado') == true ? 'checked' : ($imovel->mobiliado == true ? 'checked' : '')) }}>
                                            Mobiliado
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="piscina" {{ (old('piscina') == 'on' || old('piscina') == true ? 'checked' : ($imovel->piscina == true ? 'checked' : '')) }}>
                                            Piscina
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="copa" {{ (old('copa') == 'on' || old('copa') == true ? 'checked' : ($imovel->copa == true ? 'checked' : '')) }}>
                                            Copa
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="terraco" {{ (old('terraco') == 'on' || old('terraco') == true ? 'checked' : ($imovel->terraco == true ? 'checked' : '')) }}>
                                            Terraço
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="quarto_empregada" {{ (old('quarto_empregada') == 'on' || old('quarto_empregada') == true ? 'checked' : ($imovel->quarto_empregada == true ? 'checked' : '')) }}>
                                            Quarto Empregada
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="banheiro_empregada" {{ (old('banheiro_empregada') == 'on' || old('banheiro_empregada') == true ? 'checked' : ($imovel->banheiro_empregada == true ? 'checked' : '')) }}>
                                            Banheiro Empregada
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="sala_com_lareira" {{ (old('sala_com_lareira') == 'on' || old('sala_com_lareira') == true ? 'checked' : ($imovel->sala_com_lareira == true ? 'checked' : '')) }}>
                                            Sala C/ Lareira
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="banheiro_social" {{ (old('banheiro_social') == 'on' || old('banheiro_social') == true ? 'checked' : ($imovel->banheiro_social == true ? 'checked' : '')) }}>
                                            Banheiro Social
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="placa" {{ (old('placa') == 'on' || old('placa') == true ? 'checked' : ($imovel->placa == true ? 'checked' : '')) }}>
                                            Placa
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="documentado" {{ (old('documentado') == 'on' || old('documentado') == true ? 'checked' : ($imovel->documentado == true ? 'checked' : '')) }}>
                                            Documentado
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="recibo_compra_venda" {{ (old('recibo_compra_venda') == 'on' || old('recibo_compra_venda') == true ? 'checked' : ($imovel->recibo_compra_venda == true ? 'checked' : '')) }}>
                                            Recibo Compra e venda
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="exclusividade" {{ (old('exclusividade') == 'on' || old('exclusividade') == true ? 'checked' : ($imovel->exclusividade == true ? 'checked' : '')) }}>
                                            Exclusividade
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="imposto_valor" {{ (old('imposto_valor') == 'on' || old('imposto_valor') == true ? 'checked' : ($imovel->imposto_valor == true ? 'checked' : '')) }}>
                                            IPTU
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="cerca_eletrica" {{ (old('cerca_eletrica') == 'on' || old('cerca_eletrica') == true ? 'checked' : ($imovel->cerca_eletrica == true ? 'checked' : '')) }}>
                                            Cerca Elétrica
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="poco_artesiano" {{ (old('poco_artesiano') == 'on' || old('poco_artesiano') == true ? 'checked' : ($imovel->poco_artesiano == true ? 'checked' : '')) }}>
                                            Poço Artesiano
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="portao_eletronico" {{ (old('portao_eletronico') == 'on' || old('portao_eletronico') == true ? 'checked' : ($imovel->portao_eletronico == true ? 'checked' : '')) }}>
                                            Portao Eletronico
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="concertina" {{ (old('concertina') == 'on' || old('concertina') == true ? 'checked' : ($imovel->concertina == true ? 'checked' : '')) }}>
                                            Concertina
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="elevador" {{ (old('elevador') == 'on' || old('elevador') == true ? 'checked' : ($imovel->elevador == true ? 'checked' : '')) }}>
                                            Elevador
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="escada" {{ (old('escada') == 'on' || old('escada') == true ? 'checked' : ($imovel->escada == true ? 'checked' : '')) }}>
                                            Escada
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="interfone" {{ (old('interfone') == 'on' || old('interfone') == true ? 'checked' : ($imovel->interfone == true ? 'checked' : '')) }}>
                                            Interfone
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="cozinha_planejada" {{ (old('cozinha_planejada') == 'on' || old('cozinha_planejada') == true ? 'checked' : ($imovel->cozinha_planejada == true ? 'checked' : '')) }}>
                                            Cozinha Planejada
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="cozinha" {{ (old('cozinha') == 'on' || old('cozinha') == true ? 'checked' : ($imovel->cozinha == true ? 'checked' : '')) }}>
                                            Cozinha
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- /.box-body -->
                            <div class=" box-footer">
                                <div class="row">
                                    <a href="{{route('admin.imoveis.aluguel.index')}}" class="btn btn-default col-md-4 col-md-offset-1" data-dismiss="modal">Sair</a>
                                    <button type="submit" class="btn btn-primary col-md-4 col-md-offset-1">Salvar</button>
                                </div>
                            </div>

                        </form>


                        <!-- /.box-body -->
                    </div>
                </div>


            </div>
            <!-- /.row -->
        </section>
    </div>
    <!-- /.content-wrapper -->



@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $("#input-res-1").fileinput({
                uploadUrl: "/site/upload-file-chunks",
                enableResumableUpload: true,
                maxFileCount: 5,
                theme: 'fas',
                deleteUrl: '/site/file-delete',
                fileActionSettings: {
                    showZoom: function(config) {
                        if (config.type === 'pdf' || config.type === 'image') {
                            return true;
                        }
                        return false;
                    }
                }
            });
        });
    </script>

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
    <script src="/admin/plugins/iCheck/icheck.min.js"></script>

    <!-- CK Editor -->
    <script src="/admin/bower_components/ckeditor/ckeditor.js"></script>

    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })

        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor2')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
    </script>
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
    <script type="javascript">
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
    </script>
    <script type="text/javascript">


        $(document).ready(function() {

            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });

        });

    </script>
@endsection
