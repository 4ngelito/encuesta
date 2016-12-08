          <div class="row">
            <div class="col-md-12">
              <div class="page-header">
                <h1>Encuestas de <?php echo $user->getNombre() ?> <small><?php echo $titulo; ?></small></h1>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center text-info">Detalle de Encuestas</h4>
                  <p>
                    Listado de respuestas por encuesta</p>
                  <table id="tabla" class="table table-hover table-bordered table-condensed">
                    <thead>
                      <tr>
                        <th data-field="fecha">Fecha</th>
                        <?php
                            for($i=0;$i<count($p);$i++){
                                echo "<th>". ($i+1) . ". " . $p[$i]. "</th>" . PHP_EOL;
                            }
                        ?>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                      if(count($encuestas) > 0) {
                        
                        foreach($encuestas as $u){
                            echo "<tr>";
                            echo "<td>".$u->fecha ."</td>".PHP_EOL;
                            $respuestas = json_decode($u->respuestas);
                            for($i = 0; $i < count($respuestas); $i++){
                                if(is_array($respuestas[$i])){
                                    echo "<td><ul>";
                                    for($j=0;$j<count($respuestas[$i]);$j++){
                                        echo "<li>".$respuestas[$i][$j]."</li>";
                                    }
                                    echo "</ul></td>";
                                }
                                else{
                                    echo "<td>$respuestas[$i]</td>".PHP_EOL;
                                }
                            }
                            //echo "<td><a href=\"" . $asist->url("resumen","detalle") . "&id=" . $u['id_usuario'] ."\" class=\"btn btn-success\">Ver</a></td>";
                            echo "</tr>".PHP_EOL;
                        }
                      }
                      else echo "<tr><td colspan=\"5\">Sin Encuestas registradas</td></tr>".PHP_EOL;
                      ?>
                        
                    </tbody>
                  </table>

                  
                </div>
              </div>
            </div>
          </div>

