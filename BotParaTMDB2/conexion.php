<?php
include_once "utilidades.php";
include_once "utilidadespaises.php";

class BaseDeDatos extends mysqli
{

    // TODO cambiar el formulario de search de newfilm.php, añadir urlencode
    // TODO añadir en utilidades.php un metodo addslashes de array para devolver un array con slashes
    private $ut;

    private $utp;

    public $is_random = false;

    public function __construct()
    {
        // TODO Sugerencia película aleatoria en el fondo del actor en el que salga él
        include_once 'simple_html_dom.php';
        date_default_timezone_set('Europe/Madrid');
        
        $basededatos = "cine";
        
        parent::__construct("localhost", "root", "12345", $basededatos);
        $this->query("SET NAMES 'UTF8';");
        $this->connect_errno ? die("Error con la conexión") : $x = "Conectado";
        // echo $x;
        unset($x);
        $this->ut = new Utilidades();
        $this->utp = new UtilidadesPaises();
    }

    public function contar($tablas, $plus)
    {
        $cont = $this->query("SELECT COUNT(*) as con FROM " . $tablas . " WHERE " . $plus);
        
        $con = 0;
        
        while ($rows = $cont->fetch_assoc()) {
            $con = $rows["con"];
        }
        return $con;
    }

    public function buscarsiexiste($consulta)
    {
        $resultado = $this->query($consulta);
        $filas = $this->affected_rows;
        
        return $filas;
    }

    public function datospelicula($id)
    {
        $datos = array();
        
        $cont = $this->query("SELECT * FROM titulopelicula WHERE id_pelicula=" . $id);
        
        while ($rows = $cont->fetch_assoc()) {
            $datos["titulo_original"] = $rows["titulo_original"];
            $datos["año"] = $rows["año"];
            $datos["duracion"] = $rows["duracion"];
            $datos["pais"] = $rows["pais"];
            $datos["poster"] = $rows["poster"];
            $datos["id_pelicula"] = $rows["id_pelicula"];
            $datos["tagline"] = $rows["tagline"];
        }
        return $datos;
    }

    public function valorarrayasociativo($valor, $array)
    {
        $con = 0;
        
        foreach ($array as $elemento) {
            if ($elemento["department"] == $valor && $elemento["media_type"] == "movie") {
                $con ++;
            }
        }
        
        return $con;
    }

    public function peliculasexternaspersona($id, $rol)
    {
        $arraypersona = $this->ut->htmltojson("https://api.themoviedb.org/3/person/" . $id . "/combined_credits?api_key=3f533c5423eaf11962eb53403fccff33&language=en-US");
        $array = array();
        
        
        switch ($rol){
            case "Acting" : $cantidad = $this->contar("peliculasactores", "id_actor=" . $id);
                            $total = count($arraypersona["cast"]);
                            break;
            case "Directing":  $cantidad = $this->contar("titulosdirectores", "id_director=" . $id);
            $total = $this->valorarrayasociativo($rol, $arraypersona["crew"]);
            break;
            case "Sound":        $cantidad = $this->contar("peliculasmusicos", "id_musico=" . $id);
            $total = $this->valorarrayasociativo($rol, $arraypersona["crew"]); break;
            case "Camera":             $cantidad = $this->contar("peliculasfotografos", "id_foto=" . $id);
            $total = $this->valorarrayasociativo($rol, $arraypersona["crew"]); break;
            case "Writing":            $cantidad = $this->contar("peliculasguionistas", "id_guionista=" . $id);
            $total = $this->valorarrayasociativo($rol, $arraypersona["crew"]); break;
            default: $cantidad = $this->contar("titulosdirectores", "id_director=" . $id);
            $total = $this->valorarrayasociativo($rol, $arraypersona["crew"]);
            break;
        }
        
        
        $porcentaje = ($cantidad / $total) * 100;
        return ltrim(number_format($porcentaje, 0));
    }

    public function personaspelicula($id, $tabla, $id_tabla)
    {
        $datos = array();
        $cont = $this->query("SELECT * FROM " . $tabla . ",persona WHERE persona.id_persona=" . $tabla . "." . $id_tabla . " and id_pelicula=" . $id . " LIMIT 25");
        
        while ($rows = $cont->fetch_assoc()) {
            array_push($datos, "<a class='one' href=person.php?id=" . $rows["id_persona"] . ">" . $rows["nombre_persona"] . "</a>");
        }
        
        return $this->mostrararray($datos);
    }

