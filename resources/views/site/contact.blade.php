<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="description" content="Duda Imobiliária Santarém">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/rangeslider.js-2.3.0/rangeslider.css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
    <style>
        #mapa {
            height:400px;
            width:400px;
        }
    </style>

    <style type="text/css">
        .whatsapp {position: fixed;top: 82%;left: 92%;padding: 10px;z-index: 10000000;}
    </style>

<link rel="stylesheet" type="text/css" href="styles/properties.css">
<link rel="stylesheet" type="text/css" href="styles/properties_responsive.css">
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
							<a href="#"><img src="images/duda.png" alt=""></a>
						</div>
						<nav class="main_nav">
							<ul>
                                <li ><a href="{{route('site.index')}}">Inicio</a></li>
                                <li ><a href="{{route('site.sobre')}}">Sobre nós</a></li>
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
				<a href="#">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="images/duda.png" alt=""></div></div>
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
    <div><a href="https://api.whatsapp.com/send?phone=+5593991216151&text=Entre em Contato" target="_blank"><img class="whatsapp" src="https://imobiliariasinai.com.br/wp-content/uploads/2015/10/whatsapp.png" style="width: 80px"/></a></div>



    <div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/about.jpg" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content d-flex flex-row align-items-end justify-content-start">
							<div class="home_title">Contato</div>
							<div class="breadcrumbs ml-auto">
								<ul>
									<li><a href="index.htmo">Inicio</a></li>
									<li>Contato</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Contact -->

	<div class="contact">
		<div class="container">
			<div class="row">

				<!-- Contact Info -->
				<div class="col-lg-4">
					<div class="contact_info">
						<div class="section_title">Caso tenha alguma dúvida.</div>
						<div class="contact_info_content">
							<ul class="contact_info_list">
								<li>
									<div>Endereço:</div>
									<div>1481 Creekside Lane Avila Beach, CA 93424</div>
								</li>
								<li>
									<div>Telefone:</div>
									<div>+53 345 7953 32453</div>
								</li>
								<li>
									<div>Email:</div>
									<div>yourmail@gmail.com</div>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Contact Form -->
				<div class="col-lg-8">
					<div class="contact_form_container">
						<form action="#" class="contact_form" id="contact_form">
							<div class="row">
								<!-- Name -->
								<div class="col-lg-6 contact_name_col">
									<input type="text" class="contact_input" placeholder="Name" required="required">
								</div>
								<!-- Email -->
								<div class="col-lg-6">
									<input type="email" class="contact_input" placeholder="E-mail" required="required">
								</div>
							</div>
							<div><input type="text" class="contact_input" placeholder="Subject"></div>
							<div><textarea class="contact_textarea contact_input" placeholder="Message" required="required"></textarea></div>
							<button class="contact_button button">Enviar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Map -->

    <div id="mapa"></div>

	<div class="newsletter">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/newsletter.jpg" data-speed="0.8"></div>
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
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/rangeslider.js-2.3.0/rangeslider.min.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script>

    function inicializar() {
        var coordenadas = {lat: -22.912869, lng: -43.228963};

        var mapa = new google.maps.Map(document.getElementById('mapa'), {
            zoom: 15,
            center: coordenadas
        });

        var marker = new google.maps.Marker({
            position: coordenadas,
            map: mapa,
            title: 'Localização'
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_XfiGN31eY7b-P07Fg7DpnW-gXCVi10M&callback=inicializar">
</script>
<script src="js/contact.js"></script>
</body>
</html>
