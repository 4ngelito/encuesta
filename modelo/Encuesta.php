<?php
/**
 * Description of Encuesta
 *
 * @author Kelo
 */
class Encuesta extends Entidad {
    /**
     * @var integer
     */
    private $id;
    
    /**
     *
     * @var Usuario
     */
    private $usuario;
    
    private $preguntas;
    private $respuestas;
    private $fecha;
    
    public function __construct($adapter) {
        $tabla = "encuestas";
        parent::__construct($tabla, $adapter);
        
        $this->preguntas = ["n"=> 0, "preguntas"=> null];
        $this->respuestas = ["n"=> 0, "respuestas"=> null];
        
        $this->fecha = time();
    }
    
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * 
     * @return integer
     */
    public function cantidadPreguntas() {
        return $this->preguntas["n"];
    }

    public function setUsuario(Usuario $usuario) {
        $this->usuario = $usuario;
    }
            
    public function guardar(){
        $query = "INSERT INTO encuestas (id_usuario, respuestas)
                VALUES('".$this->usuario->getId()."',
                       '" . $this->respuestasJson()."');";
        $save = $this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
    
    
    public function preguntaHtml($paramPregunta){
        $n = count($paramPregunta);
        
        if($n == 3){
            $id = $paramPregunta[0];
            $tipo = $paramPregunta[1];
            $params = $paramPregunta[2];
        }
        else {
            $id = $paramPregunta[0];
            $tipo = $paramPregunta[1];
            $placeholder = $paramPregunta[2];
            $requerido = $paramPregunta[3];
            if(isset($paramPregunta["valores"],$paramPregunta)) $valores = $paramPregunta["valores"];
            
        }
        
        
        $html = "";
        
        switch ($tipo){
            case "select":
                $html .= "<select class='form-control' name='$id' id='$id'";
                if($requerido) $html .= " required";
                $html .= ">".PHP_EOL;
                $html .= "<option value=''>$placeholder</option>".PHP_EOL;
                $nValores = count($valores);
                $i = 1;
                foreach($valores as $v){
                    $html .= "<option value='$v'>". ucwords($v) ."</option>".PHP_EOL;
                }
                $html .= "</select>".PHP_EOL;
                break;
            case "compuesto":
                foreach($params as $p){
                    $html .= $this->preguntaHtml($p);
                }
                break;
            
            case "dependiente":
                foreach($params[1] as $p){
                    $html .= $this->preguntaHtml($p);
                }
                break;
            
            default:
            $multiple = ($tipo == "radio" || $tipo == "checkbox");
            if($multiple && is_array($valores)){
                $i = 1;
                $html .= "<div class='$tipo'>";
                foreach($valores as $v){
                    $html .= "<label for='".$id . $i."'><input type='$tipo' name='".$id."[]' value='$v' id='".$id . $i."'";
                    //if($requerido) $html .= " required";
                    $html .= "> ".  ucwords($v)."</label>".PHP_EOL;
                    $i++;
                }
                $html .= "</div>".PHP_EOL;
            }
            else{
                $html .= "<input type='$tipo' name='$id' placeholder='$placeholder' id='$id'";
                    if($requerido) $html .= " required";
                    $html .= "><br>".PHP_EOL;;
            }
        }
        
        return $html;
    }  
            
    public function poblarPreguntas(){
        $pregunta = ["p1" => 
            ["Indique su nombre" =>
                ["nombre","text", "Pepito Perez", true, null]
        ]
        ];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p2" => 
            ["Indique su edad" =>
                ["edad","number", "18", true, null]
        ]
        ];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p3" => 
            ["Indique Profesion u Oficio" =>
                ["profesion","select", "Seleccione", true, "valores"  =>
                    ["estudiante", "trabajador", "jubilado"]
        ]
        ]
        ];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p4" => 
            ["Indique su sexo" =>
                ["sexo","radio", "Sexo", true, "valores" =>
                    ["femenino", "masculino", "otro"]
        ]
        ]
        ];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p5" => 
            ["Indique su Region" =>
                ["region", "select", "Seleccione", true, "valores" =>
                    ["XV de Arica y Parinacota", "V de Valparaíso", "XIV de los Ríos"
                        ,"II de Antofagasta", "VII del Maule", "XI Aisén del General Carlos Ibáñez del Campo"
                        ,"III de Atacama", "VIII del Bío Bío", "XII de Magallanes y Antártica Chilena"
                        , "IV de Coquimbo	IX de la Araucanía", "Metropolitana de Santiago"
                        ]
                    ]
        ]
        ];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p6" => 
            ["Indique su Comuna" =>
                ["comuna", "select"
                    //,"dependiente", [ "region", ["comuna", "select" 
                        , "Seleccione", true, "valores" =>
                    ["comuna 1", "comuna 2", "comuna 3"]
                        ]
        ]
        ];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p7" => 
            ["Indique su Operador de Telefonia Movil Utiliza" =>
                ["operador","select", "Seleccione", true, "valores" =>
                    ["entel", "movistar", "vlaro", "virgin", "wom", "otro"]
        ]
        ]];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p8" => 
            ["Cuanto tiempo lleva utilizando su servicio" =>
                ["tiempo", "compuesto", [
                    ["tiempoNumero","number", "1", true , null]
                    , ["tiempoIntervalo", "select", "Seleccione", true, "valores" =>
                        ["year", "mes"]
                        ]
                    ]
                    ]
                ]
            ];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p9" => 
            ["Que tipo de servicio posee" =>
                ["servicio", "radio", "Tipo", true , "valores" =>
                    ["prepago", "postpago"]
        ]
        ]];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p10" => 
            ["utiliza datos moviles" =>
                ["datosMoviles","radio", "Datos Moviles", true, "valores" => 
                    ["si", "no"]
        ]
        ]];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p11" => 
            ["Que redes sociales utiliza" =>
                ["redesSociales","checkbox", "Redes Sociales", true, "valores" => 
                    ["facebook" ,"instagram", "twitter", "google +", "otro"]
        ]
        ]];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p12" => 
            ["Cuantas horas utiliza las redes sociales al d&iacute;a" =>
                ["horasRedSocial", "radio", "Horas", true ,"valores" => 
                    ["1 hora o menos", "Entre 1 y 3 horas", "3 o mas horas"]
        ]
        ]];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p13" => 
            ["Cual de los siguientes servicio de Streaming Utiliza" =>
                ["streaming", "checkbox", "Servicios", true,"valores" =>
                    ["youtube","spotify","wefre","otro"]
        ]
        ]];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p14" => 
            ["Qué tiene valor para usted en el servicio de telefonía móvil" =>
                ["valor", "checkbox", "Valor al Servicio", true, "valores" =>
                    ["Buena cobertura", "Velocidad en Conexión a internet", "Comunicación PTT", "Calidad en Atención al Cliente"]
        ]
        ]];
        $this->agregarPregunta($pregunta);
        
        $pregunta = ["p15" => 
            ["Como califica el servicio de su operador de telefonía móvil" =>
                ["calificacion", "text", "1", true, null]
                ]
        ];
        $this->agregarPregunta($pregunta);
        
    }
    
    public function obtenerPregunta($n){
        $pregunta = null;
        if($this->preguntas["n"] > 0 && $n > 0){
            return $this->preguntas["preguntas"][$n-1];
        }
        return $pregunta;
    }
    
    private function respuestasJson(){
        return json_encode($this->respuestas['respuestas']);
    }
    
    private function agregarPregunta($pregunta){
        $n = $this->preguntas["n"];
        $n++;
        $this->preguntas["n"] = $n;
        $this->preguntas["preguntas"][] = $pregunta;
    }
    
    public function agregarRespuesta($r){
        $n = $this->respuestas["n"];
        $n++;
        $this->respuestas["n"] = $n;
        if(is_array($r) && count($r) == 1){
            $this->respuestas["respuestas"][] = $r[0];
        }
        else {
            $this->respuestas["respuestas"][] = $r;
        }
    }
    
}
