<?php
/**
 * Description of PrincipalControlador
 *
 * @author Kelo
 */
class PrincipalControlador extends Controlador {
    public $conexion;
    public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conexion = new Conexion();
        $this->adapter = $this->conexion->conectar();
        
    }
    
    public function index(){
        $s = $this->getSesion();
        if($s != null){
            $this->vista("Principal::index", array("titulo"=>"Bienvenido"));
        }
        else{
            $this->vista ("Principal::login", array("titulo"=>"Bienvenido"));
        }
    }
    
    public function login(){
        if(isset($_POST['login']) && $_POST['login'] == 'true'){            
            $usuario = new UsuarioModelo($this->adapter);
            $u = $usuario->getUsuarioLogin($_POST['email'], $_POST['password']);
            if($u){
                if(is_object($u)){
                    $user = new Usuario($this->adapter);
                    $user->recuperar($u->id);
                    
                    $sesion = new Sesion($this->adapter);
                    $sesion->setUsuario($user);
                    if($sesion->salvar(true)){
                        $this->setSesion($sesion);
                        $this->redirecciona();
                    }
                    else{
                        echo "ha ocurrido un problema al iniciar sesion";
                    }
                }
                else{
                    echo "datos incorrectos";
                }
            }
            else{
                $this->error();
            }
        }
        else{
            $this->vista("Principal::login",array("titulo"=>"Ingreso al sistema"));
        }
    }
    
    public function logout(){
        if($this->sesionActiva()){
            $s = $this->getSesion();
            if($s->terminar()){
               $this->redirecciona(); 
            }
        }
        $this->redirecciona();
    }
}
