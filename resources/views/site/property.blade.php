<!DOCTYPE html>
<html lang="en">
<head>
<title>Duda Imobiliária STM </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Duda Imobiliária Santarém">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../../styles/bootstrap4/bootstrap.min.css">
<link href="../../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../../plugins/rangeslider.js-2.3.0/rangeslider.css">
<link rel="stylesheet" type="text/css" href="../../styles/property.css">
<link rel="stylesheet" type="text/css" href="../../styles/property_responsive.css">
    <link rel="stylesheet" type="text/css" href="../../styles/contact.css">

    <link rel="stylesheet" type="text/css" href="../../styles/properties.css">
    <link rel="stylesheet" type="text/css" href="../../styles/properties_responsive.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



    <style>
        .btn:focus, .btn:active, button:focus, button:active {
            outline: none !important;
            box-shadow: none !important;
        }

        #image-gallery .modal-footer{
            display: block;
        }

        .thumb{
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
    <!-- Estilo da div do mapa -->
    <style>
        .map {
            height: 400px;
            width: 350px;
        }
    </style>
    <style type="text/css">
        .whatsapp {position: fixed;top: 82%;left: 92%;padding: 10px;z-index: 10000000;}
    </style>
    <!-- Javascript do Openlayers -->
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
</head>
<body>

<div class="super_container">

	<!-- Header -->

    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justify-content-start">
                        <div class="logo">
                            <a href="/"><img src="../../images/duda.png" alt=""></a>
                        </div>
                        <nav class="main_nav">
                            <ul>
                                <li class="active"><a href="{{route('site.index')}}">Inicio</a></li>
                                <li ><a href="{{route('site.sobre')}}">Sobre nós</a></li>
                                <li><a href="{{route('site.corretores')}}">Corretores</a></li>
                                <li><a href="{{route('site.imoveis')}}">Imóveis</a></li>
                                <li ><a href="{{route('site.correspondentes')}}">Financiamento</a></li>
                                <li><a style="color: yellow" href="{{route('login')}}">Acessar</a></li>
                            </ul>
                        </nav>

                        <div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </header>



    <!-- Menu -->

	<div class="menu trans_500">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo menu_logo">
				<a href="#">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="../../duda.png" alt=""></div></div>
					</div>
				</a>
			</div>
            <ul>
                <li  class="menu_item" ><a href="{{route('site.index')}}">Inicio</a></li>
                <li class="menu_item" ><a href="{{route('site.sobre')}}">Sobre nós</a></li>
                <li class="menu_item" ><a href="{{route('site.corretores')}}">Corretores</a></li>
                <li class="menu_item" ><a href="{{route('site.imoveis')}}">Imóveis</a></li>
                <li class="menu_item" ><a href="{{route('site.correspondentes')}}">Financiamento</a></li>
                <li class="menu_item" ><a style="color: yellow" href="{{route('login')}}">Acessar</a></li>
            </ul>
		</div>
	</div>

    <br>
    <br>

    @foreach($dadosImovel as $dados)
        <div><a href="https://api.whatsapp.com/send?phone=+5593991216151&text=Olá gostaria de saber mais Informações sobre o imóvel deste link https://www.dudaimobiliariastm.com.br/imovel/detail/{{$dados->id}} " target="_blank"><img class="whatsapp col-xs-offset-11" src="https://imobiliariasinai.com.br/wp-content/uploads/2015/10/whatsapp.png" style="width: 80px"/></a></div>

        <div class="home">
            <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="../../images/properties.jpg" data-speed="0.8"></div>
            <div class="home_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content d-flex flex-row align-items-end justify-content-start">
                                <div class="home_title">{{$dados->titulo}} </div>
                                <div class="breadcrumbs ml-auto">
                                    @if($dados->venda == 1)
                                        <div class="intro_price_container ml-lg-auto d-flex flex-column align-items-start justify-content-center">
                                            <div>Venda</div>
                                            <div class="intro_price">R$  {{number_format($dados->valor_venda, 2, ',', '.')}}</div>
                                        </div>
                                    @endif

                                    @if($dados->aluguel == 1)
                                        <div class="intro_price_container ml-lg-auto d-flex flex-column align-items-start justify-content-center" style="background: #0b3e6f">
                                            <div>Aluguel</div>
                                            <div class="intro_price">R$  {{number_format($dados->valor_aluguel, 2, ',', '.')}}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="image-gallery-title"></h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-1 col-xs-1">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                    </button>

                                </div>
                                <div class="col-md-10 col-xs-10">
                                    <img id="image-gallery-image" class="img-responsive col-md-12 col-xs-12" src="">
                                </div>
                                <div class="col-md-1 col-xs-1">

                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                            </button>

                            <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                            </button>-->
                        </div>
                    </div>
                </div>
            </div>

        </div>





    @endforeach

	<!-- Property -->

	<div class="property">
		<div class="container">
			<div class="row">

				<!-- Sidebar -->
                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="sidebar_search">
                                <div class="sidebar_search_title">Fotos</div>
                                <div class="container">
                                    <div class="row">
                                        <div class="row">
                                            @foreach($imagensImoveis as $imagem)
                                                <div class="col-lg-6 col-md-6 col-xs-12 thumb filter retratos">
                                                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                                       data-image="{{ url("/imovel/images/{$imagem->path}") }}"
                                                       data-target="#image-gallery">
                                                        <img class="img-thumbnail" src="{{ url("/imovel/images/{$imagem->path}") }}" style="height: 100%;  width: 100%"   alt="Retratos">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="sidebar">
                            <div class="sidebar_search">
                                <div class="sidebar_search_title">Busca Avançada</div>
                                <div class="sidebar_search_form_container">
                                    <form method="POST" action="{{ route('imoveis.busca') }}"class="sidebar_search_form" id="sidebar_search_form">
                                        @csrf
                                        <select class="sidebar_search_select" name="tipoBusca">
                                            <option disabled selected>Tipo de Busca</option>
                                            <option value="1">Aluguel</option>
                                            <option  value="2">Venda</option>
                                        </select>
                                        <select class="sidebar_search_select" name="tipo_imovel">
                                            <option disabled selected>Tipo Imóvel</option>
                                            @foreach($tipoImoveis as $tipoImovel)
                                                <option  value="{{$tipoImovel->id}}">{{$tipoImovel->nome}}</option>
                                            @endforeach
                                        </select>
                                        <select class="sidebar_search_select" name="quartos">
                                            <option disabled selected>Quartos</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                        <select class="sidebar_search_select" name="suites">
                                            <option disabled selected>Suites</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                        <select class="sidebar_search_select" name="banheiros">
                                            <option disabled selected>Banheiros</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                        <button class="sidebar_search_button search_form_button" style="width: 100%; height: 57px">Buscar</button>

                                        <br>
                                        <br>
                                    </form>
                                </div>
                            </div>


                        </div>

                        <div class="sidebar">
                            <div class="sidebar_search">
                                <div class="sidebar_search_title">Imóveis Semelhantes</div>
                                <div class="sidebar_search_form_container">
                                    <div class="property_description">
                                        <div class="property_text property_text_2">
                                            <div class="row properties_row">
                                                @foreach($imoveisParecidos as $dado)
                                                    <div class="col-xl-6 col-lg-12 property_col">
                                                        <div class="property">
                                                            <div class="property_image">
                                                                <img src="{{ url("/imovel/images/{$dado->path}") }}" alt="" style="width: 100%; height: 100%" >
                                                                @if($dado->venda == 1)
                                                                    <div class="tag_featured property_tag"><a href="#">Venda</a></div>
                                                                @endif
                                                                @if($dado->aluguel == 1)
                                                                    <div class="tag_offer property_tag"><a href="#">Aluguel</a></div>
                                                                @endif
                                                            </div>
                                                            <div class="property_body text-center">
                                                                <div class="property_location">{{$dado->cidade}}</div>
                                                                <div class="property_title"><a href="{{route('site.imovel.detail', ['imovel' => $dado->id])}}">{{$dado->titulo}}</a></div>
                                                                <div class="property_price">
                                                                    @if($dado->aluguel ==1)
                                                                        R$ {{number_format($dado->valor_aluguel, 2, ',', '.')}}
                                                                    @elseif($dado->venda ==1)
                                                                        R$ {{number_format($dado->valor_venda, 2, ',', '.')}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div style="margin-right: auto; margin-left: auto">
                                                    {{$imoveisParecidos->links()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>

				<!-- Property Content -->
				    <div class="col-lg-7 offset-lg-1">
					<div class="property_content">
						<div class="property_icons">
							<div class="property_title">Facilidades Extras</div>

							<div class="property_rooms d-flex flex-sm-row flex-column align-items-start justify-content-start">

								<!-- Property Room Item -->
                                @if($dados->suites !== null)
                                <div class="property_room">
                                    <div class="property_room_title">Suites</div>
                                    <div class="property_room_content d-flex flex-row align-items-center justify-content-start">
                                        <div class="room_icon"><img src="../../images/room_1.png" alt=""></div>
                                        <div class="room_num">{{$dados->suites}}</div>
                                    </div>
                                </div>
                                @endif

                                @if($dados->quartos !== null)
								<div class="property_room">
									<div class="property_room_title">Quartos</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="../../images/room_1.png" alt=""></div>
										<div class="room_num">{{$dados->quartos}}</div>
									</div>
								</div>
                                @endif


                                @if($dados->banheiros !== null)
								<div class="property_room">
									<div class="property_room_title">Banheiros</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="../../images/room_2.png" alt=""></div>
										<div class="room_num">{{$dados->banheiros}}</div>
									</div>
								</div>
                                @endif

                                @if($dados->area_util !== null)
								<div class="property_room">
									<div class="property_room_title">Área</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="../../images/room_3.png" alt=""></div>
										<div class="room_num">{{$dados->area_util}} M²</div>
									</div>
								</div>
                                @endif


                                @if($dados->garagem !== null)
								<div class="property_room">
									<div class="property_room_title">Garagem</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="../../images/room_5.png" alt=""></div>
										<div class="room_num">{{$dados->garagem}}</div>
									</div>
								</div>
                                @endif

							</div>
						</div>



						<div class="property_description">
							<div class="property_title">Descrição</div>
							<div class="property_text property_text_2">
								<p style="text-align: justify">
                                    <?php printf($dados->descricao)?>
                                </p>
							</div>
						</div>

						<!-- Additional Details -->

						<div class="additional_details">
							<div class="property_title">Detalhes adicionais</div>
							<div class="details_container">
                                <ul>

                                    @if($dados->garagem == null )
                                    @elseif($dados->garagem !== null)
                                        <li>Garagem  :   <span >{{$dados->garagem}}</span></li>
                                    @endif

                                    @if($dados->banheiros == null )
                                    @elseif($dados->banheiros !== null)
                                        <li>Banheiros  :  <span >{{$dados->banheiros}}</span></li>
                                    @endif


                                    @if($dados->suites == null )
                                    @elseif($dados->suites !== null)
                                        <li>Suites  :  <span >{{$dados->suites}}</span></li>
                                    @endif

                                    @if($dados->quartos == null )
                                    @elseif($dados->quartos !== null)
                                        <li>Quartos  :  <span >{{$dados->quartos}}</span></li>
                                    @endif

                                    @if($dados->salas == null )
                                    @elseif($dados->salas !== null)
                                        <li>Salas  :  <span >{{$dados->salas}}</span></li>
                                    @endif

                                   <li>Tipo Imóvel <span >{{$dados->nomeTipo}}</span></li>
                                    @if($dados->aluguel == 1)
                                       <li>Valor Aluguel  :  <span >R$ {{number_format($dados->valor_aluguel, 2, ',', '.')}}</span></li>
                                    @endif
                                    @if($dados->venda == 1)
                                       <li>Valor Venda  :  <span >R$ {{number_format($dados->valor_venda, 2, ',', '.')}}</span></li>
                                    @endif



                                    @if($dados->bairro == null )
                                    @elseif($dados->bairro !== null)
                                       <li>Bairro  :   <span>{{$dados->bairro}}</span></li>
                                    @endif


                                    @if($dados->area_total == null )
                                    @elseif($dados->area_total !== null)
                                       <li>Área Total  :  <span>{{$dados->area_total}} M²</span></li>
                                    @endif
                                    @if($dados->area_util == null )
                                    @elseif($dados->area_util !== null)
                                       <li>Área Útil  :  <span >{{$dados->area_util}} M²</span></li>
                                    @endif


                                    @if($dados->impostos == null )
                                    @elseif($dados->impostos !== null)
                                       <li>Imposto  :  <span >R$ {{number_format($dados->impostos, 2, ',', '.')}}</span></li>
                                    @endif

                                    @if($dados->condominio == null )
                                    @elseif($dados->condominio !== null)
                                       <li>Condominio  :  <span >R$ {{number_format($dados->condominio, 2, ',', '.')}}</span></li>
                                    @endif

                                        @if($dados->taxas_extras == null )
                                        @elseif($dados->taxas_extras !== null)
                                            <li>Taxa Rateio  :  <span >R$ {{number_format($dados->taxas_extras, 2, ',', '.')}}</span></li>
                                        @endif

                                    @if($dados->tamanho_frente == null )
                                    @elseif($dados->tamanho_frente !== null)
                                       <li>Tamanho Frente  :  <span >{{$dados->tamanho_frente}} M²</span></li>
                                    @endif
                                    @if($dados->tamanho_fundo == null )
                                    @elseif($dados->tamanho_fundo !== null)
                                       <li>Tamanho Fundo  :  <span >{{$dados->tamanho_fundo}} M²</span></li>
                                    @endif

                                    @if($dados->ar_condicionado == 1)
                                       <li>Ar condicionado  :  <span >Sim</span></li>
                                    @endif
                                    @if($dados->bar == 1)
                                       <li>Bar  :  <span >Sim</span></li>
                                    @endif
                                    @if($dados->livraria == 1)
                                       <li>Livraria  :  <span >Sim</span></li>
                                    @endif
                                    @if($dados->churrasqueira == 1)
                                       <li>Churrasqueira  :  <span >Sim</span></li>
                                    @endif


                                        @if($dados->cozinha == 1)
                                            <li>Cozinha  :  <span >Sim</span></li>
                                        @endif

                                        @if($dados->cozinha_planejada == 1)
                                            <li>Cozinha Planejada  :  <span >Sim</span></li>
                                        @endif

                                    @if($dados->cozinha_equipada == 1)
                                       <li>Cozinha Equipada  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->cozinha_americana == 1)
                                       <li>Cozinha Americanas  :  <span >Sim</span></li>
                                    @endif


                                    @if($dados->escritorio == 1)
                                       <li>Escritório  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->lavatorio == 1)
                                       <li>Lavatório  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->piscina == 1)
                                       <li>Piscina  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->despensa == 1)
                                       <li>Despensa  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->edicula == 1)
                                       <li>Edicula  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->copa == 1)
                                       <li>Copa  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->terraco == 1)
                                       <li>Terraço  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->quarto_empregada == 1)
                                       <li>Quarto Empregada  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->banheiro_empregada == 1)
                                       <li>Banheiro Empregada  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->sala_com_lareira == 1)
                                       <li>Sala Com Lareira  :  <span >Sim</span></li>
                                    @endif


                                    @if($dados->banheiro_social == 1)
                                       <li>Banheiro Social  :  <span >Sim</span></li>
                                    @endif


                                    @if($dados->cerca_eletrica == 1)
                                       <li>Cerca Elétrica  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->poco_artesiano == 1)
                                       <li>Poço Artesiano  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->portao_eletronico == 1)
                                       <li>Portão Eletrônico  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->concertina == 1)
                                       <li>Concertina  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->elevador == 1)
                                       <li>Elevador  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->elevador == 1)
                                        <li>Escada  :  <span >Sim</span></li>
                                    @endif

                                    @if($dados->interfone == 1)
                                       <li>Interfone  :  <span >Sim</span></li>
                                    @endif




                                </ul>
							</div>
						</div>

                        @if($dados->mapa == [])

                        @else
                            <div class="property_title">Localização</div>
                                <?php

                                print($dados->mapa);
                                ?>
                        @endif

                        <br>

                        <div class="property_title">Gostou do Imóvel? Entre em contato!</div>
                        <br>
                        <div class="contact_form_container">
                            <form action="{{route('admin.email.store')}}" method="POST" class="contact_form" id="contact_form">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="idImovel" value="{{$dados->id}}">
                                    <!-- Nome -->
                                    <div class="col-lg-6 contact_name_col">
                                        <input type="text" class="contact_input" name="nome" placeholder="Nome" required="required">
                                    </div>
                                    <!-- Email -->
                                    <div class="col-lg-6">
                                        <input type="email" class="contact_input" name="email" placeholder="E-mail" required="required">
                                    </div>
                                </div>
                                <div>
                                    <input type="text" class="contact_input" placeholder="Telefone" name="telefone" >
                                </div>
                                <div>
                                    <input type="text" name="titulo" class="contact_input" placeholder="" value="Informações sobre o imóvel {{$dados->titulo}} ">
                                </div>
                                <div><textarea class="contact_textarea contact_input" name="mensagem" placeholder="Mensagem" required="required">Gostaria de saber mais informações sobre o imóvel: www.dudaimobiliariastm.com.br/imovel/detail/{{$dados->id}}</textarea></div>

                                <button class="contact_button button center">Enviar</button>
                            </form>
                        </div>
					</div>

				</div>



                </div>

			</div>
    </div>


	<!-- Newsletter -->

	<div class="newsletter">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="../../images/newsletter.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_content d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="newsletter_title_container">
							<div class="newsletter_title">Duda Imobiliaria</div>
							<div class="newsletter_subtitle">Encontre os melhores imóveis de Santarém e Região em um unico lugar!</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<!-- Footer -->

    <footer class="footer">
        <div class="footer_main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="footer_logo"><a href="#"><img src="../../images/duda.png" alt="" width="100px"></a></div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-lg-3">
                        <div class="footer_logo"><a href="#"><img src="images/logo_large.png" alt=""></a></div>
                    </div>
                    <div class="col-lg-9 d-flex flex-column align-items-start justify-content-end">
                        <div class="footer_title">Imóveis Semelhantes</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 footer_col">
                        <div class="footer_about">
                            <div class="footer_about_text">Donec in tempus leo. Aenean ultricies mauris sed quam lacinia lobortis. Cras ut vestibulum enim, in gravida nulla. Curab itur ornare nisl at sagittis cursus.</div>
                        </div>
                    </div>
                    <div class="col-lg-3 footer_col">
                        <div class="footer_latest d-flex flex-row align-items-start justify-content-start">
                            <div><div class="footer_latest_image"><img src="../../images/footer_latest_1.jpg" alt=""></div></div>
                            <div class="footer_latest_content">
                                <div class="footer_latest_location">Miami</div>
                                <div class="footer_latest_name"><a href="#">Sea view property</a></div>
                                <div class="footer_latest_price">$ 1. 234 981</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 footer_col">
                        <div class="footer_latest d-flex flex-row align-items-start justify-content-start">
                            <div><div class="footer_latest_image"><img src="../../images/footer_latest_2.jpg" alt=""></div></div>
                            <div class="footer_latest_content">
                                <div class="footer_latest_location">Miami</div>
                                <div class="footer_latest_name"><a href="#">Town House</a></div>
                                <div class="footer_latest_price">$ 1. 234 981</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 footer_col">
                        <div class="footer_latest d-flex flex-row align-items-start justify-content-start">
                            <div><div class="footer_latest_image"><img src="../../images/footer_latest_3.jpg" alt=""></div></div>
                            <div class="footer_latest_content">
                                <div class="footer_latest_location">Miami</div>
                                <div class="footer_latest_name"><a href="#">Modern House</a></div>
                                <div class="footer_latest_price">$ 1. 234 981</div>
                            </div>
                        </div>
                    </div>
                </div>-->

            </div>
        </div>
    </footer>
