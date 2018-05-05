<section id='diary' class="s-diary">

		<div class="row section-header has-bottom-sep" data-aos="fade-up">
			<div class="col-full">
				<h3 class="subhead">Films</h3>
				<h1 class="display-1 display-1--light">Diary</h1>
			</div>
		</div>
		<!-- end section-header -->

		<div class="row diary-desc" data-aos="fade-up">
			<div class="col-full">
				<p>
				
				
				<div class="table-responsive">

					<table>
						<thead>
							<tr>
								<td class="three"><h4>Month</h4></td>
								<td><h4>Day</h4></td>
								<td><h4>Film</h4></td>
								<td><h4>Released</h4></td>
								<td><h4>Lenght</h4></td>
								<td><h4>Rewatch</h4></td>
							</tr>
						</thead>
						<tbody>
							
							<?php
    
$cons = $bd->query("SELECT * FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo ORDER BY fecha DESC LIMIT 10");
    while ($rows = $cons->fetch_assoc()) {
        ?>
                            <tr>
								<td class="three"><?php echo date("m", strtotime($rows["fecha"]));  ?></td>
								<td class="three"><?php echo date("d", strtotime($rows["fecha"]));  ?></td>
								<td><a class="two" href="film.php?id=<?php echo $rows["id_titulo"] ?>"><?php echo $rows["titulo_original"];  ?></a></td>
								<td class="three"><a class="two" href="year.php?a=<?php echo $rows["año"] ?>"><?php echo $rows["año"];  ?></a></td>
								<td class="three"><?php echo $a->minutosahoras($rows["duracion"]);  ?></td>
								<td class="three"><?php if ($rows["rewatch"]==1){?><b><i class="ion-loop"></i></b><?php } ?></td>
							</tr>
							<?php
    }
    ?>
                            </tbody>
					</table>

				</div>
				</p>
			</div>
		</div>
		<!-- end diary-desc -->

		<div
			class="row about-stats stats block-1-4 block-m-1-2 block-mob-full"
			data-aos="fade-up">

			<div class="col-block stats__cole">
				<div class="stats__count">1</div>
				<h5></h5>
			</div>
			<div class="col-block stats__col">
				<div class="stats__count"><?php echo $bd->contar("titulopelicula,fechastitulos","titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fecha)=".date('Y')); ?></div>
				<h5>FILMS THIS YEAR</h5>
			</div>
			<div class="col-block stats__col">
				<div class="stats__count"><?php echo date('z')+1; ?></div>
				<h5>DAYS THIS YEAR</h5>
			</div>
			<div class="col-block stats__cole">
				<div class="stats__count">1</div>
				<h5></h5>
			</div>

		</div>
		<!-- end about-stats -->


	</section>