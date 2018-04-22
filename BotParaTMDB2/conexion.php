<?php
include_once "utilidades.php";
class BaseDeDatos extends mysqli
{
    //TODO cambiar el formulario de search de newfilm.php, añadir urlencode 
    //TODO añadir en utilidades.php un metodo addslashes de array para devolver un array con slashes

    private $ut;
    
    public function __construct()
    {
        include_once 'simple_html_dom.php';
        date_default_timezone_set('Europe/Madrid');
        
        $basededatos = "cine";
        
        parent::__construct("localhost", "root", "12345", $basededatos);
        $this->query("SET NAMES 'UTF8';");
        $this->connect_errno ? die("Error con la conexión") : $x = "Conectado";
        // echo $x;
        unset($x);
        $this->ut=new Utilidades();
      
    }
    
    
    

    public function contar(){
        $cont=$this->query("SELECT COUNT(*) as con FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fecha)=2018");
        
        $con=0;
        
        while ($rows = $cont->fetch_assoc()) {
           $con=$rows["con"];
        }
        return $con;
    }
    
    public function buscarsiexiste($consulta)
    {
        $resultado = $this->query($consulta);
        $filas = $this->affected_rows;
        
        return $filas;
    }
    
    public function datospelicula($id){
        
        $datos=array();
        
        $cont=$this->query("SELECT * FROM titulopelicula WHERE id_pelicula=".$id);
        
        while ($rows = $cont->fetch_assoc()) {
            $datos["titulo_original"]=$rows["titulo_original"];
            $datos["año"]=$rows["año"];
            $datos["duracion"]=$rows["duracion"];
            $datos["pais"]=$rows["pais"];
            $datos["poster"]=$rows["poster"];
        }
        return $datos;
    }
    

