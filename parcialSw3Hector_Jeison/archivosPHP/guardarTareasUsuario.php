<?php
include_once __DIR__.'/tarea.php';

function crear_fecha_sistema()
{
    date_default_timezone_set("America/El_Salvador");
    return date("d-m-Y");
}

function crear_tarea($parCodigo,$parNombre)
{
    $archivo = file_get_contents('../archivosJson/'.$parCodigo.'.json');
    $varTarea = new Tarea($parNombre,crear_fecha_sistema(),false);
    $archivoDecodificado = json_decode($archivo, true);
    $archivoDecodificado[sizeof($archivoDecodificado)] = $varTarea;
    $newArchivo = json_encode($archivoDecodificado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents('../archivosJson/'.$parCodigo.'.json',$newArchivo);
}

function crear_usuario($parCodigoUsuario){
    $vecTareasPredefinidas = array();

    $vecTareasPredefinidas[0] = new Tarea("Planear semana",crear_fecha_sistema(),false);
    $vecTareasPredefinidas[1] = new Tarea("Ser feliz",crear_fecha_sistema(),false);
    $tareas_json = json_encode($vecTareasPredefinidas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $archivo = fopen('../archivosJson/'.$parCodigoUsuario.'.json','w');
    fwrite($archivo,$tareas_json);
    fclose($archivo);
}

?>