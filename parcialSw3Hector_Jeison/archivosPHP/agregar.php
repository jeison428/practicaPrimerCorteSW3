<?php
include_once '../archivosPHP/tarea.php';
include_once '../archivosPHP/guardarTareasUsuario.php';

$cosa = $_POST['nombre'];
$cosa2 = $_POST['codigo'];
header('Content-Type: application/json');
$algo = array('codigo'=>$cosa2, 'nombre'=>$cosa);
if(isset($algo)){
    $codigoUsuario = $algo;
    crear_tarea($codigoUsuario['codigo'], $codigoUsuario['nombre']);
}

?>