    public function personaspelicula($id, $tabla, $id_tabla){
       $datos=array();
       $cont=$this->query("SELECT * FROM ".$tabla.",persona WHERE persona.id_persona=".$tabla.".".$id_tabla." and id_pelicula=".$id." LIMIT 25");
        
        while ($rows = $cont->fetch_assoc()) {
            array_push($datos,"<a class='one' href=person.php?id=".$rows["id_persona"].">".$rows["nombre_persona"]."</a>");
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
        $pais = addslashes($arraymovie["production_countries"][0]["name"]);
        $poster=$arraymovie["poster_path"];
        $tagline=addslashes($arraymovie["tagline"]);
        for ($i = 0; $i < count($arraymovie); $i ++) {
            $this->query("INSERT INTO titulopelicula (id_pelicula, año, titulo, titulo_original, poster, tagline, duracion, pais) VALUES ('" . $id . "', '" . $año . "', '".$tituloES."', '" . $titulo_original . "', '".$poster."', '".$tagline."', '" . $duracion . "', '" . $pais . "')");
        }
    }

    public function insertarpersonas($tabla, $arraypersonas, $idpelicula)
    {
        for ($i = 0; $i < count($arraypersonas); $i ++) {
            
            $idpersona = explode('|', $arraypersonas[$i])[0];
            $nombrepersona = explode('|', $arraypersonas[$i])[1];
            $sexo=explode('|', $arraypersonas[$i])[2];
            $filas = $this->buscarsiexiste("SELECT * FROM persona WHERE id_persona=" . $idpersona);
            
            if ($filas < 1) {
                // Si esta persona no está registrada en la base de datos, la inserta
                $this->query("INSERT INTO persona VALUES ('" . $idpersona . "', '" . $nombrepersona . "', '".$sexo."')");
            }
            
            $this->query("INSERT INTO " . $tabla . " VALUES ('" . $idpelicula . "', '" . $idpersona . "')");
        }
    }
    
    
    public function fechas($id){

        $cont=$this->query("SELECT * FROM fechastitulos WHERE id_titulo=".$id." ORDER BY fecha ASC");
        
        while ($rows = $cont->fetch_assoc()) {
            
            echo $this->ut->fechaesp($rows["fecha"])."<br>";
        }
        
    }
    
    public function rewatch ($id){
        $true=false;
        
        $filas=$this->buscarsiexiste("SELECT * FROM fechastitulos WHERE id_titulo=".$id." and rewatch=1");
        
        if ($filas>=1){
            $true=true;
        }
        
        return $true;
    }



    public function pasar($link, $fecha, $rewatch)
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
            // Si está introducida previamente hace esto
            
            $arraymovie = $this->ut->htmltojson("https://api.themoviedb.org/3/movie/" . $id . "?api_key=3f533c5423eaf11962eb53403fccff33");
            
            $tituloES= $this->ut->htmltojson("https://api.themoviedb.org/3/movie/" . $id . "?api_key=3f533c5423eaf11962eb53403fccff33&language=es")["title"];
            
            
            $arraycast = $this->ut->htmltojson("https://api.themoviedb.org/3/movie/" . $id . "/casts?api_key=3f533c5423eaf11962eb53403fccff33&language=es");
            
            echo $id;
            for ($i = 0; $i < count($arraycast["crew"]); $i ++) {
                
                // PARA DIRECTORES
                if ($arraycast["crew"][$i]["department"] == "Directing" && $arraycast["crew"][$i]["job"] == "Director") {
                    array_push($directores, $arraycast["crew"][$i]["id"] . "|" . $arraycast["crew"][$i]["name"]. "|" . $arraycast["crew"][$i]["gender"]);
                } // PARA GUIONISTAS
                else if ($arraycast["crew"][$i]["department"] == "Writing" && ($arraycast["crew"][$i]["job"] == "Screenplay" || $arraycast["crew"][$i]["job"] == "Writer")) {
                    array_push($guionistas, $arraycast["crew"][$i]["id"] . "|" . $arraycast["crew"][$i]["name"]. "|" . $arraycast["crew"][$i]["gender"]);
                } // PARA MÚSICOS
                else if ($arraycast["crew"][$i]["department"] == "Sound" && ($arraycast["crew"][$i]["job"] == "Original Music Composer" || $arraycast["crew"][$i]["job"] == "Music")) {
                    array_push($musicos, $arraycast["crew"][$i]["id"] . "|" . $arraycast["crew"][$i]["name"]. "|" . $arraycast["crew"][$i]["gender"]);
                } // PARA DIRECTORES DE FOTOGRAFÍA
                else if ($arraycast["crew"][$i]["department"] == "Camera" && ($arraycast["crew"][$i]["job"] == "Director of Photography" || $arraycast["crew"][$i]["job"] == "Cinematography")) {
                    array_push($directoresfoto, $arraycast["crew"][$i]["id"] . "|" . $arraycast["crew"][$i]["name"]. "|" . $arraycast["crew"][$i]["gender"]);
                }
            }
            
            // PARA REPARTO
            for ($i = 0; $i < count($arraycast["cast"]); $i ++)
                array_push($reparto, $arraycast["cast"][$i]["id"] . "|" . $arraycast["cast"][$i]["name"]. "|" . $arraycast["cast"][$i]["gender"]);
            
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
        $this->query("INSERT INTO fechastitulos (fecha, id_titulo, rewatch) VALUES ('" . $fecha . "', '" . $id . "', '" . $rewatch . "')");
    }
    
    
    public function ranking($tabla, $id_tabla,$plus){

        
        $cons = $this->query("SELECT *,COUNT(*) as con FROM persona,titulopelicula,".$tabla." WHERE persona.id_persona=".$tabla.".".$id_tabla." and titulopelicula.id_pelicula=".$tabla.".id_pelicula ".$plus." GROUP BY persona.id_persona ORDER BY con DESC LIMIT 10");
        while ($rows = $cons->fetch_assoc()) {
          ?>
                            <tr>
								<td><?php echo $rows["nombre_persona"] ?></td>
								<td><?php echo $rows["con"] ?></td>
							</tr>
<?php }
                     
    }
    
    public function paises(){
        $cons = $this->query("SELECT pais,COUNT(*) as con FROM titulopelicula GROUP BY pais ORDER BY con DESC LIMIT 10");
        while ($rows = $cons->fetch_assoc()) {
            ?>
                            <tr>
								<td><?php echo $this->ut->imagenpais($rows["pais"]) ?></td>
								<td><?php echo $rows["con"] ?></td>
							</tr>
<?php }
        
    }
    
}
?>