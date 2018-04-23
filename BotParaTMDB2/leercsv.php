<?php
include_once 'conexion.php';
class leercsv
{
        private $bd;
        
        private $link="";
        private $fecha="";
        private $medio="";
    public function __construct($file)
    {
        $this->bd=new BaseDeDatos();
    
        $csv = array_map('str_getcsv', file($file));
        
        for ($i=1;$i<count($csv);$i++){
            for ($j=0;$j<count($csv[$i]);$j++){
                
                $celda=$csv[$i][$j];
                
                switch ($j){
                    case 3: $this->link=$celda;echo $celda; break;
                    case 5: if (!empty($celda)){ $this->medio=$celda; };echo $celda; break;
                    case 6: $this->fecha=$celda;echo $celda; break;
                }
                
            }
            
            $this->bd->pasar($this->link, $this->fecha, 0, $this->medio);
            $this->link="";
            $this->fecha="";            
            $this->medio="";
            echo "<br>";
        }
        
    }
}

$a=new leercsv("diary.csv");

?>
