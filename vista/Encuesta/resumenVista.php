          <div class="row">
            <div class="col-md-12">
              <div class="page-header">
                <h1>Encuesta <small><?php echo $titulo; ?></small></h1>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center text-info">Resumen de Encuestas</h4>
                  <p>
                    Listado de Ejecutivos</p>
                  <table id="tabla" class="table table-hover table-bordered table-condensed">
                    <thead>
                      <tr>
                        <th data-field="id_usuario">ID Usuario</th>
                        <th data-field="nombre">Nombre</th>
                        <th data-field="email">Email</th>
                        <th data-field="cantidad">Cantidad</th>
                        <th >Operacion</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                      if(count($usuarios) > 0) {
                        foreach($usuarios as $u){
                            echo "<tr>";
                            echo "<td>{$u['id_usuario']}</td>";
                            echo "<td>{$u['nombre']}</td>";
                            echo "<td>{$u['email']}</td>";
                            echo "<td>{$u['cantidad']}</td>";
                            echo "<td><a href=\"" . $asist->url("encuesta","detalle") . "&id=" . $u['id_usuario'] ."\" class=\"btn btn-success\">Ver</a></td>";
                            echo "</tr>";
                        }
                      }
                      else echo "<tr><td colspan=\"5\">Sin Encuestas registradas</td></tr>";
                      ?>
                        
                    </tbody>
                  </table>

                  
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">                  
                <div id="grafico" style="width:600px;height:300px"></div>
              </div>
            </div>
          </div>
            <script >
                $(function() {
                grafData = <?php echo $json; ?>;
                $.plot("#grafico", [ grafData ], {
                    series: {
                        bars: {
                            show: true,	
                            barWidth: 0.6,
                            align: "center"
                        }
                    },
                    xaxis: {
                        mode: "categories",
                        tickLength: 0
                    }
                });
            });
            </script>