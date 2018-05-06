<?php
include_once "simple_html_dom.php";
class Utilidades
{

    public function htmltojson($url)
    {
        // TODO coger la URL en inglés para el eslogan.
        // TODO paginacion y buscador, pagina de la pelicula y del actor.
        $json2 = file_get_contents($url);
        $array2 = json_decode($json2, true);
        
        return $array2;
    }
    
    
    public function nomostrarnull($dato)
    {
        if (empty($dato)) {
            echo "-";
        } else {
            echo $dato;
        }
    }

    public function conocidopor($id){
       $html_file=file_get_contents("https://www.themoviedb.org/person/".$id);
       
       preg_match('/<p><strong><bdi>Known For<\/bdi><\/strong>(.*)<\/p>/', $html_file, $rol);
       
       return trim($rol[1]);
    }
    
    public function fondodepeliculaleatorio($idpelicula){
        $backdrops=$this->htmltojson("https://api.themoviedb.org/3/movie/".$idpelicula."/images?api_key=3f533c5423eaf11962eb53403fccff33")["backdrops"];
        
        $fondo=array_rand($backdrops,1);
        
        return $backdrops[$fondo];
    
    }
   

    public function ordenaraleatorio()
    {
        $ficheros = scandir("images/bg");
        unset($ficheros[0]);
        unset($ficheros[1]);
        shuffle($ficheros);
        
        return $ficheros;
    }

 
    public function sexo($sexo, $solosimbolo)
    {
        if ($sexo == 2) {
            if (! $solosimbolo) {
                echo "male ";
            }
            ?>
<i class="ion-male"></i><?php
        } else if ($sexo == 1) {
            if (! $solosimbolo) {
                echo "female ";
            }
            ?>
<i class="ion-female"></i><?php
        } else {
            ?> - <?php
        }
    }

    public function fechaesp($fechaor)
    {
        $fecha1 = new DateTime($fechaor);
        return $fecha1->format('d-m-Y');
    }

    public function minutosahoras($minutosi)
    {
        $final = "";
        
        $minutos = $minutosi % 60;
        $hora = ($minutosi - ($minutosi % 60)) / 60;
        
        if ($minutos == 0) {
            $final = $hora . "H";
        } else {
            $final = $hora . "H " . $minutos . " MIN.";
        }
        
        return $final;
    }
}
/*
$u=new Utilidades();

*/
?>