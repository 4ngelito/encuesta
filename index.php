<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Configuración global
require_once 'config/global.php';
 
//Base para los controladores
require_once 'app/Controlador.php';
 
//Funciones para el controlador frontal
require_once 'app/Controlador.func.php';
 
//Carga controladores y acciones
if(isset($_GET["controlador"])){
    $controlador = cargarControlador($_GET["controlador"]);
    lanzarAccion($controlador);
}
else{
    $controlador = cargarControlador(CONTROLADOR_DEFECTO);
    lanzarAccion($controlador);
}
?>
