<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<?php
include_once "conexion.php";
include_once "utilidades.php";
include_once "utilidadespaises.php";
$bd = new BaseDeDatos();
$ut = new Utilidades();
$rol = $ut->conocidopor($_GET["id"]);

$fondo = $bd->fondodepeliculadepersona($_GET["id"], $rol);

$utp = new UtilidadesPaises();
$datos = $ut->htmltojson("https://api.themoviedb.org/3/person/" . $_GET["id"] . "?api_key=3f533c5423eaf11962eb53403fccff33&language=en-US");

?>
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

<!--- basic page needs
    ================================================== -->
<meta charset="utf-8">
<title>MyMovieDB | <?php echo $datos["name"] ?></title>
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

		<nav class="header-nav">

			<a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

			<div class="header-nav__content">
				<h3>Navigation</h3>

				<ul class="header-nav__list">
					<li class="current"><a class="smoothscroll" href="#home"
						title="home">Home</a></li>
					<li><a class="smoothscroll" href="#diary" title="diary">diary</a></li>
					<li><a class="smoothscroll" href="#contactis" title="contactis">contactis</a></li>
				</ul>

				<p>
					Perspiciatis hic praesentium nesciunt. Et neque a dolorum <a
						href='#0'>voluptatem</a> porro iusto sequi veritatis libero enim.
					Iusto id suscipit veritatis neque reprehenderit.
				</p>



			</div>
			<!-- end header-nav__content -->

		</nav>
		<!-- end header-nav -->

	</header>
	<!-- end s-header -->


	<!-- home
    ================================================== -->
	<section id="contactis" class="s-contactis target-section"
		data-parallax="scroll"
		data-image-src="https://image.tmdb.org/t/p/original<?php echo $fondo["file_path"]; ?>"
		data-natural-width=<?php echo $fondo["width"] ?>
		data-natural-height=<?php echo $fondo["height"] ?>
		data-position-y=center">

		<div class="overlay"></div>

		<div class="row section-header" data-aos="fade-up">
			<div class="col-full">
				<h1 class="display-2 display-2--light"><?php echo $datos["name"]; ?></h1>
			</div>
		</div>

		<div class="row contactis-content" data-aos="fade-up">

			<div class="contactis-primary">
				<form name="contactisForm" id="contactisForm" method="post"
					action="" novalidate="novalidate">
					<br>
					<div class="debajoimagen2">role:</div>
					<div class="debajoimagen3"><?php echo $rol; ?></div>
					<br>
					<div class="debajoimagen2">gender:</div>
					<div class="debajoimagen3"><?php $ut->sexo($datos["gender"], false); ?></div>
					<br>
					<div class="debajoimagen2">known for:</div>
					<div class="debajoimagen3"><?php echo $bd->peliculasdepersonarol($_GET["id"], $rol); ?></div>
					<br>
					<div class="debajoimagen2">you've watched:</div>
					<div class="debajoimagen3">
						<ul class="skill-bars">
							<li>
							<?php $por=$bd->peliculasexternaspersona($_GET["id"], $rol); ?>
								<div class="progress percent<?php echo $por; ?>">
									<span><?php echo $por; ?>%</span>
								</div>
							</li>
						</ul>
					</div>
				</form>

				<!-- contactis-warning -->
				<div class="message-warning">Something went wrong. Please try again.
				</div>

				<!-- contactis-success -->
				<div class="message-success">
					Your film was added.<br>
				</div>

			</div>
			<!-- end contactis-primary -->

			<div class="contactis-secondary">
				<div class="contactis-info">
					<p> <?php if (!empty($datos["profile_path"])) { ?>
						<img
							src="https://image.tmdb.org/t/p/w500
							<?php echo $datos["profile_path"]  ?>"
							srcset="https://image.tmdb.org/t/p/w500
							<?php echo $datos["profile_path"]  ?>"
							, 
                    <?php echo $datos["profile_path"] ?> 500w"
                    sizes="(max-width: 1000px) 100vw, 1000px"
							alt="Film Cover">
							<?php } else { ?> <img src="images/no-person.jpg"> <?php  } ?>
					</p>
				</div>
				<!-- end contactis-info -->
				<div class="debajoimagen">
					<a href="#"><?php if (!empty($datos["place_of_birth"])){echo $utp->nacimientopais($datos["place_of_birth"]); } ?></a>
				</div>
				<br>
				<div class="debajoimagen"><?php if (!empty($datos["birthday"])) { echo $ut->fechaesp($datos["birthday"]); } ?></div>
				<br>
				<div class="debajoimagen"><?php if (!empty($datos["deathday"])) { echo $ut->fechaesp($datos["deathday"]); } ?></div>
				<div class="debajoimagen">
					<a href="editperson.php?id=<?php echo $_GET["id"] ?>" class="seven"><i
						class="ion-edit"></i></a>
				</div>
			</div>
			<!-- end contactis-secondary -->

		</div>
		<!-- end contactis-content -->

	</section>
	<!-- end s-contactis -->

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