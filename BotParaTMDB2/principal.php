<?php
if (! $_POST) {
    ?>
<form action="principal.php" method=post>
	<input type="date" name="fecha"> <input type="text" name="link"
		placeholder="link"> <input type="text" name="medio"
		placeholder="medio"> <input type="text" name="formato"
		placeholder="formato"> <input type="text" name="audio"
		placeholder="audio"> <input type="checkbox" name="rewatch" value=1>

	<button class="btn btn-primary" type=submit>Enviar</button>


</form>
<?php

} else {
    require "conexion.php";
    
    $bd = new BaseDeDatos();
    
    $bd->pasar($_POST["link"], $_POST["fecha"], $_POST["medio"], $_POST["formato"], $_POST["audio"], $_POST["rewatch"]);
}
?>
