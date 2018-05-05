<?php ob_start(); ?>
<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<?php
include_once "conexion.php";
include_once "utilidades.php";

$bd = new BaseDeDatos();
$a = new Utilidades();

$n = $a->ordenaraleatorio();

?>
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

<!--- basic page needs
    ================================================== -->
<meta charset="utf-8">
<?php $año=$_GET["a"] ?>
<title>MyMovieDB | <?php echo $año ?></title>
<meta name="description" content="">
<meta name="author" content="">

<!-- mobile specific metas
    ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSS
    ================================================== -->
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/vendor.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="flags/flags.css">
<link rel="stylesheet" href="ionicons/css/ionicons.min.css">

<!-- script
    ================================================== -->
<script src="js/modernizr.js"></script>
<script src="js/pace.min.js"></script>

<!-- favicons
    ================================================== -->
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">

</head>

<body id="top">

	<!-- header
    ================================================== -->
	<header class="s-header">

		<div class="header-logo">
			<a class="site-logo" href="index.php"> <img src="images/logo1.png"
				alt="Homepage">
			</a>
		</div>
	</header>
	<!-- end s-header -->


	<!-- home
    ================================================== -->
	<section id="home" class="s-home target-section" data-parallax="scroll"
		data-image-src="images/bg/<?php echo $n[0]; ?>"
		data-natural-width=1920 data-natural-height=1080
		data-position-y=center>

		<div class="overlay"></div>
		<div class="shadow-overlay"></div>

		<div class="home-content">

			<div class="row home-content__main">
				<table>
					<div class="col-block stats__col">
						<div class="stats__contador"><a href="#add" class="seven"><?php echo $año ?></a></div>
				
				</table>
			</div>
			<!-- end home-content -->
	
	</section>
	<!-- end s-home -->

	<section id='statis' class="s-statis">

		<div
			class="row about-stats stats block-1-4 block-m-1-2 block-mob-full"
			data-aos="fade-up">

			<div class="col-block stats__cole">
				<div class="stats__count">1</div>
				<h5></h5>
			</div>
			<div class="col-block stats__col">
				<div class="stats__count"><?php echo $bd->contar("titulopelicula,fechastitulos", "titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fecha)=".$año) ?></div>
				<h5>FILMS IN <?php echo $año ?></h5>
			</div>
			<div class="col-block stats__col">
				<div class="stats__count"><?php echo $bd->contar("titulopelicula", "año=".$año) ?></div>
				<h5><?php echo $año ?> FILMS</h5>
			</div>
			<div class="col-block stats__cole">
				<div class="stats__count">1</div>
				<h5></h5>
			</div>

		</div>
		<br>
		<br>

		<div class="row section-header has-bottom-sep" data-aos="fade-up">
			<div class="col-full">
				<h3 class="subhead subhead--dark">MOST SEEN</h3>
				<h1 class="display-1 display-1--light">ACTORS</h1>
			</div>
		</div>
		<!-- end section-header -->

		<div class="row statis-desc" data-aos="fade-up">
			<div class="col-full">
				<p>
				
				
				<div class="table-responsive">

					<table>
						<thead>
							<tr>
								<td><h4>Actor</h4></td>
								<td><h4>#</h4></td>
							</tr>
						</thead>
						<tbody>
<?php $bd->ranking("peliculasactores", "id_actor", "and sexo=2 and YEAR(fecha)=".$año, false); ?>
</tbody>
					</table>

				</div>
				</p>
			</div>
		</div>
		<!-- end diary-desc -->
		<br> <br>
		<div class="row section-header has-bottom-sep" data-aos="fade-up">
			<div class="col-full">
				<h3 class="subhead subhead--dark">MOST SEEN</h3>
				<h1 class="display-1 display-1--light">ACTRESSES</h1>
			</div>
		</div>
		<!-- end section-header -->

		<div class="row statis-desc" data-aos="fade-up">
			<div class="col-full">
				<p>
				
				
				<div class="table-responsive">

					<table>
						<thead>
							<tr>
								<td><h4>Actress</h4></td>
								<td><h4>#</h4></td>
							</tr>
						</thead>
						<tbody>
