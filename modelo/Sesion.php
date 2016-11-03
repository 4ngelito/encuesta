<?php
/**
 * Description of Sesion
 *
 * @author Kelo
 */
class Sesion extends Entidad {
    /**
     * id unico en bd
     * @var type int
     */
    private $id;
    /**
     * usuario del sistema
     * @var type Usuario
     */
    private $usuario;
    /**
     * fecha login
     * @var type DateTime
     */
    private $fecha_login;
    /**
     * fecha caducidad
     * @var type DateTime
     */
    private $fecha_fin;
    /**
     * token id de sesion
     * @var type String
     */
    private $token;
    /**
     * indica si la sesion esta activa
     * @var type boolean
     */
    private $activa;
    /**
     * nombre de la cookie de sesion
     * @var type String
     */
    static public $cookie = 'sessionToken';
    
    public function __construct($adapter) {
        $tabla = "sesiones";
        parent::__construct($tabla, $adapter);
        
        $this->fecha_login = new DateTime();
        $this->activa = true;
    }
    
    function getId() {
        return $this->id;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getFecha_login() {
        return $this->fecha_login;
    }

    function getFecha_fin() {
        return $this->fecha_fin;
    }

    function getToken() {
        return $this->token;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario(Usuario $usuario) {
        $this->usuario = $usuario;
    }

    function setFecha_login(DateTime $fecha_login) {
        $this->fecha_login = $fecha_login;
    }

    function setFecha_fin(DateTime $fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }

    function setToken($token) {
        $this->token = $token;
    }
    
    private function calcularToken(){
        $key = $this->usuario->getId();
        $crypt = md5(uniqid($key, true));
        $this->setToken($crypt);
    }
    
    public function salvar($recordar = false){
        if($this->getToken() == null) {
            $this->calcularToken();
        }
         
        $fecha_login = $this->getFecha_login();
        $fin = new DateTime($fecha_login->format('Y-m-d H:i:s'));
        
        if($recordar){
            $fin->add(new DateInterval('P3M'));
            setcookie(self::$cookie, $this->getToken(), $fin->getTimestamp(), "/encuesta/", "dev.server.virtual", false, true);
            $this->setFecha_fin($fin);
        }
        else {
            $fin->add(new DateInterval('P1D'));
            $this->setFecha_fin($fin);
        }
        $fFin = ($this->getFecha_fin() != null ) ? $this->fecha_fin->format('Y-m-d H:i:s') : "null";
        $query = "INSERT INTO sesiones (id_usuario, fecha_login, fecha_fin, token)
                VALUES(".$this->usuario->getId().",
                       '".$this->fecha_login->format('Y-m-d H:i:s')."',
                       '".$fFin."',
                       '".$this->getToken()."');";
        $save = $this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
    
    private function tieneCookie(){
        if(isset($_COOKIE[Sesion::$cookie])){
            return true;
        }
        return false;
    }
    
    public function recuperar(){
        if($this->tieneCookie()){
            $token = $_COOKIE[Sesion::$cookie];
            $modelo = new SesionModelo($this->db());
            $sess = $modelo->getSesionPorToken($token);
            if($sess){
                if(is_object($sess) && $sess->activa == 1){
                    $user = new Usuario($this->db());
                    $user->recuperar($sess->id_usuario);
                    $this->setId($sess->id);
                    $this->setToken($sess->token);
                    $this->setUsuario($user);
                    $this->setFecha_login(new DateTime($sess->fecha_login));
                    $this->setFecha_fin(new DateTime($sess->fecha_fin));
                    return true;
                }
                else {
                    unset($_COOKIE[self::$cookie]);
                    setcookie(self::$cookie, null, time()-3600);
                }
            }
        }        
        return false;
    }
    
    public function terminar(){
        $modelo = new SesionModelo($this->db());
        $des = $modelo->desactivaPorToken($this->getToken());
        if($des && $this->tieneCookie()){
            unset($_COOKIE[self::$cookie]);
            setcookie(self::$cookie, null, time()-3600);
            return true;
        }
        return false;
    }
        
}
