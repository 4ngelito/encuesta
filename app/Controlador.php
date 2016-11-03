<?php

/**
 * Description of Controlador
 *
 * @author kelo
 */
class Controlador {
    /**
     * indicador de sesion activa
     * @var type Sesion
     */
    private $sesion;
    
    public function __construct() {
	require_once 'Conexion.php';
        require_once 'Entidad.php';
        require_once 'Modelo.php';
        
        //Incluir todos los modelos
        foreach(glob("modelo/*.php") as $file){
            require_once $file;
        }
        
        $con = new Conexion();
        
        $s = new Sesion($con->conectar());
        if($s->recuperar()){
            $this->setSesion($s);
        }
        else{
            if(!(strpos(strtoupper(get_class($this)), strtoupper(CONTROLADOR_DEFECTO)) !== false)) $this->redirecciona();
        }
        unset($con);
    }
    
    function getSesion() {
        return $this->sesion;
    }

    function setSesion(Sesion $sesion) {
        $this->sesion = $sesion;
    }

        //Plugins y funcionalidades
    
    public function vista($vista, $datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor; 
        }
        $v = explode("::", $vista);
        
        require_once 'app/Vista.php';
        $asist = new Vista();        
        
        require_once 'vista/header.php';
        require_once 'vista/'. $v[0] .'/'.$v[1].'Vista.php';
        require_once 'vista/footer.php';
    }
    
    public function redirecciona($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        header("Location:index.php?controlador=".$controlador."&accion=".$accion);
    }
    
    public function error(){
        echo "ERROR! en " . get_class();
    }


    //Métodos para los controladores
    
    public function sesionActiva(){
        if($this->getSesion() == null){
            return false;
        }
        return true;
    }
    
}