    public function peliculasdepersona($idpersona, $rol)
    {
        $datos = array();
        
        $tabla = "";
        $id_tabla = "";
        switch ($rol) {
            case "Acting":
                $tabla = "peliculasactores";
                $id_tabla = "id_actor";
                break;
            case "Directing":
                $tabla = "titulosdirectores";
                $id_tabla = "id_director";
                break;
            case "Writing":
                $tabla = "peliculasguionistas";
                $id_tabla = "id_guionista";
                break;
            case "Camera":
                $tabla = "peliculasfotografos";
                $id_tabla = "id_foto";
                break;
            default:
                $tabla = "peliculasactores";
                $id_tabla = "id_actor";
                break;
        }
        $cons = "SELECT titulopelicula.id_pelicula,titulo_original FROM titulopelicula," . $tabla . " WHERE titulopelicula.id_pelicula=" . $tabla . ".id_pelicula and " . $tabla . "." . $id_tabla . "=" . $idpersona;
        
        $cont = $this->query($cons);
        
        while ($rows = $cont->fetch_assoc()) {
            array_push($datos, $rows["id_pelicula"]);
        }
        
        return $datos;
    }

    public function fondodepeliculadepersona($idpersona, $rol)
    {
        
        if ($rol=="Acting"||$rol=="Directing"||$rol=="Writing"||$rol=="Camera"){
        $peliculas = $this->peliculasdepersona($idpersona, $rol);
        shuffle($peliculas);
        
        return $this->ut->fondodepeliculaleatorio($peliculas[0]);}
        else{
            $this->ut->ordenaraleatorio();
        }
    }

    public function peliculasdepersonarol($idpersona, $rol)
    {
        $datos = array();
        
        $tabla = "";
        $id_tabla = "";
        switch ($rol) {
            case "Acting":
                $tabla = "peliculasactores";
                $id_tabla = "id_actor";
                break;
            case "Directing":
                $tabla = "titulosdirectores";
                $id_tabla = "id_director";
                break;
            case "Writing":
                $tabla = "peliculasguionistas";
                $id_tabla = "id_guionista";
                break;
            case "Camera":
                $tabla = "peliculasfotografos";
                $id_tabla = "id_foto";
                break;
            default:
                $tabla = "peliculasactores";
                $id_tabla = "id_actor";
                break;
        }
        $cons = "SELECT titulopelicula.id_pelicula,titulo_original FROM titulopelicula," . $tabla . " WHERE titulopelicula.id_pelicula=" . $tabla . ".id_pelicula and " . $tabla . "." . $id_tabla . "=" . $idpersona;
        
        $cont = $this->query($cons);
        
        while ($rows = $cont->fetch_assoc()) {
            array_push($datos, "<a class='one' href=film.php?id=" . $rows["id_pelicula"] . ">" . $rows["titulo_original"] . "</a>");
        }
        
        return $this->mostrararray($datos);
    }

    public function mostrararray($array)
    {
        $final = implode(', ', $array);
        return $final;
    }

    public function insertarpelicula($id, $arraymovie, $tituloES)
    {
        $año = explode('-', $arraymovie["release_date"])[0];
        $titulo_original = addslashes($arraymovie["original_title"]);
        $duracion = $arraymovie["runtime"];
        $pais = $this->utp->codigopais($arraymovie["production_countries"][0]["name"]);
        $poster = $arraymovie["poster_path"];
        $tagline = addslashes($arraymovie["tagline"]);
        for ($i = 0; $i < count($arraymovie); $i ++) {
            $this->query("INSERT INTO titulopelicula (id_pelicula, año, titulo, titulo_original, poster, tagline, duracion, pais) VALUES ('" . $id . "', '" . $año . "', '" . addslashes($tituloES) . "', '" . $titulo_original . "', '" . $poster . "', '" . $tagline . "', '" . $duracion . "', '" . $pais . "')");
        }
    }

    public function insertarpersonas($tabla, $arraypersonas, $idpelicula)
    {
        for ($i = 0; $i < count($arraypersonas); $i ++) {
            
            $idpersona = explode('|', $arraypersonas[$i])[0];
            $nombrepersona = explode('|', $arraypersonas[$i])[1];
            $sexo = explode('|', $arraypersonas[$i])[2];
            $filas = $this->buscarsiexiste("SELECT * FROM persona WHERE id_persona=" . $idpersona);
            
            if ($filas < 1) {
                // Si esta persona no está registrada en la base de datos, la inserta
                $this->query("INSERT INTO persona VALUES ('" . $idpersona . "', '" . $nombrepersona . "', '" . $sexo . "')");
            }
            
            $this->query("INSERT INTO " . $tabla . " VALUES ('" . $idpelicula . "', '" . $idpersona . "')");
        }
    }

