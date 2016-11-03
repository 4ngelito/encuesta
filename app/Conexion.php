<?php
include_once 'config/bd.php';

class Conexion {
    
    public function conectar(){
        $con=new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NOMBRE);
        return $con;
    }
}