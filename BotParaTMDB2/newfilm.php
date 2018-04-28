<section id="contact" class="s-contact target-section"
	data-parallax="scroll" data-image-src="images/bg/<?php echo $n[1]; ?>"
	data-natural-width=1920 data-natural-height=1080 data-position-y=center">

	<div class="overlay"></div>

	<div class="row section-header" data-aos="fade-up">
		<br>
		<br>
		<br>
		<div class="col-full">
			<h3 class="chorizo">Search</h3>
			<h1 class="display-2 display-2--light">
				<i class="ion-search"></i>
			</h1>
		</div>
	</div>

	<div class="row contact-content" data-aos="fade-up">

		<div class="contact-primary">
            <?php if (!isset($_POST["search"])) { ?>
                <form name="search" id="search" method="post" action=""
				novalidate="novalidate">
				<fieldset>

					<div class="form-field">
						<input name="contactName" type="text" id="contactName"
							placeholder="Search" value="" aria-required="true"
							class="full-width">
					</div>

					<div class="form-field">
						<button class="full-width btn--primary" name="search"
							type="submit">Search</button>
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
				<?php
            } else {
                header("Location:search.php?search=" . urlencode($_POST["contactName"]));
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


	</div>
	<!-- end contact-content -->


	<br>
	<br>
	<br>
	<br>

	<div class="row section-header" data-aos="fade-up">
		<div class="col-full">
			<h3 class="chorizo">
				<section id="add">Add a</section>
			</h3>
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
						<input name="link" type="text" id="link" placeholder="Link"
							value="" minlength="2" required="" aria-required="true"
							class="full-width">
					</div>
					<div class="form-field">
						<input name="fecha" type="text" id="fecha" placeholder="Date"
							value="" minlength="2" required="" aria-required="true"
							class="full-width">
					</div>
					<br>
					<div class="add-bottom">
						<input align="center" type="checkbox" name="rewatch" id="rewatch"
							value=1> <span class="label-text">Rewatch</span>
					</div>
					<div class="form-field">
						<button class="full-width btn--primary" name="insertfilm"
							type="submit">Add</button>
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
<?php
    
} else {
        
        $bd->pasar($_POST["link"], $_POST["fecha"], $_POST["rewatch"], "");
        
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

<?php include "hace.php" ?>
		<!-- end contact-secondary -->

	</div>
	<!-- end contact-content -->

</section>
