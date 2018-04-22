<section id="contact" class="s-contact target-section"
		data-parallax="scroll"
		data-image-src="images/bg/<?php echo $n[1]; ?>"
		data-natural-width=1920 data-natural-height=1080
		data-position-y=center">

		<div class="overlay"></div>
		
 <div class="row section-header" data-aos="fade-up"><br><br><br>
            <div class="col-full">
                <h3 class="chorizo">Search</h3>
                <h1 class="display-2 display-2--light"><i class="ion-search"></i></h1>
            </div>
        </div>

<div class="row contact-content" data-aos="fade-up">
            
            <div class="contact-primary">
                <form name="contactForm" id="contactForm" method="post" action="" novalidate="novalidate">
                    <fieldset>
    
                    <div class="form-field">
                        <input name="contactName" type="search" id="contactName" placeholder="Search" value="" minlength="2" required="" aria-required="true" class="full-width">
                    </div>
                 
                    <div class="form-field">
                        <button class="full-width btn--primary">Search</button>
                        <div class="submit-loader">
                            <div class="text-loader">Adding...</div>
                            <div class="s-loader">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </div>
                    </div>
    
                    </fieldset>
                </form>

                <!-- contact-warning -->
                <div class="message-warning">
                    Something went wrong. Please try again.
                </div> 
            
                <!-- contact-success -->
                <div class="message-success">
                    Your film was added.<br>
                </div>

            </div> <!-- end contact-primary -->
            

        </div> <!-- end contact-content -->
		
		
<br><br><br><br>

		<div class="row section-header" data-aos="fade-up">
			<div class="col-full">
				<h3 class="chorizo"><section id="add">Add a</section></h3>
				<h1 class="display-2 display-2--light">FILM</h1>
			</div>
		</div>

		<div class="row contact-content" data-aos="fade-up">

			<div class="contact-primary">

				<h3 class="h6">FILM</h3>
				<?php if (!isset($_POST["insertfilm"])) { ?>
				<form name="insertfilm" id="insertfilm" method="post" action=""
					novalidate="novalidate">
					<fieldset>

						<div class="form-field">
							<input name="link" type="text" id="link"
								placeholder="Link" value="" minlength="2" required=""
								aria-required="true" class="full-width">
						</div>
						<div class="form-field">
							<input name="fecha" type="text" id="fecha"
								placeholder="Date" value="" minlength="2" required=""
								aria-required="true" class="full-width">
						</div><br>
						<div class="add-bottom">
							<input align="center" type="checkbox" name="rewatch" id="rewatch" value=1> <span class="label-text">Rewatch</span>
						</div>
						<div class="form-field">
							<button class="full-width btn--primary" name="insertfilm" type="submit">Add</button>
							<div class="submit-loader">
								<div class="text-loader">Adding...</div>
								<div class="s-loader">
									<div class="bounce1"></div>
									<div class="bounce2"></div>
									<div class="bounce3"></div>
								</div>
							</div>
						</div>

					</fieldset>
				</form>
<?php }else{ 

    $bd->pasar($_POST["link"], $_POST["fecha"], $_POST["rewatch"]);
    
    unset($_POST);
    header("Location:index.php");
}


?>
				<!-- contact-warning -->
				<div class="message-warning">Something went wrong. Please try again.
				</div>

				<!-- contact-success -->
				<div class="message-success">
					Your film was added.<br>
				</div>

			</div>
			<!-- end contact-primary -->

			<div class="contact-secondary">
				<div class="contact-info">
				<div class="overimage">One year ago...</div>
					<p>
						<a href="film.php"><img src="images/suburbicon.jpg"
							srcset="images/suburbicon.jpg 1000w, 
                    images/suburbicon.jpg 500w"
							sizes="(max-width: 1000px) 100vw, 1000px" alt="Film Cover"></a>
					</p>
				</div>
				<!-- end contact-info -->
				<div class="debajoimagen">suburbicon</div>
				<br>
				<div class="debajoimagen">2017</div>
				<br><br>
				<div class="salchicon">And... <a href="#" class="one">La llamada</a></div><br>
				<div class="salchicon">And... <a href="#" class="one">get out</a></div>
			</div>
			<!-- end contact-secondary -->

		</div>
		<!-- end contact-content -->

	</section>	