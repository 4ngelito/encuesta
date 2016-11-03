<?php

/**
 * Description of UsuarioModelo
 *
 * @author kelo
 */
class UsuarioModelo extends Modelo {
    private $tabla;
    
    public function __construct($adapter){
        $this->tabla = "usuarios";
        parent::__construct($this->tabla, $adapter);
    }
    
    //Metodos de consulta
    public function getUsuarioLogin($email, $pass){
        $pass = sha1($pass);
        $query = "SELECT * FROM usuarios WHERE email='$email' and password = '$pass'";
        $result = $this->ejecutarSql($query);
        return $result;
    }
    
    public function getUsuarioPorEmail($mail){
        $query = "SELECT * FROM usuarios WHERE email = '$mail'";
        $result = $this->ejecutarSql($query);
        return $result;
    }
}
