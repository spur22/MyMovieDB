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
    
    
    public function imagenpaisdosletras($dosletras){
        $imagenfinal = "<img src='flags/blank.gif' class='flag flag-".$dosletras."'  title='" . $dosletras . "' >";
        return $imagenfinal;
    }
    
    public function codigopais($paisentero){
        $dosletras="__";
        switch ($paisentero) {
            case "Australia": $dosletras="au";break;
            case "Belgium": $dosletras="be";break;
            case "Bulgaria": $dosletras="bg";break;
            case "Canada": $dosletras="ca";break;
            case "Chile": $dosletras="cl";break;
            case "China": $dosletras="cn";break;
            case "Denmark": $dosletras="dk";break;
            case "Finland": $dosletras="fi";break;
            case "France": $dosletras="fr";break;
            case "Germany": $dosletras="de";break;
            case "Hong Kong": $dosletras="hk";break;
            case "Hungary": $dosletras="hu";break;
            case "Ireland": $dosletras="ie";break;
            case "Italy": $dosletras="it";break;
            case "Japan": $dosletras="jp";break;
            case "New Zealand": $dosletras="nc";break;
            case "Poland": $dosletras="pl";break;
            case "Portugal": $dosletras="pt";break;
            case "South Africa": $dosletras="za";break;
            case "Spain": $dosletras="es";break;
            case "Switzerland": $dosletras="ch";break;
            case "United Arab Emirates": $dosletras="ae";break;
            case "United Kingdom": $dosletras="gb";break;
            case "United States of America": $dosletras="us";break;
            default : $dosletras="__";break;
            
        }
        
        return $dosletras;
        
    }
    
    public function imagenpais($paisentero)
    {
        
        $dosletras=$this->codigopais($paisentero);
      
        return $this->imagenpaisdosletras($dosletras);
  
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
        $caracter='';
        if (strpos($pais, ',')){
            $caracter=',';
        }else if (strpos($pais, '-')){
            $caracter='-';
            }
        
        $pais = explode($caracter." ", $nacimiento);
        
        $pais = end($pais);
  
        if ($pais == "UK") {
            $pais = "United Kingdom";
        }else if ($pais == "USA"){
            $pais = "United States of America";
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