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
$utp = new UtilidadesPaises();
if (! isset($_POST["edit"])) {
    $datos = $bd->datospelicula($_GET["id"]);
    $fondo = $ut->ordenaraleatorio();
    ?>
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

<!--- basic page needs
    ================================================== -->
<meta charset="utf-8">
<title>MyMovieDB | Edit " <?php echo $datos["titulo_original"]; ?> "</title>
<form name="edit" id="edit" method="post" action=""
	novalidate="novalidate">
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
		</nav>
		<!-- end header-nav -->

	</header>
	<!-- end s-header -->


	<!-- home
    ================================================== -->
	<section id="contactis" class="s-contactis target-section"
		data-parallax="scroll"
		data-image-src="images/bg/<?php echo $fondo[0]; ?>"
		data-natural-width=1920 data-natural-height=1080
		data-position-y=center">

		<div class="overlay"></div>

		<div class="row section-header" data-aos="fade-up">
			<div class="col-full">
				<h1 class="display-2 display-2--light">
					<div class="form-field">
						<input name="titulo" type="text" id="titulo"
							placeholder="Original Title"
							value="<?php echo $datos["titulo_original"]; ?>" minlength="2"
							required="" aria-required="true" class="full-width">
					</div>
				</h1>
				<div class="fuet">
					<div class="form-field">
						<input name="tagline" type="text" id="tagline"
							placeholder="Tagline" value="<?php echo $datos["tagline"]  ?>"
							minlength="2" required="" aria-required="true" class="full-width">
					</div>
				</div>
			</div>
		</div>

		<div class="row contactis-content" data-aos="fade-up">

			<div class="contactis-primary">
				<form name="contactisForm" id="contactisForm" method="post"
					action="" novalidate="novalidate">
					<div class="debajoimagen2">Director:</div>
					<div class="debajoimagen3">
						<div class="form-field">
							<input name="link" type="text" id="link"
								placeholder="LARS VON TRIER" value="" minlength="2" required=""
								aria-required="true" class="full-width">
						</div>
					</div>
					<br>
					<div class="debajoimagen2">Screenwriter:</div>
					<div class="debajoimagen3">
						<div class="form-field">
							<input name="link" type="text" id="link"
								placeholder="LARS VON TRIER" value="" minlength="2" required=""
								aria-required="true" class="full-width">
						</div>
					</div>
					<br>
					<div class="debajoimagen2">Music:</div>
					<div class="debajoimagen3">
						<div class="form-field">
							<input name="link" type="text" id="link"
								placeholder="LARS VON TRIER" value="" minlength="2" required=""
								aria-required="true" class="full-width">
						</div>
					</div>
					<br>
					<div class="debajoimagen2">Cinematography:</div>
					<div class="debajoimagen3">
						<div class="form-field">
							<input name="link" type="text" id="link"
								placeholder="LARS VON TRIER" value="" minlength="2" required=""
								aria-required="true" class="full-width">
						</div>
					</div>
					<br>
					<div class="debajoimagen2">cast:</div>
					<div class="debajoimagen3"><?php echo $bd->personaspelicula($_GET["id"], "peliculasactores", "id_actor"); ?></div>
						<BR>
					<div class="debajoimagen2">watched:</div>
					<div class="debajoimagen3">
						<div class="form-field">
							<input name="link" type="text" id="link"
								placeholder="LARS VON TRIER" value="" minlength="2" required=""
								aria-required="true" class="full-width">
						</div>
					</div>
					<Br>
					<button class="full-width btn--primary" name="edit" type="submit">SAVE</button>
					<BR>
					<button class="full-width btn--rafa" name="insertfilm"
						type="submit">DELETE film</button>
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
					<p>
						<img
							src="https://image.tmdb.org/t/p/w500<?php echo $datos["poster"] ?>"
							srcset="https://image.tmdb.org/t/p/w500<?php echo $datos["poster"] ?>"
							sizes="(max-width: 1000px) 100vw, 1000px" alt="Film Cover">
					</p>
				</div>
				<!-- end contactis-info -->
				<div class="debajoimagen">
					<div class="form-field">
						<input name="pais" type="text" id="pais" placeholder="Country"
							value="<?php echo $utp->dosletrasaentero($datos["pais"]) ?>"
							minlength="2" required="" aria-required="true" class="full-width">
					</div>
				</div>
				<br>
				<div class="debajoimagen">
					<div class="form-field">
						<input name="año" type="text" id="año" placeholder="Year"
							value="<?php echo $datos["año"]; ?>" minlength="2" required=""
							aria-required="true" class="full-width">
					</div>
				</div>
				<br>
				<div class="debajoimagen">
					<div class="form-field">
						<input name="duracion" type="text" id="duracion"
							placeholder="Length" value="<?php echo $datos["duracion"]; ?>"
							minlength="2" required="" aria-required="true" class="full-width">
					</div>
				</div>
				<br>
				<div class="debajoimagen">
					<div class="form-field">
						<input name="link" type="text" id="link" placeholder="Rewatch"
							value="" minlength="2" required="" aria-required="true"
							class="full-width">
					</div>
				</div>
				<br>
			</div>
			<!-- end contactis-secondary -->

		</div>
		<!-- end contactis-content -->

	</section>
	<!-- end s-contactis -->
	</form>
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
<?php
} else {
    $bd->query("UPDATE titulopelicula SET titulo_original='" . $_POST["titulo"] . "', tagline='" . $_POST["tagline"] . "', duracion='" . $_POST["duracion"] . "', pais='" . $utp->codigopais($_POST["pais"]) . "' WHERE id_pelicula=" . $_GET["id"]);
    header("Location:film.php?id=" . $_GET["id"]);
}

?>