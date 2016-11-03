<?php
require_once 'Conexion.php';

/**
 * Description of Entidad
 *
 * @author kelo
 */
class Entidad {
    /**
     * nombre de la tabla
     * @var type String
     */
    private $tabla;
    private $db;
    private $conexion;

    public function __construct($tabla, $bd) {
        $this->tabla = $tabla;
        $this->conexion = null;
        $this->db = $bd;
    }
    
    public function getConexion(){
        return $this->conexion;
    }
    
    public function db(){
        return $this->db;
    }
        
    public function getTodos(){
        $query = $this->db->query("SELECT * FROM $this->tabla ORDER BY id DESC");
        $resultSet = null;       
        //Devolvemos el resultset en forma de array de objetos
        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }
    
    public function getPorId($id){
        $query = $this->db->query("SELECT * FROM $this->tabla WHERE id=$id");
        $resultSet = null;
        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        return $resultSet;
    }
    
    public function getPor($columna, $valor){
        $query=$this->db->query("SELECT * FROM $this->tabla WHERE $columna='$valor'");
        $resultSet = null;
        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }
    
    public function borraPorId($id){
        $query=$this->db->query("DELETE FROM $this->tabla WHERE id=$id"); 
        return $query;
    }
    
    public function borraPor($columna, $valor){
        $query=$this->db->query("DELETE FROM $this->tabla WHERE $columna='$valor'"); 
        return $query;
    }
    

    /*
     * Aquí podemos montarnos un montón de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
}
