<?php
function cargarControlador($controlador){
    $c = ucwords($controlador).'Controlador';
    $archivoControlador = 'controlador/'.$c.'.php';
     
    if(!is_file($archivoControlador)){
        $archivoControlador = 'controlador/'.ucwords(CONTROLADOR_DEFECTO).'Controlador.php';   
    }
    
    require_once $archivoControlador;
    $controllerObj = new $c();
    return $controllerObj;
}
 
function cargarAccion($controlador, $action){
    $accion = $action;
    $controlador->$accion();
}
 
function lanzarAccion($controllerObj){
    if(isset($_GET["accion"]) && method_exists($controllerObj, $_GET["accion"])){
        cargarAccion($controllerObj, $_GET["accion"]);
    }else{
        cargarAccion($controllerObj, ACCION_DEFECTO);
    }
}
