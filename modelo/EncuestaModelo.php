<?php
/**
 * Description of EncuestaModelo
 *
 * @author Kelo
 */
class EncuestaModelo Extends Modelo {
    public function __construct($adapter){
        $this->tabla = "encuestas";
        parent::__construct($this->tabla, $adapter);
        
    }
    
    public function leerPorUsuario($idUsuario){
        $query = $this->db()->query("SELECT * FROM encuestas WHERE id_usuario = $idUsuario ORDER BY id DESC");
        $resultSet = null;       
        //Devolvemos el resultset en forma de array de objetos
        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }
    
    public function cantidadPorUsuario($idUsuario){
        $query = "SELECT count(*) as n FROM encuestas WHERE id_usuario = $idUsuario ";
        $result = $this->ejecutarSql($query);
        return $result;        
    }
    
    public function cantidadPorUsuarioTotal(){
        $query = "SELECT COUNT(DISTINCT(id_usuario)) n FROM `encuestas`";
        $result = $this->ejecutarSql($query);
        return $result;   
    }
}
