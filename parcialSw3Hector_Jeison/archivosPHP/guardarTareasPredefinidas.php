<?php
//include 'archivosPHP/tarea.php';
include_once __DIR__.'/tarea.php';

function crear_fecha_sistema()
{
    date_default_timezone_set("America/El_Salvador");
    return date("d-m-Y");
}

$vecTareasPredefinidas = array();
$vecTareasPredefinidas[0] = new Tarea("Planear semana",crear_fecha_sistema(),false);
$vecTareasPredefinidas[1] = new Tarea("Ser feliz",crear_fecha_sistema(),false);

$tareas_json = json_encode($vecTareasPredefinidas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$archivo = fopen('../archivosJson/vecTareasPredefinidas.json','w');
fwrite($archivo,$tareas_json);
fclose($archivo);
?>

