<!DOCTYPE html>
<html lang="en">
<head>
<title>Elements</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Duda Imobiliária Santarém">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/elements.css">
    <style type="text/css">
        .whatsapp {position: fixed;top: 82%;left: 92%;padding: 10px;z-index: 10000000;}
    </style>
<link rel="stylesheet" type="text/css" href="styles/elements_responsive.css">
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
							<a href="#"><img src="images/logo.png" alt=""></a>
						</div>
						<nav class="main_nav">
							<ul>
								<li><a href="index">Home</a></li>
								<li><a href="about">About us</a></li>
								<li><a href="properties">Properties</a></li>
								<li><a href="news">News</a></li>
								<li><a href="contact">Contact</a></li>
							</ul>
						</nav>
						<div class="phone_num ml-auto">
							<div class="phone_num_inner">
								<img src="images/phone.png" alt=""><span>652-345 3222 11</span>
							</div>
						</div>
						<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Menu -->

    <div><a href="https://api.whatsapp.com/send?phone=+5593991216151&text=Entre em Contato" target="_blank"><img class="whatsapp" src="https://imobiliariasinai.com.br/wp-content/uploads/2015/10/whatsapp.png" style="width: 80px"/></a></div>


    <div class="menu trans_500">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo menu_logo">
				<a href="#">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
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
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/elements.jpg" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content d-flex flex-row align-items-end justify-content-start">
							<div class="home_title">Elements</div>
							<div class="breadcrumbs ml-auto">
								<ul>
									<li><a href="index.htmo">Home</a></li>
									<li>Elements</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Home Search -->
	<div class="home_search">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_search_container">
						<div class="home_search_content">
							<form action="#" class="search_form d-flex flex-row align-items-start justfy-content-start">
								<div class="search_form_content d-flex flex-row align-items-start justfy-content-start flex-wrap">
									<div>
										<select class="search_form_select">
											<option disabled selected>For rent</option>
											<option>Yes</option>
											<option>No</option>
										</select>
									</div>
									<div>
										<select class="search_form_select">
											<option disabled selected>All types</option>
											<option>Type 1</option>
											<option>Type 2</option>
											<option>Type 3</option>
											<option>Type 4</option>
										</select>
									</div>
									<div>
										<select class="search_form_select">
											<option disabled selected>City</option>
											<option>New York</option>
											<option>Paris</option>
											<option>Amsterdam</option>
											<option>Rome</option>
										</select>
									</div>
									<div>
										<select class="search_form_select">
											<option disabled selected>Bedrooms</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
										</select>
									</div>
									<div>
										<select class="search_form_select">
											<option disabled selected>Bathrooms</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
									</div>
								</div>
								<button class="search_form_button ml-auto">search</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Elements -->

	<div class="elements">
		<div class="container">
			<div class="row">
				<div class="col">

					<!-- Buttons -->
					<div class="buttons">
						<div class="elements_title">Buttons</div>
						<div class="buttons_container">
							<div class="button button_1"><a href="#">send</a></div>
							<div class="button button_2"><a href="#">send</a></div>
							<div class="button button_3"><div><a href="#">send</a></div></div>
						</div>
					</div>

					<!-- Accordions & Tabs -->

					<div class="elements_accordions_tabs">
						<div class="elements_title">Accordions & Tabs</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="elements_accordions">
									<div class="accordions">

										<div class="accordion_container">
											<div class="accordion d-flex flex-row align-items-center"><div>Sed at massa maximus, tempus elit nec, feugiat enim. </div></div>
											<div class="accordion_panel">
												<div>
													<p>Sed at massa maximus, tempus elit nec, feugiat enim. Sed at massa maximus, tempus elit nec, feugiat enim. Etiam ultricies purus ac neque interdum, molestie blandit velit condimentum. Integer consectetur nunc ac imperdiet.</p>
												</div>
											</div>
										</div>

										<div class="accordion_container">
											<div class="accordion d-flex flex-row align-items-center"><div>Massa maximus, tempus elit nec, feugiat enim. </div></div>
											<div class="accordion_panel">
												<div>
													<p>Sed at massa maximus, tempus elit nec, feugiat enim. Sed at massa maximus, tempus elit nec, feugiat enim. Etiam ultricies purus ac neque interdum, molestie blandit velit condimentum. Integer consectetur nunc ac imperdiet.</p>
												</div>
											</div>
										</div>

										<div class="accordion_container">
											<div class="accordion d-flex flex-row align-items-center active"><div>Etiam ultricies purus ac neque interdum</div></div>
											<div class="accordion_panel">
												<div>
													<p>Sed at massa maximus, tempus elit nec, feugiat enim. Sed at massa maximus, tempus elit nec, feugiat enim. Etiam ultricies purus ac neque interdum, molestie blandit velit condimentum. Integer consectetur nunc ac imperdiet.</p>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="tabs">
									<div class="tabs_container">
										<div class="tabs d-flex flex-row align-items-center justify-content-start flex-wrap">
											<div class="tab">Sed at massa maxim</div>
											<div class="tab">Tempus elit necrdm</div>
											<div class="tab active">Elit necrdm</div>
										</div>
										<div class="tab_panels">
											<div class="tab_panel">
												<div class="tab_panel_content">
													<div class="tab_text">
														<p>Sed at massa maximus, tempus elit nec, feugiat enim. Etiam ultricies purus ac neque interdum, molestie blandit velit condimentum. Integer consectetur nunc ac imperdiet dignissim. Vivamus dignissim nisl tellus, vitae euismod lorem volutpat vitae. Suspendisse quis pharetra est. Duis et massa massa. Duis vel ul</p>
													</div>
												</div>
											</div>
											<div class="tab_panel">
												<div class="tab_panel_content">
													<div class="tab_text">
														<p>Sed at massa maximus, tempus elit nec, feugiat enim. Etiam ultricies purus ac neque interdum, molestie blandit velit condimentum. Integer consectetur nunc ac imperdiet dignissim. Vivamus dignissim nisl tellus, vitae euismod lorem volutpat vitae. Suspendisse quis pharetra est. Duis et massa massa. Duis vel ul</p>
													</div>
												</div>
											</div>
											<div class="tab_panel active">
												<div class="tab_panel_content">
													<div class="tab_text">
														<p>Sed at massa maximus, tempus elit nec, feugiat enim. Etiam ultricies purus ac neque interdum, molestie blandit velit condimentum. Integer consectetur nunc ac imperdiet dignissim. Vivamus dignissim nisl tellus, vitae euismod lorem volutpat vitae. Suspendisse quis pharetra est. Duis et massa massa. Duis vel ul</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Milestones -->

					<div class="milestones">
						<div class="elements_title">Milestones</div>
						<div class="row milestones_row">

							<!-- Milestone -->
							<div class="col-lg-3 milestone_col">
								<div class="milestone d-flex flex-row align-items-center justify-content-start">
									<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="images/milestones_1.png" alt=""></div>
									<div class="milestone_content">
										<div class="milestone_counter" data-end-value="651">0</div>
										<div class="milestone_text">Properties Sold</div>
									</div>
								</div>
							</div>

							<!-- Milestone -->
							<div class="col-lg-3 milestone_col">
								<div class="milestone d-flex flex-row align-items-center justify-content-start">
									<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="images/milestones_2.png" alt=""></div>
									<div class="milestone_content">
										<div class="milestone_counter" data-end-value="1256">0</div>
										<div class="milestone_text">Happy Clients</div>
									</div>
								</div>
							</div>

							<!-- Milestone -->
							<div class="col-lg-3 milestone_col">
								<div class="milestone d-flex flex-row align-items-center justify-content-start">
									<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="images/milestones_3.png" alt=""></div>
									<div class="milestone_content">
										<div class="milestone_counter" data-end-value="124">0</div>
										<div class="milestone_text">Buildings Sold</div>
									</div>

								</div>
							</div>

							<!-- Milestone -->
							<div class="col-lg-3 milestone_col">
								<div class="milestone d-flex flex-row align-items-center justify-content-start">
									<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="images/milestones_4.png" alt=""></div>
									<div class="milestone_content">
										<div class="milestone_counter" data-end-value="25">0</div>
										<div class="milestone_text">Awards Won</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					<!-- Loaders -->

					<div class="loaders">
						<div class="elements_title">Loaders</div>
						<div class="loaders_container">
							<div class="row elements_loaders_container">
								<div class="col-lg-3 loader_col">
									<!-- Loader -->
									<div class="circle loader" data-value="1.0">
										<strong><i></i></strong>
										<span>Commitment</span>
									</div>
								</div>
								<div class="col-lg-3 loader_col">
									<!-- Loader -->
									<div class="circle loader" data-value="0.80">
										<strong><i></i></strong>
										<span>Sold properties</span>
									</div>
								</div>
								<div class="col-lg-3 loader_col">
									<div class="circle loader" data-value="0.70">
										<strong><i></i></strong>
										<span>Vacation Homes</span>
									</div>
								</div>
								<div class="col-lg-3 loader_col">
									<div class="circle loader" data-value="0.65">
										<strong><i></i></strong>
										<span>Rentals</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Icon Boxes -->

					<div class="icon_boxes">
						<div class="elements_title">Icon Boxes</div>
						<div class="row icon_boxes_row">

							<!-- Icon Box -->
							<div class="col-lg-4 icon_box_col">
								<div class="icon_box">
									<div class="icon_box_title_container d-flex flex-row align-items-center justify-content-start">
										<div class="icon_box_icon d-flex flex-column align-items-center justify-content-center"><img src="images/icon_4.png" alt=""></div>
										<div class="icon_box_title">Amazing Homes</div>
									</div>
									<div class="icon_box_text">
										<p>Sed at massa maximus, tempus elit nec, feugiat enim. Sed at massa maximus, tempus elit nec, feugiat enim. Etiam ultricies purus ac neque.</p>
									</div>
								</div>
							</div>

							<!-- Icon Box -->
							<div class="col-lg-4 icon_box_col">
								<div class="icon_box">
									<div class="icon_box_title_container d-flex flex-row align-items-center justify-content-start">
										<div class="icon_box_icon"><img src="images/icon_5.png" alt=""></div>
										<div class="icon_box_title">Friendly Realtors</div>
									</div>
									<div class="icon_box_text">
										<p>Sed at massa maximus, tempus elit nec, feugiat enim. Sed at massa maximus, tempus elit nec, feugiat enim. Etiam ultricies purus ac neque.</p>
									</div>
								</div>
							</div>

							<!-- Icon Box -->
							<div class="col-lg-4 icon_box_col">
								<div class="icon_box">
									<div class="icon_box_title_container d-flex flex-row align-items-center justify-content-start">
										<div class="icon_box_icon"><img src="images/icon_6.png" alt=""></div>
										<div class="icon_box_title">The Best Deals</div>
									</div>
									<div class="icon_box_text">
										<p>Sed at massa maximus, tempus elit nec, feugiat enim. Sed at massa maximus, tempus elit nec, feugiat enim. Etiam ultricies purus ac neque.</p>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/newsletter.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_content d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="newsletter_title_container">
							<div class="newsletter_title">Are you buying or selling?</div>
							<div class="newsletter_subtitle">Search your dream home</div>
						</div>
						<div class="newsletter_form_container">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" placeholder="Your e-mail address" required="required">
								<button class="newsletter_button">subscribe now</button>
							</form>
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
						<div class="footer_logo"><a href="#"><img src="images/logo_large.png" alt=""></a></div>
					</div>
					<div class="col-lg-9 d-flex flex-column align-items-start justify-content-end">
						<div class="footer_title">Latest Properties</div>
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
							<div><div class="footer_latest_image"><img src="images/footer_latest_1.jpg" alt=""></div></div>
							<div class="footer_latest_content">
								<div class="footer_latest_location">Miami</div>
								<div class="footer_latest_name"><a href="#">Sea view property</a></div>
								<div class="footer_latest_price">$ 1. 234 981</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 footer_col">
						<div class="footer_latest d-flex flex-row align-items-start justify-content-start">
							<div><div class="footer_latest_image"><img src="images/footer_latest_2.jpg" alt=""></div></div>
							<div class="footer_latest_content">
								<div class="footer_latest_location">Miami</div>
								<div class="footer_latest_name"><a href="#">Town House</a></div>
								<div class="footer_latest_price">$ 1. 234 981</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 footer_col">
						<div class="footer_latest d-flex flex-row align-items-start justify-content-start">
							<div><div class="footer_latest_image"><img src="images/footer_latest_3.jpg" alt=""></div></div>
							<div class="footer_latest_content">
								<div class="footer_latest_location">Miami</div>
								<div class="footer_latest_name"><a href="#">Modern House</a></div>
								<div class="footer_latest_price">$ 1. 234 981</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer_bar">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_bar_content d-flex flex-row align-items-center justify-content-start">

							<div class="footer_nav">
								<ul>
									<li><a href="index">Home</a></li>
									<li><a href="#">About us</a></li>
									<li><a href="properties">Properties</a></li>
									<li><a href="news">News</a></li>
									<li><a href="contact">Contact</a></li>
								</ul>
							</div>
							<div class="footer_phone ml-auto"><span>call us: </span>652 345 3222 11</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/jquery-circle-progress-1.2.2/circle-progress.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/elements.js"></script>
</body>
</html>
