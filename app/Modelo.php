<?php

/**
 * Description of Modelo
 *
 * @author kelo
 */
class Modelo extends Entidad{
    private $tabla;
    
    public function __construct($tabla, $bd) {
        $this->tabla= $tabla;
        parent::__construct($tabla, $bd);
        
    }
    
    public function ejecutarSql($query){
        $query = $this->db()->query($query);
        if($query == true){
            if($query->num_rows > 1){
                while($row = $query->fetch_object()) {
                   $resultSet[]=$row;
                }
            }
            elseif($query->num_rows == 1){
                if($row = $query->fetch_object()) {
                    $resultSet = $row;
                }
            }else{
                $resultSet = true;
            }
        }else{
            $resultSet = false;
        }
        
        return $resultSet;
    }
    
    //Aqui podemos montarnos métodos para los modelos de consulta
}
