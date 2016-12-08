<?php
/**
 * Description of EncuestaControlador
 *
 * @author Kelo
 */
class EncuestaControlador extends Controlador{
    public $conexion;
    public $adapter;
    
    public function __construct() {
        parent::__construct();
		 
        $this->conexion = new Conexion();
        $this->adapter = $this->conexion->conectar();
    }
    
    public function resumen(){
        $usuarios = $this->obtenerArray();
        $sourceJson = json_encode($this->obtenerArraySimple());
        $this->vista("Encuesta::resumen", ["titulo"=>"Registrar encuestas", "usuarios" => $usuarios, "json" => $sourceJson]);
    }
    
    public function jsonSimple(){
        $usuarios = $this->obtenerArray();
        header('Content-Type: application/json');
        echo json_encode($this->obtenerArraySimple());
        
    }
    
    public function detalle(){
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $idUsuario = $_GET['id'];
            
            $encuestasModelo = new EncuestaModelo($this->adapter);
            $encuestas = $encuestasModelo->leerPorUsuario($idUsuario);
            
            $user = new Usuario($this->adapter);
            $user->recuperar($idUsuario);
            
            $preguntas = new Encuesta($this->adapter);
            $preguntas->poblarPreguntas();
            
            
            $n = $preguntas->cantidadPreguntas();
            for($i = 1; $i <= $n; $i++){
                $pregunta = $preguntas->obtenerPregunta($i);
                foreach($pregunta as $e => $p){
                    foreach ($p as $etiqueta => $param){
                        //var_dump($param);
                        $pConsolidadas[] = $etiqueta;
                    }

                }
            }
            $this->vista("Encuesta::detalle", ["titulo"=>"Detalle encuestas", "encuestas" => $encuestas, 'user' => $user, "p" => $pConsolidadas]);
        }
    }
    
    public function ajax(){
        $json = $this->obtenerArray();
        /*$export['records'] = $json;
        $export['queryRecordCount'] = $n;
        $export['totalRecordCount'] = (int)$cantidadEncuestas->n;
        */
        header('Content-Type: application/json');
        echo json_encode($json);
    }
    
    public function tomar(){
        $e = new Encuesta($this->adapter);
        $this->vista("Encuesta::tomar",  ["titulo"=>"Registrar encuestas", "encuesta" => $e]);
    }
    
    public function registrar(){
        if(isset($_POST['nuevo']) && $_POST['nuevo'] == 'true'){
            $s = $this->getSesion();
            $u = $s->getUsuario();
            $e = new Encuesta($this->adapter);
            $e->poblarPreguntas();
            $e->setUsuario($u);
            $n = $e->cantidadPreguntas();
            for ($i = 1; $i <= $n; $i++){
                $pregunta = $e->obtenerPregunta($i);
                foreach($pregunta as $p){
                    foreach ($p as $etiqueta => $param){                        
                        if(isset($_POST[$param[0]])){
                            $e->agregarRespuesta($_POST[$param[0]]);
                        }
                    }                            
                }
            }
            $e->guardar();
            $r['estado'] = "ok";
             
        }
        $this->redirecciona("encuesta","tomar");
    }
    
    private function obtenerArray(){
        $usuarioModelo = new UsuarioModelo($this->adapter);
        $id = $usuarioModelo->getTodosId();
        $cantidadUsuarios = count($id);
        
        $encuestasModelo = new EncuestaModelo($this->adapter);
        $cantidadEncuestas = $encuestasModelo->cantidadPorUsuarioTotal();
        $n = 0;
        foreach ($id as $u){
            $n++;
            if(is_object($u)){
                $user = new Usuario($this->adapter);
                $user->recuperar($u->id);
                
                
                $encuestas = $encuestasModelo->cantidadPorUsuario((int)$user->getId());
                
                
                $json[] = ["id_usuario" => (int)$user->getId()
                        , "nombre" => $user->getNombre() . " " . $user->getApellido()
                        , "email" => $user->getEmail()
                        , "cantidad" => (int)$encuestas->n
                        ];                
            }
            else{
                $json[] = ["id_usuario" => null
                        , "nombre" => null
                        , "email" => null
                        , "cantidad" => null
                        ];
            }
        }
        return $json;
    }
    
    private function obtenerArraySimple(){
        $usuarioModelo = new UsuarioModelo($this->adapter);
        $id = $usuarioModelo->getTodosId();
        $cantidadUsuarios = count($id);
        
        $encuestasModelo = new EncuestaModelo($this->adapter);
        $cantidadEncuestas = $encuestasModelo->cantidadPorUsuarioTotal();
        $n = 0;
        foreach ($id as $u){
            $n++;
            if(is_object($u)){
                $user = new Usuario($this->adapter);
                $user->recuperar($u->id);
                
                
                $encuestas = $encuestasModelo->cantidadPorUsuario((int)$user->getId());
                
                
                $json[] = [$user->getNombre() . " " . $user->getApellido(), (int)$encuestas->n];                
            }
            else{
                $json[] = [null, null];
            }
        }
        return $json;
    }
}
