
<?php
    class Tarea {
       public $atrNombre ;
       public $atrFechaCreacion;
       public $atrEstado = false;
       
       // metodo constructor
       public function __construct($parNombre, $parFechaCreacion, $parEstado)
       {
           $this->atrNombre =$parNombre;
           $this->atrFechaCreacion = $parFechaCreacion;
           $this->atrEstado = $parEstado;
           
       }

     // metodos consultores getter
    public function getAtrNombre(){
        return $this->atrNombre;
    }  
    
    public function getAtrFechaCreacion(){
        return $this->atrFechaCreacion;
    }

    public function getAtrEstado(){
        return $this->atrEstado;
    }
    
    // metodos mutadores setter
    public function setAtrNombre($parNombre){
        $this->atrNombre = $parNombre;
        return $this;
    }
    
    
    public function setAtrFechaCreacion($parFechaCreacion){
        $this->atrFechaCreacion = $parFechaCreacion;
        return $this;
    }

    
    public function setAtrEstado($parEstado){
        $this->semestre = $parEstado;
        return $this;
    }


    }
?>