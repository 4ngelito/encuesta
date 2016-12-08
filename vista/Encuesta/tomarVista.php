          <div class="row">
            <div class="col-md-12">
              <div class="page-header">
                <h1>Encuesta <small><?php echo $titulo; ?></small></h1>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center text-info">Registrar Encuesta</h4>
                  <p>
                    Complete todos los campos para registrar una encuesta.
                  </p>
                  <form role="form" method="post" action="<?php echo $asist->url("encuesta","registrar"); ?>" id="encuestaForm">
                    <?php
                    
                    /* @var $encuesta Encuesta */
                    $encuesta->poblarPreguntas();
                    $n = $encuesta->cantidadPreguntas();
                    for ($i = 1; $i <= $n; $i++){
                        $pregunta = $encuesta->obtenerPregunta($i);
                        $html = "<div class='form-group'>".PHP_EOL;
                        foreach($pregunta as $e => $p){
                            foreach ($p as $etiqueta => $param){
                                //var_dump($param);
                                $html .= "<label class='col-md-6 control-label' for='$param[0]'>$etiqueta</label>".PHP_EOL;
                                $html .= "<div class='col-md-6'>".PHP_EOL;
                                $html .= $encuesta->preguntaHtml($param).PHP_EOL;
                                $html .= "</div>".PHP_EOL;
                            }
                            
                        }
                        $html .= "</div>";
                        echo $html.PHP_EOL;
                    }
                    ?>
                    <input type="hidden" value="true" name="nuevo" id="nuevo" />
                    <button type="submit" class="btn btn-success" id="checkBtn">Crear</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            $(document).ready(function () {
                $('#checkBtn').click(function() {
                  checked = $("input[type=checkbox]:checked").length;

                  if(!checked) {
                      alert("Debe completar al menos una selección.");
                      return false;
                  }
                });
                var $intervalo = $('#tiempoIntervalo').val();
                var $numero = $('#tiempoNumero').val();
                $("#encuestaForm").submit( function(eventObj) {
                    $('<input />').attr('type', 'hidden')
                        .attr('name', "tiempo")
                        .attr('value', $numero+$intervalo)
                        .appendTo('#encuestaForm');
                    return true;
                    });
            });

            </script>