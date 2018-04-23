
<div class="contact-secondary">
	<div class="contact-info">
				<?php
    $a = $bd->datoshaceunaño();
    if ($bd->is_random) {
        $sobret = "Random Movie";
    } else {
        $sobret = "One year ago...";
    }
    $poster = $a[0]["poster"];
    $titulo = $a[0]["titulo_original"];
    $id = $a[0]["id_pelicula"];
    $año = $a[0]["año"];
    
    ?>
		<div class="overimage"><?php echo $sobret; ?></div>
		<p>

			<img src="https://image.tmdb.org/t/p/w500<?php echo $poster ?>"
				srcset="https://image.tmdb.org/t/p/w500<?php  echo $poster ?> 1000w, 
						<?php  echo $poster ?> 500w"
				sizes="(max-width: 1000px) 100vw, 1000px" alt="Film Cover">
		</p>
	</div>
	<!-- end contact-info -->
	<div class="debajoimagen"><?php echo "<a href=film.php?id=".$id.">".$titulo ."</a>" ?></div>
	<br>
	<div class="debajoimagen"><?php echo $año ?></div>
	<br> <br>
			<?php  for ($i=1;$i<count($a);$i++){?>
			<div class="salchicon">
		And... <?php echo "<a href=film.php?id=".$a[$i]["id_pelicula"].">".$a[$i]["titulo_original"]."</a>"; ?>
	</div>
	<br>
<?php }?>
		</div>