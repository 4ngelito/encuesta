<?php
/**
 * Description of UsuariosControlador
 *
 * @author kelo
 */
class UsuarioControlador extends Controlador {
    public $conexion;
    public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conexion = new Conexion();
        $this->adapter = $this->conexion->conectar();
    }
    
    public function index(){
        
        $usuario = new Usuario($this->adapter);
        
        $allusers = $usuario->getTodos();
       
        $this->vista("Usuario::index",array("titulo" => "Lista Usuarios",
            "allusers"=>$allusers
        ));
    }
    
    public function nuevo(){    
        if(isset($_POST["nuevo"]) && $_POST['nuevo'] == "true"){
            $error[0] = false;
            //Creamos un usuario
            $usuario = new Usuario($this->adapter);
            $usuario->setNombre($_POST["nombre"]);
            $usuario->setApellido($_POST["apellido"]);
            $tipo = isset($_POST['administrador']) ? "Administrador" : "Ejecutivo";
            $usuario->setTipo ($tipo);
            
            if($_POST["email"] == $_POST["emailc"]){
                $usuario->setEmail($_POST["email"]);
                $usuarioModelo = new UsuarioModelo($this->adapter);
                $usuarioModelo->getUsuarioPorEmail($usuario->getEmail());
                if($usuarioModelo->db()->affected_rows > 0){
                    $error[0] = true;
                    $error[] = "el correo ya se encuentra registrado";
                }
            }
            else {
                $error[0] = true;
                $error[] = "Los correos no son iguales";
            }
            
            if($_POST["password"] == $_POST["passwordc"]) $usuario->setPassword(sha1($_POST["password"]));
            else {
                $error[0] = true;
                $error[] = "Las password no son iguales";
            }
            
            if(!$error[0]) {
                $save = $usuario->guardar();
                $this->redirecciona("Usuario", "index");
            }
            else $this->vista("Usuario::nuevo", array("titulo"=>"Registrar Usuario"
                    , "error" => $error
                    , "nombre" => $_POST["nombre"]
                    , "apellido" => $_POST["apellido"]));
        }
        else {
            $this->vista("Usuario::nuevo", array("titulo"=>"Registrar Usuario"));
        }
    }
    
    public function editar(){    
        $usuario = new Usuario($this->adapter);
        if(isset($_POST["editar"]) && $_POST['editar'] == "true"){
            $error[0] = false;
            $usuario->recuperar($_POST['id']);
            //Creamos un usuario
            $usuario->setNombre($_POST["nombre"]);
            $usuario->setApellido($_POST["apellido"]);
            $tipo = isset($_POST['administrador']) ? "Administrador" : "Ejecutivo";
            $usuario->setTipo ($tipo);
            
            $usuarioModelo = new UsuarioModelo($this->adapter);
            $res = $usuarioModelo->getUsuarioPorEmail($_POST["email"]);
            if($usuarioModelo->db()->affected_rows > 0 && $res->email != $usuario->getEmail()){
//                if($res->email != $usuario->getEmail())
                $error[0] = true;
                $error[] = "el correo ya se encuentra registrado";
            }
            else {
                $usuario->setEmail($_POST["email"]);
            }
                
            if($_POST["password"] != ""){
                if($_POST["password"] == $_POST["passwordc"]) $usuario->setPassword(sha1($_POST["password"]));
                else {
                    $error[0] = true;
                    $error[] = "Las password no son iguales";
                }
            }
            
            if(!$error[0]) {
                $save = $usuario->actualizar();
                $this->redirecciona("Usuario", "index");
            }
            else $this->vista("Usuario::editar", array("titulo"=>"Editar Usuario"
                    , "error" => $error
                    , "usuario" => $usuario->getPorId($_POST['id'])));
        }
        else {
            if(isset($_GET['id'])){
                $u = $usuario->getPorId($_GET['id']);
                $this->vista("Usuario::editar", array("titulo"=>"Editar Usuario", "usuario" => $u));
            }
            else $this->redirecciona("Usuario");
        }
    }
    
    public function borrar(){
        if(isset($_GET["id"])){ 
            $id=(int)$_GET["id"];
            
            $usuario=new Usuario($this->adapter);
            $usuario->borraPorId($id); 
        }
        $this->redirecciona('Usuario');
    }
}