<?php $bd->ranking("peliculasactores", "id_actor", "and sexo=1 and YEAR(fecha)=".$año, false); ?>
</tbody>
					</table>

				</div>
				</p>
			</div>
		</div>
		<!-- end diary-desc -->
		<br>
		<div class="row section-header has-bottom-sep" data-aos="fade-up">
			<div class="col-full">
				<h3 class="subhead subhead--dark">MOST SEEN</h3>
				<h1 class="display-1 display-1--light">DIRECTORS</h1>
			</div>
		</div>
		<!-- end section-header -->

		<div class="row statis-desc" data-aos="fade-up">
			<div class="col-full">
				<p>
				
				
				<div class="table-responsive">

					<table>
						<thead>
							<tr>
								<td><h4>Director</h4></td>
								<td><h4>#</h4></td>
							</tr>
						</thead>
						<tbody>
							<?php $bd->ranking("titulosdirectores", "id_director",  "and YEAR(fecha)=".$año, false); ?>
						</tbody>
					</table>

				</div>
				</p>
			</div>
		</div>
		<!-- end diary-desc -->
		<br>
		<div class="row section-header has-bottom-sep" data-aos="fade-up">
			<div class="col-full">
				<h3 class="subhead subhead--dark">MOST SEEN</h3>
				<h1 class="display-1 display-1--light">COUNTRIES</h1>
			</div>
		</div>
		<!-- end section-header -->

		<div class="row statis-desc" data-aos="fade-up">
			<div class="col-full">
				<p>
				
				
				<div class="table-responsive">

					<table>
						<thead>
							<tr>
								<td><h4>Country</h4></td>
								<td><h4>#</h4></td>
							</tr>
						</thead>
						<tbody>
							<?php $bd->paises(" and YEAR(fecha)=".$año); ?>

						</tbody>
					</table>

				</div>
				</p>
			</div>
		</div>
		<!-- end diary-desc -->
	</section>
	
<!-- home
    ================================================== -->
	<section id="home" class="s-home target-section" data-parallax="scroll"
		data-image-src="images/bg/<?php echo $n[1]; ?>"
		data-natural-width=1920 data-natural-height=1080
		data-position-y=center>

		<div class="overlay"></div>
		<div class="shadow-overlay"></div>

		<div class="home-content">

			<div class="row home-content__main">
						<div class="salami"><section id="add">FILMS</section></div><BR>

<table>
	<thead>
		<tr>
			<td class="two">Film</td>
			<td class="two">Date</td>
		</tr>
	</thead>
	<tbody>
	        		<tr>
			<td class="one"><a
				href="#"
				class="three">Lady Bird</a></td>
			<td class="one">2018/02/25</td>
			<td class="one"><a href="#" class="three"><i class="ion-edit"></i></a></td>
		</tr>
		
				<tr>
			<td class="one"><a
				href="#"
				class="three">Moonlight</a></td>
			<td class="one">2018/02/25</td>
			<td class="one"><a href="#" class="three"><i class="ion-edit"></i></a></td>
		</tr>
		
				<tr>
			<td class="one"><a
				href="#"
				class="three">The Lord of the Rings</a></td>
			<td class="one">2018/02/25</td>
			<td class="one"><a href="#" class="three"><i class="ion-edit"></i></a></td>
		</tr>
		
				<tr>
			<td class="one"><a
				href="#"
				class="three">13</a></td>
			<td class="one">2018/02/25</td>
			<td class="one"><a href="#" class="three"><i class="ion-edit"></i></a></td>
		</tr>
		
				<tr>
			<td class="one"><a
				href="#"
				class="three">Get Out</a></td>
			<td class="one">2018/02/25</td>
			<td class="one"><a href="#" class="three"><i class="ion-edit"></i></a></td>
		</tr>
		
				<tr>
			<td class="one"><a
				href="#"
				class="three">Mad Max: Fury Road</a></td>
			<td class="one">2018/02/25</td>
			<td class="one"><a href="#" class="three"><i class="ion-edit"></i></a></td>
		</tr>
		
		 
	</tbody>
</table>
			</div>
			<!-- end home-content -->
	
	</section>
	<!-- end s-home -->
	
	
	<!-- footer
    ================================================== -->
	<footer>
		<div class="row footer-bottom">

			<div class="col-twelve">
				<div class="copyright">
					<span>© Copyright Glint 2017</span> <span>Site Template by <a
						href="https://www.colorlib.com/">Colorlib</a></span>
				</div>

				<div class="go-top">
					<a class="smoothscroll" title="Back to Top" href="#top"><i
						class="icon-arrow-up" aria-hidden="true"></i></a>
				</div>
			</div>

		</div>
		<!-- end footer-bottom -->

	</footer>
	<!-- end footer -->


	<!-- photoswipe background
    ================================================== -->
	<div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

		<div class="pswp__bg"></div>
		<div class="pswp__scroll-wrap">

			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>

			<div class="pswp__ui pswp__ui--hidden">
				<div class="pswp__top-bar">
					<div class="pswp__counter"></div>
					<button class="pswp__button pswp__button--close"
						title="Close (Esc)"></button>
					<button class="pswp__button pswp__button--share" title="Share"></button>
					<button class="pswp__button pswp__button--fs"
						title="Toggle fullscreen"></button>
					<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
							<div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							</div>
						</div>
					</div>
				</div>
				<div
					class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div>
				</div>
				<button class="pswp__button pswp__button--arrow--left"
					title="Previous (arrow left)"></button>
				<button class="pswp__button pswp__button--arrow--right"
					title="Next (arrow right)"></button>
				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>
			</div>

		</div>

	</div>
	<!-- end photoSwipe background -->


	<!-- preloader
    ================================================== -->
	<div id="preloader">
		<div id="loader">
			<div class="line-scale-pulse-out">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</div>


	<!-- Java Script
    ================================================== -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>