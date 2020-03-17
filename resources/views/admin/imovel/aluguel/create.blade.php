@section('estilo')
    <link rel="stylesheet" href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">


    <!-- Select2 -->
    <link rel="stylesheet" href="../../../admin/bower_components/select2/dist/css/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         venda instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
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


        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua2").val("");
                $("#bairro2").val("");
                $("#cidade2").val("");
                $("#uf2").val("");
                $("#ibge2").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep2").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua2").val("...");
                        $("#bairro2").val("...");
                        $("#cidade2").val("...");
                        $("#uf2").val("...");
                        $("#ibge2").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua2").val(dados.logradouro);
                                $("#bairro2").val(dados.bairro);
                                $("#cidade2").val(dados.localidade);
                                $("#uf2").val(dados.uf);
                                $("#ibge2").val(dados.ibge);
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

    </script>

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
                <form method="POST" action="{{ route('admin.imoveis.aluguel.store') }}">
                    @csrf

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

                            <div class="box-body">
                                <input type="hidden" name="aluguel" value="1">
                                <input type="hidden" name="venda" value="0">
                                <div class="form-group row">
                                    <label for="titulo" class="col-md-2 col-form-label text-md-right">Titulo Imóvel</label>
                                    <div class="col-md-10">
                                        <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}"  autocomplete="titulo" autofocus>
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
                                                <option value="{{$tipoImoveis->id}}" {{ (old('tipo_imovel') == $tipoImoveis->id ) }}>{{$tipoImoveis->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label for="proprietario" class="col-md-1 col-form-label text-md-right">Proprietário</label>
                                    <div class="col-md-3">
                                        <select class="form-control select2" style="width: 100%;" name="proprietario">
                                            @foreach($proprietarios as $proprietario)
                                                @if($proprietario->tipo_proprietario_id == 1)

                                                    <option value="{{$proprietario->id}}" {{ (old('proprietário_id') == $proprietario->id ) }}>{{$proprietario->nome}}</option>

                                                @elseif($proprietario->tipo_proprietario_id == 2)
                                                    <option value="{{$proprietario->id}}" {{ (old('proprietário_id') == $proprietario->id ) }}>{{$proprietario->nome_empresa}}</option>

                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <label for="email" class="col-md-1 col-form-label text-md-right">Status </label>
                                    <div class="col-md-3">
                                        <select class="form-control select2" style="width: 100%;" name="status">
                                            <option value="1" {{ (old('proprietário_id') == 1 ) }}>Disponivel</option>
                                            <option value="2" {{ (old('proprietário_id') == 2 ) }}>Indisponivel</option>
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
                                        <input onKeyPress="return(MascaraMoeda(this,'.',',',event))" id="valor_aluguel" type="text" class="form-control @error('valor_aluguel') is-invalid @enderror" name="valor_aluguel" value="{{ old('valor_aluguel') }}"  autocomplete="valor_aluguel" autofocus>

                                        @error('valor_aluguel')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>

                                    <label for="imposto" class="col-md-1 col-form-label text-md-right">Insc. Imobiliária</label>

                                    <div class="col-md-5">
                                        <input id="imposto" type="text" class="form-control @error('imposto') is-invalid @enderror" name="imposto" value="{{ old('imposto') }}"  autocomplete="imposto" autofocus>

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
                                        <input onKeyPress="return(MascaraMoeda(this,'.',',',event))" id="condominio" type="text" class="form-control @error('condominio') is-invalid @enderror" name="condominio" value="{{ old('condominio') }}"  autocomplete="condominio" autofocus>

                                        @error('condominio')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                    <label for="taxas_extras" class="col-md-1 col-form-label text-md-right">Taxa Rateio</label>
                                    <div class="col-md-3">
                                        <input id="taxas_extras" onKeyPress="return(MascaraMoeda(this,'.',',',event))" type="text" class="form-control @error('taxas_extras') is-invalid @enderror" name="taxas_extras" value="{{ old('taxas_extras') }}"  autocomplete="taxas_extras" autofocus>

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
                                        <input id="matricula_celpa" type="text" class="form-control @error('matricula_celpa') is-invalid @enderror" name="matricula_celpa" value="{{ old('matricula_celpa') }}"  autocomplete="matricula_celpa" autofocus>

                                        @error('matricula_celpa')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>

                                    <label for="matricula_cosanpa" class="col-md-2 col-form-label text-md-right">Matrícula Cosanpa</label>
                                    <div class="col-md-4">
                                        <input id="matricula_cosanpa" type="text" class="form-control @error('matricula_cosanpa') is-invalid @enderror" name="matricula_cosanpa" value="{{ old('matricula_cosanpa') }}"  autocomplete="matricula_cosanpa" autofocus>

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

                                    </textarea>
                                </div>
                                <div class="form-group row">
                                    <label for="quartos" class="col-md-1 col-form-label text-md-right">Quarto</label>
                                    <div class="col-md-2">
                                        <input id="quartos" type="text" class="form-control @error('quartos') is-invalid @enderror" name="quartos" value="{{ old('quartos') }}"  autocomplete="quartos" autofocus>

                                        @error('quartos')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                    <label for="suites" class="col-md-1 col-form-label text-md-right">Suite</label>

                                    <div class="col-md-2">
                                        <input id="suites" type="text" class="form-control @error('suites') is-invalid @enderror" name="suites" value="{{ old('suites') }}"  autocomplete="suites" autofocus>

                                        @error('suites')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>

                                    <label for="salas" class="col-md-1 col-form-label text-md-right">Salas</label>

                                    <div class="col-md-2">
                                        <input id="salas" type="text" class="form-control @error('salas') is-invalid @enderror" name="salas" value="{{ old('salas') }}"  autocomplete="salas" autofocus>

                                        @error('salas')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                    <label for="banheiros" class="col-md-1 col-form-label text-md-right">Banheiros</label>

                                    <div class="col-md-2">
                                        <input id="banheiros" type="text" class="form-control @error('banheiros') is-invalid @enderror" name="banheiros" value="{{ old('banheiros') }}"  autocomplete="banheiros" autofocus>

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
                                        <input id="garagem" type="text" class="form-control @error('garagem') is-invalid @enderror" name="garagem" value="{{ old('garagem') }}"  autocomplete="garagem" autofocus>

                                        @error('garagem')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>



                                    <label for="area_total" class="col-md-1 col-form-label text-md-right">Área Total</label>

                                    <div class="col-md-2">
                                        <input id="area_total" onKeyPress="return(MascaraMoeda(this,'.',',',event))" type="text" class="form-control @error('area_total') is-invalid @enderror" name="area_total" value="{{ old('area_total') }}"  autocomplete="area_total" autofocus>

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
                                        <input id="cep2" type="text" class="form-control @error('cep') is-invalid @enderror" name="cep" value="{{ old('cep') }}"  autocomplete="cep" autofocus >

                                        @error('cep')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                    <label for="endereco" class="col-md-1 col-form-label text-md-right">Endereço</label>

                                    <div class="col-md-3">
                                        <input id="rua2" type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco" value="{{ old('endereco') }}"  autocomplete="endereco" autofocus>

                                        @error('endereco')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                    <label for="complemento" class="col-md-1 col-form-label text-md-right">Complemento</label>

                                    <div class="col-md-4">
                                        <input id="complemento" type="text" class="form-control @error('complemento') is-invalid @enderror" name="complemento" value="{{ old('complemento') }}"  autocomplete="complemento" autofocus>

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
                                        <input id="numero" type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero') }}"  autocomplete="numero" required autofocus>

                                        @error('numero')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                    <label for="bairro" class="col-md-1 col-form-label text-md-right">Bairro</label>

                                    <div class="col-md-2">
                                        <input id="bairro2" type="text" class="form-control @error('bairro') is-invalid @enderror" name="bairro" value="{{ old('bairro') }}"  autocomplete="bairro" autofocus>

                                        @error('bairro')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                    <label for="cidade" class="col-md-1 col-form-label text-md-right">Cidade</label>

                                    <div class="col-md-2">
                                        <input id="cidade2" type="text" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="{{ old('cidade') }}"  autocomplete="cidade" autofocus>

                                        @error('cidade')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>

                                    <label for="estado" class="col-md-1 col-form-label text-md-right">Estado</label>

                                    <div class="col-md-2">
                                        <input id="uf2" type="text" class="form-control @error('estado') is-invalid @enderror" name="estado" value="{{ old('estado') }}"  autocomplete="estado" autofocus>

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
                                        <input id="mapa" type="text" class="form-control @error('mapa') is-invalid @enderror" name="mapa" value="{{ old('mapa') }}"  autocomplete="mapa" autofocus>

                                        @error('mapa')
                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="ar_condicionado">
                                            Ar condicionado
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2" >
                                            <input type="checkbox" name="bar">
                                            Bar
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="livraria">
                                            livraria
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="churrasqueira">
                                            Churrasqueira
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="cozinha_americana">
                                            Cozinha Americana
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="cozinha_planejada">
                                            Cozinha equipada
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="despensa">
                                            Despensa
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="edicula">
                                            Edicula
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="escritorio">
                                            Escritório
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="lavatorio">
                                            Lavatorio
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="mobiliado">
                                            Mobiliado
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="piscina">
                                            Piscina
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="copa">
                                            Copa
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="terraco">
                                            Terraço
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="quarto_empregada">
                                            Quarto Empregada
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="banheiro_empregada">
                                            Banheiro Empregada
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="sala_com_lareira">
                                            Sala C/ Lareira
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="banheiro_social">
                                            Banheiro Social
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="placa">
                                            Placa
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="documentado">
                                            Documentado
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="recibo_compra_venda">
                                            Recibo Compra e venda
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="exclusividade">
                                            Exclusividade
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="imposto_valor">
                                            IPTU
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="cerca_eletrica">
                                            Cerca Elétrica
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="poco_artesiano">
                                            Poço Artesiano
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="portao_eletronico">
                                            Portao Eletronico
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="concertina">
                                            Concertina
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="elevador">
                                            Elevador
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="escada">
                                            Escada
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="interfone">
                                            Interfone
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="checkbox">
                                        <label class="col-md-2">
                                            <input type="checkbox" name="cozinha" {{ (old('cozinha') == 'on' || old('cozinha') == true ? 'checked' : '') }}>
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

    <script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- CK Editor -->
    <script src="../../bower_components/ckeditor/ckeditor.js"></script>
    <!-- Select2 -->
    <script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>

        $(function () {
            CKEDITOR.replace('editor1')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor2')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
    </script>
@endsection