    public function fechas($id)
    {
        $cont = $this->query("SELECT * FROM fechastitulos WHERE id_titulo=" . $id . " ORDER BY fecha ASC");
        
        while ($rows = $cont->fetch_assoc()) {
            
            echo $this->ut->fechaesp($rows["fecha"]) . "<br>";
        }
    }

    public function rewatch($id)
    {
        $true = false;
        
        $filas = $this->buscarsiexiste("SELECT * FROM fechastitulos WHERE id_titulo=" . $id . " and rewatch=1");
        
        if ($filas >= 1) {
            $true = true;
        }
        
        return $true;
    }

    public function pasar($link, $fecha, $rewatch, $medio)
    {
        $directores = array();
        $guionistas = array();
        $musicos = array();
        $directoresfoto = array();
        $reparto = array();
        
        // SE SACA EL ID DE LA PELÍCULA
        $html = file_get_html($link);
        $tmdb = $html->find("a[class=micro-button track-event]", 1);
        
        $urltmdb = $tmdb->href;
        
        $id = explode('/', $urltmdb)[4];
        
        if ($this->buscarsiexiste("SELECT * FROM titulopelicula WHERE id_pelicula=" . $id) < 1) {
            
            echo "<strong>Esta película no existía y fue introducida</strong>";
            
            // Si no está introducida previamente hace esto
            
            $arraymovie = $this->ut->htmltojson("https://api.themoviedb.org/3/movie/" . $id . "?api_key=3f533c5423eaf11962eb53403fccff33");
            
            $tituloES = $this->ut->htmltojson("https://api.themoviedb.org/3/movie/" . $id . "?api_key=3f533c5423eaf11962eb53403fccff33&language=es")["title"];
            
            $arraycast = $this->ut->htmltojson("https://api.themoviedb.org/3/movie/" . $id . "/casts?api_key=3f533c5423eaf11962eb53403fccff33&language=es");
            
            echo $id;
            for ($i = 0; $i < count($arraycast["crew"]); $i ++) {
                
                // PARA DIRECTORES
                if ($arraycast["crew"][$i]["department"] == "Directing" && $arraycast["crew"][$i]["job"] == "Director") {
                    array_push($directores, $arraycast["crew"][$i]["id"] . "|" . $arraycast["crew"][$i]["name"] . "|" . $arraycast["crew"][$i]["gender"]);
                } // PARA GUIONISTAS
                else if ($arraycast["crew"][$i]["department"] == "Writing" && ($arraycast["crew"][$i]["job"] == "Screenplay" || $arraycast["crew"][$i]["job"] == "Writer")) {
                    array_push($guionistas, $arraycast["crew"][$i]["id"] . "|" . $arraycast["crew"][$i]["name"] . "|" . $arraycast["crew"][$i]["gender"]);
                } // PARA MÚSICOS
                else if ($arraycast["crew"][$i]["department"] == "Sound" && ($arraycast["crew"][$i]["job"] == "Original Music Composer" || $arraycast["crew"][$i]["job"] == "Music")) {
                    array_push($musicos, $arraycast["crew"][$i]["id"] . "|" . $arraycast["crew"][$i]["name"] . "|" . $arraycast["crew"][$i]["gender"]);
                } // PARA DIRECTORES DE FOTOGRAFÍA
                else if ($arraycast["crew"][$i]["department"] == "Camera" && ($arraycast["crew"][$i]["job"] == "Director of Photography" || $arraycast["crew"][$i]["job"] == "Cinematography")) {
                    array_push($directoresfoto, $arraycast["crew"][$i]["id"] . "|" . $arraycast["crew"][$i]["name"] . "|" . $arraycast["crew"][$i]["gender"]);
                }
            }
            
            // PARA REPARTO
            for ($i = 0; $i < count($arraycast["cast"]); $i ++)
                array_push($reparto, $arraycast["cast"][$i]["id"] . "|" . $arraycast["cast"][$i]["name"] . "|" . $arraycast["cast"][$i]["gender"]);
            
            echo "Directores: " . $this->mostrararray($directores);
            
            echo "<br>Guionistas: " . $this->mostrararray($guionistas);
            
            echo "<br>Músicos:" . $this->mostrararray($musicos);
            
            echo "<br>Fotografía:" . $this->mostrararray($directoresfoto);
            
            echo "<br>Reparto:" . $this->mostrararray($reparto);
            
            $this->insertarpelicula($id, $arraymovie, $tituloES);
            $this->insertarpersonas("peliculasactores", $reparto, $id);
            $this->insertarpersonas("titulosdirectores", $directores, $id);
            $this->insertarpersonas("peliculasfotografos", $directoresfoto, $id);
            $this->insertarpersonas("peliculasguionistas", $guionistas, $id);
            $this->insertarpersonas("peliculasmusicos", $musicos, $id);
        }
        // Si no, no es necesario meterla y hace esto
        $this->query("INSERT INTO fechastitulos (fecha, id_titulo, rewatch, medio) VALUES ('" . $fecha . "', '" . $id . "', '" . $rewatch . "', '" . $medio . "')");
    }

