<?php

/**
 * Description of SesionModelo
 *
 * @author Kelo
 */
class SesionModelo extends Modelo{
    private $tabla;
    
    public function __construct($adapter){
        $this->tabla = "sesiones";
        parent::__construct($this->tabla, $adapter);
    }
    
    public function getSesionPorToken($token){
        $query = "SELECT * FROM sesiones WHERE token='$token'";
        $result = $this->ejecutarSql($query);
        return $result;
    }
    
    public function desactivaPorToken($token){
        $query = "UPDATE sesiones SET activa = 0 WHERE token='$token'";
        $result = $this->ejecutarSql($query);
        return $result;
    }
}