</div>
<script type="text/javascript">
    let modalId = $('#image-gallery');

    $(document)
        .ready(function () {

            loadGallery(true, 'a.thumbnail');

            //This function disables buttons when needed
            function disableButtons(counter_max, counter_current) {
                $('#show-previous-image, #show-next-image')
                    .show();
                if (counter_max === counter_current) {
                    $('#show-next-image')
                        .hide();
                } else if (counter_current === 1) {
                    $('#show-previous-image')
                        .hide();
                }
            }

            /**
             *
             * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
             * @param setClickAttr  Sets the attribute for the click handler.
             */

            function loadGallery(setIDs, setClickAttr) {
                let current_image,
                    selector,
                    counter = 0;

                $('#show-next-image, #show-previous-image')
                    .click(function () {
                        if ($(this)
                            .attr('id') === 'show-previous-image') {
                            current_image--;
                        } else {
                            current_image++;
                        }

                        selector = $('[data-image-id="' + current_image + '"]');
                        updateGallery(selector);
                    });

                function updateGallery(selector) {
                    let $sel = selector;
                    current_image = $sel.data('image-id');
                    $('#image-gallery-title')
                        .text($sel.data('title'));
                    $('#image-gallery-image')
                        .attr('src', $sel.data('image'));
                    disableButtons(counter, $sel.data('image-id'));
                }

                if (setIDs == true) {
                    $('[data-image-id]')
                        .each(function () {
                            counter++;
                            $(this)
                                .attr('data-image-id', counter);
                        });
                }
                $(setClickAttr)
                    .on('click', function () {
                        updateGallery($(this));
                    });
            }
        });

    // build key actions
    $(document)
        .keydown(function (e) {
            switch (e.which) {
                case 37: // left
                    if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
                        $('#show-previous-image')
                            .click();
                    }
                    break;

                case 39: // right
                    if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
                        $('#show-next-image')
                            .click();
                    }
                    break;

                default:
                    return; // exit this handler for other keys
            }
            e.preventDefault(); // prevent the default action (scroll / move caret)
        });

    //Filter Button

    $(document).ready(function(){

        $(".filter-button").click(function(){
            var value = $(this).attr('data-filter');

            if(value == "todo")
            {
                //$('.filter').removeClass('hidden');
                $('.filter').show('1000');
            }
            else
            {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                $(".filter").not('.'+value).hide('3000');
                $('.filter').filter('.'+value).show('3000');

            }
        });

    });


</script>
<script type="text/javascript">

    var latitude = document.getElementById("latitude");
    var longitude = document.getElementById("longitude");

    console.log(latitude.value);
    var map = new ol.Map({
        target: 'map',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([longitude, latitude]),
            zoom: 15
        })
    });
</script>
<script src="../../js/jquery-3.2.1.min.js"></script>
<script src="../../styles/bootstrap4/popper.js"></script>
<script src="../../styles/bootstrap4/bootstrap.min.js"></script>
<script src="../../plugins/greensock/TweenMax.min.js"></script>
<script src="../../plugins/greensock/TimelineMax.min.js"></script>
<script src="../../plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="../../plugins/greensock/animation.gsap.min.js"></script>
<script src="../../plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="../../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../../plugins/easing/easing.js"></script>
<script src="../../plugins/rangeslider.js-2.3.0/rangeslider.min.js"></script>
<script src="../../plugins/parallax-js-master/parallax.min.js"></script>
<script src="../../js/property.js"></script>
</body>
</html>
