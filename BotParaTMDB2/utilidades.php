<?php

class Utilidades
{

    public function htmltojson($url)
    {
        //TODO coger la URL en inglés para el eslogan.
        //TODO paginacion y buscador, pagina de la pelicula y del actor.
        
        $json2 = file_get_contents($url);
        $array2 = json_decode($json2, true);
        
        return $array2;
    }
    
    public function nomostrarnull($dato){
        if (empty($dato)){
            echo "-";
        }else{
            echo $dato;
        }
    }
    
    public function imagenpais($pais){
        $array2=$this->htmltojson("https://restcountries.eu/rest/v2/name/".$pais);
        
        $imagen=$array2[0]["flag"];
        
        return "<img width=64 src=".$imagen.">";
    }
    
    public function ordenaraleatorio()
    {
        $ficheros = scandir("images/bg");
        unset($ficheros[0]);
        unset($ficheros[1]);
        shuffle($ficheros);
        
        return $ficheros;
    }
    
    public function nacimientopais($nacimiento){
        $pais="";
        
        $pais=explode(", ", $nacimiento);
        
        $pais=end($pais);
        
        return $this->imagenpais($pais);
    }
    
    public function sexo($sexo){
        if ($sexo==2){
            ?> male   <i class="ion-male"></i><?php 
        }else if ($sexo==1){
            ?> female   <i class="ion-female"></i><?php 
        }else{
            ?> - <?php 
        }
    }
    
    
    public function fechaesp($fechaor){
        $fecha1 = new DateTime($fechaor);
        return $fecha1->format('d-m-Y');
    }

    public function minutosahoras($minutosi)
    {
        $final="";
        
        $minutos = $minutosi % 60;
        $hora = ($minutosi - ($minutosi % 60)) / 60;
        
        if ($minutos==0){
            $final=$hora . "H";
        }else{
            $final=$hora . "H " . $minutos . " MIN.";
        }
        
        return $final;
    }
}

?>