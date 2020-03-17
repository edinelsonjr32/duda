<!DOCTYPE html>
<html lang="en">
<head>
<title>Duda Imobiliária | Imóveis</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Duda Imobiliária Santarém">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../../styles/bootstrap4/bootstrap.min.css">
<link href="../../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../../styles/properties.css">
<link rel="stylesheet" type="text/css" href="../../styles/properties_responsive.css">
    <style type="text/css">
        .whatsapp {position: fixed;top: 82%;left: 92%;padding: 10px;z-index: 10000000;}
    </style>
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
                                <li class="active"><a href="{{route('site.sobre')}}">Sobre nós</a></li>
                                <li><a href="{{route('site.corretores')}}">Corretores</a></li>
                                <li><a href="{{route('site.imoveis')}}">Imóveis</a></li>
                                <li><a href="{{route('site.correspondentes')}}">Financiamento</a></li>
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
				<a href="/">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="../../images/duda.png" alt=""></div></div>
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

	<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="../../images/properties.jpg" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content d-flex flex-row align-items-end justify-content-start">
							<div class="home_title">Busca avançada</div>
							<div class="breadcrumbs ml-auto">
								<ul>
									<li><a href="index.htmo">Ínicio</a></li>
									<li>Imóveis</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div><a href="https://api.whatsapp.com/send?phone=+5593991216151&text=Entre em Contato" target="_blank"><img class="whatsapp" src="https://imobiliariasinai.com.br/wp-content/uploads/2015/10/whatsapp.png" style="width: 80px"/></a></div>

    <!-- Home Search -->
	<div class="home_search">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_search_container">
						<div class="home_search_content">
                            <form method="POST" action="{{ route('imoveis.busca') }}" class="search_form d-flex flex-row align-items-start justfy-content-start">
                                @csrf
                            <div class="search_form_content d-flex flex-row align-items-start justfy-content-start flex-wrap">
									<div>
										<select class="search_form_select" name="tipoBusca">
											<option value="">Tipo Busca</option>
											<option value="1">Aluguel</option>
											<option  value="2">Venda</option>
										</select>
									</div>
									<div>
										<select class="search_form_select" name="tipo_imovel">
											<option value="">Tipo de Imóvel</option>
                                            @foreach($tipoImoveis as $tipoImovel)
                                                <option  value="{{$tipoImovel->id}}">{{$tipoImovel->nome}}</option>
                                            @endforeach
										</select>
									</div>
									<div>
										<select class="search_form_select" name="quartos">
											<option value="">Quartos</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
										</select>
									</div>
									<div>
										<select class="search_form_select" name="suites">
											<option value="">Suites</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
										</select>
									</div>
									<div>
										<select class="search_form_select" name="banheiros">
											<option value="">Banheiros</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
										</select>
									</div>
								</div>
								<button class="search_form_button ml-auto">Buscar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Properties -->

	<div class="properties">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title">{{$count}} Propriedades Cadastradas</div>
					<div class="section_subtitle">Busque seu imóvel aqui</div>
				</div>
			</div>
			<div class="row properties_row">

				<!-- Property -->
                @foreach($dadoImoveis as $dado)
                    <div class="col-xl-4 col-lg-6 property_col">
                        <div class="property">
                            <div class="property_image">
                                <img src="{{ url("/imovel/images/{$dado->path}") }}" alt="" style="width: 400px; height: 300px" >
                                @if($dado->venda == 1 && $dado->aluguel == 1)
                                    <div class="tag_featured property_tag" style="background-color: #5cd08d"><a href="#">Venda e Aluguel</a></div>
                                @elseif($dado->venda == 1)
                                    <div class="tag_featured property_tag"><a href="#">Venda</a></div>
                                @elseif($dado->aluguel == 1)
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
                            <div class="property_footer d-flex flex-row align-items-center justify-content-start">
                                @if($dado->area_total == null)

                                @elseif($dado->area_total !== null)
                                    <div><div class="property_icon"><img src="images/icon_1.png" alt=""></div><span>{{$dado->area_total}} M²</span></div>
                                @endif

                                @if($dado->quartos == null)

                                @elseif($dado->quartos !== null)
                                    <div><div class="property_icon"><img src="images/icon_2.png" alt=""></div><span>{{$dado->quartos}} Quartos</span></div>
                                @endif

                                @if($dado->suites == null)

                                @elseif($dado->suites !== null)
                                    <div><div class="property_icon"><img src="images/icon_2.png" alt=""></div><span>{{$dado->suites}} Suites</span></div>
                                @endif


                                @if($dado->banheiros == null)

                                @elseif($dado->banheiros !== null)
                                    <div><div class="property_icon"><img src="images/icon_3.png" alt=""></div><span>{{$dado->banheiros}} Banheiros</span></div>
                                @endif

                            </div>

                        </div>
                    </div>
                @endforeach

			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="pagination">
						{{$dadoImoveis->links()}}
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

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

    <footer class="footer">
        <div class="footer_main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="footer_logo"><a href="#"><img src="images/duda.png" alt="" width="100px"></a></div>
                    </div>
                </div>

            </div>
        </div>

    </footer>
</div>

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
<script src="../../plugins/parallax-js-master/parallax.min.js"></script>
<script src="../../js/properties.js"></script>
</body>
</html>
