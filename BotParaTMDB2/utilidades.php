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
       
       return $rol[1];
    }
    
    
    public function imagenpais($pais)
    {
        $imagenfinal = "";
        
        if (! empty($pais)) {
            
            $array2 = $this->htmltojson("https://restcountries.eu/rest/v2/name/" . $pais);
            
            $imagen = $array2[0]["flag"];
            
            $imagenfinal = "<img title='" . $pais . "' width=64 src=" . $imagen . ">";
        }
        
        return $imagenfinal;
    }

    public function ordenaraleatorio()
    {
        $ficheros = scandir("images/bg");
        unset($ficheros[0]);
        unset($ficheros[1]);
        shuffle($ficheros);
        
        return $ficheros;
    }

    public function nacimientopais($nacimiento)
    {
        $pais = "";
        
        $pais = explode(", ", $nacimiento);
        
        $pais = end($pais);
        
        if ($pais == "UK") {
            $pais = "United Kingdom";
        }
        
        return $this->imagenpais($pais);
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