    public function ranking($tabla, $id_tabla, $plus, $general)
    {
        $fechastitulos = "";
        $igualartablas = "";
        if (! $general) {
            $fechastitulos = "fechastitulos,";
            $igualartablas = "fechastitulos.id_titulo=titulopelicula.id_pelicula and";
        }
        $cons = $this->query("SELECT *,COUNT(*) as con FROM persona," . $fechastitulos . "titulopelicula," . $tabla . " WHERE " . $igualartablas . " persona.id_persona=" . $tabla . "." . $id_tabla . " and titulopelicula.id_pelicula=" . $tabla . ".id_pelicula " . $plus . " GROUP BY persona.id_persona ORDER BY con DESC LIMIT 10");
        while ($rows = $cons->fetch_assoc()) {
            ?>
<tr>
	<td><a class="two"
		href="person.php?id=<?php echo $rows["id_persona"] ?>"><?php echo $rows["nombre_persona"] ?></a></td>
	<td><?php echo $rows["con"] ?></td>
</tr>
<?php
        }
    }

    public function ultimas10($dato, $columna)
    {
        $cons = $this->query("SELECT id_pelicula,titulo_original,fecha FROM fechastitulos,titulopelicula WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and ".$columna."='" . $dato . "' ORDER BY fecha DESC LIMIT 10");
        while ($rows = $cons->fetch_assoc()) {
            
            ?>
<tr>
	<td class="one"><a class="seven"
		href="film.php?id=<?php echo $rows["id_pelicula"] ?>" class="three"><?php echo $rows["titulo_original"] ?></a></td>
	<td class="one"><?php echo $rows["fecha"] ?></td>
</tr>
<?php
        }
    }

    public function datoshaceunaño()
    {
        $todaslaspelis = array();
        
        $cons = "SELECT * FROM fechastitulos WHERE DAY(fecha)=" . date('d') . " and MONTH(fecha)=" . date('m') . " and YEAR(fecha)=" . (date('Y') - 1);
        
        $filas = $this->buscarsiexiste($cons);
        
        if ($filas > 0) {
            $cons = $this->query($cons);
            while ($rows = $cons->fetch_assoc()) {
                array_push($todaslaspelis, $this->datospelicula($rows["id_titulo"]));
            }
        } else {
            $cons = "SELECT * FROM titulopelicula ORDER BY RAND() LIMIT 1";
            $cons = $this->query($cons);
            while ($rows = $cons->fetch_assoc()) {
                $todaslaspelis[0] = $this->datospelicula($rows["id_pelicula"]);
                $this->is_random = true;
            }
        }
        
        return $todaslaspelis;
    }

    public function peliculasaño($plus)
    {
        for ($i = 2017; $i <= date('Y'); $i ++) {
            ?>

<tr>
	<td><a class="two" href="year.php?a= <?php echo $i ?>"><?php echo $i ?></a></td>
	<td>  <?php
            echo $this->contar("titulopelicula,fechastitulos", "titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fecha)=" . $i . " " . $plus);
            ?></td>
</tr>
<?php
        }
    }

    public function paises($plus)
    {
        $cons = $this->query("SELECT pais,COUNT(*) as con FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo " . $plus . " GROUP BY pais ORDER BY con DESC LIMIT 10");
        while ($rows = $cons->fetch_assoc()) {
            ?>
<tr>
	<td><a href="country.php?c=<?php echo $rows["pais"] ?>"><?php echo $this->utp->imagenpaisdosletras($rows["pais"]) ?></a></td>
	<td><?php echo $rows["con"] ?></td>
</tr>
<?php
        }
    }
}
?>