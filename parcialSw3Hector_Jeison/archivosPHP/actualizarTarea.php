<?php
include_once '../archivosPHP/tarea.php';
include_once __DIR__.'/tarea.php';

if(isset($_POST["nombreTarea"])){
    $nombreTarea = $_POST["nombreTarea"];
    $codigoUsuario = $_POST["codigoUsuario"];
    $state = $_POST["state"];
    $nuevaCadenaJeison = json_encode($datos);
    header('Content-Type: application/json');

    $array = json_decode($nuevaCadenaJeison,true);
    //echo $array;
    //actualizamos el archivo del estudiante
    
    $filename = '../archivosJson/'.$codigoUsuario.'.json';
    $valor = false;
    if($state == "false"){
        $valor = false;
    }else{
        $valor = true;
    }
    $archivo = file_get_contents('../archivosJson/'.$codigoUsuario.'.json');
    $archivoDecodificado = json_decode($archivo, true);
    foreach ($archivoDecodificado as $key => $entry) {
        if (strcmp($entry['atrNombre'],$nombreTarea)==0) {
            $archivoDecodificado[$key]['atrEstado'] = $valor;
        }
    }
    $json = json_encode($archivoDecodificado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents('../archivosJson/'.$codigoUsuario.'.json',$json);
    
}
?>