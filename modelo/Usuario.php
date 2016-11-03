<?php
/**
 * Description of Usuario
 *
 * @author kelo
 */
class Usuario extends Entidad{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $tipo;
    
    public function __construct($adapter) {
        $tabla = "usuarios";
        parent::__construct($tabla, $adapter);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    private function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    
    function esAdministrador(){
        if($this->tipo == "Administrador") return true;
        return false;
    }
    
    public function recuperar($id){
        $u = $this->getPorId($id);
        $this->id = $u->id;
        $this->nombre = $u->nombre;
        $this->apellido = $u->apellido;
        $this->email = $u->email;
        $this->tipo = $u->tipo;
        $this->password = $u->password;
        return $this;
    }

    public function guardar(){
        $query = "INSERT INTO usuarios (nombre,apellido,email,password,tipo)
                VALUES('".$this->nombre."',
                       '".$this->apellido."',
                       '".$this->email."',
                       '".$this->password."',
                       '".$this->tipo."');";
        $save = $this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
    
    public function actualizar(){
        $query = "UPDATE usuarios SET nombre = '$this->nombre',"
                . "apellido = '$this->apellido',"
                . "email = '$this->email',"
                . "password = '$this->password',"
                . "tipo = '$this->tipo'"
                . "WHERE id = $this->id";
        $up = $this->db()->query($query);
        return $up;
    }
}
