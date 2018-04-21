<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<?php 
include_once "conexion.php";

$bd=new BaseDeDatos();
?>
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>MyMovieDB</title>
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
            <a class="site-logo" href="index.php">
                <img src="images/logo1.png" alt="Homepage">
            </a>
        </div>
    </header> <!-- end s-header -->


    <!-- home
    ================================================== -->
    <section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="images/bg/songtosong.jpg" data-natural-width=1920 data-natural-height=1080 data-position-y=center>

        <div class="overlay"></div>
        <div class="shadow-overlay"></div>

        <div class="home-content">

            <div class="row home-content__main">
<table>
                            <thead>
                            <tr>
                                <td class="two">Film</td>
                                <td class="two">Released</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="one"><a href="film.php" class="three">Swiss Army Man</a></td>
								<td class="one">2016</td>
                            </tr>
							<tr>
                                <td class="one">A Most Violent Year</td>
								<td class="one">2015</td>
                            </tr>
                            </tbody>
                    </table>
					
					<br><br>
					
					<table>
                            <thead>
                            <tr>
                                <td class="two">Cast</td>
                                <td class="two">Gender</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="one">Rooney Mara</td>
								<td class="one"><i class="ion-female"></i></td>
                            </tr>
							<tr>
                                <td class="one">Óscar Isaac</td>
								<td class="one"><i class="ion-male"></i></td>
                            </tr>
                            </tbody>
                    </table>
					
										<br><br>
					
					<table>
                            <thead>
                            <tr>
                                <td class="two">Crew</td>
                                <td class="two">Known for</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="one">Steven Spielberg</td>
								<td class="one">Directing</td>
                            </tr>
							<tr>
                                <td class="one">Alexandre Desplat</td>
								<td class="one">Sound</td>
                            </tr>
                            </tbody>
                    </table>



        </div> <!-- end home-content -->


        

    </section> <!-- end s-home -->

    <!-- footer
    ================================================== -->
    <footer>
        <div class="row footer-bottom">

            <div class="col-twelve">
                <div class="copyright">
                    <span>© Copyright Glint 2017</span> 
                    <span>Site Template by <a href="https://www.colorlib.com/">Colorlib</a></span>	
                </div>

                <div class="go-top">
                    <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up" aria-hidden="true"></i></a>
                </div>
            </div>

        </div> <!-- end footer-bottom -->

    </footer> <!-- end footer -->


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
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title=
                    "Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title=
                    "Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button> <button class="pswp__button pswp__button--arrow--right" title=
                "Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>

        </div>

    </div> <!-- end photoSwipe background -->


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