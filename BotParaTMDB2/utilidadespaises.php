<?php 
class UtilidadesPaises{
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


}

?>