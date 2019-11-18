<?php
include_once '../archivosPHP/tarea.php';
include_once '../archivosPHP/guardarTareasUsuario.php';

if(isset($_GET["codigo"])){
    $codigoUsuario = $_GET['codigo'];
    $filename = '../archivosJson/'.$codigoUsuario.'.json';
    if(file_exists($filename)){
        echo $codigoUsuario;
    }else{
        crear_usuario($codigoUsuario); 
        echo $codigoUsuario;
    }
    
}


?>