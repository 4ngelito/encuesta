<?php

/**
 * Description of Vistas
 *
 * @author kelo
 */
class Vista {    
    public function url($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        $urlString="index.php?controlador=".$controlador."&accion=".$accion;
        return $urlString;
    }
     
    //Helpers para las vistas
}
