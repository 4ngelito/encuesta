          <div class="row">
            <div class="col-md-12">
              <div class="page-header">
                <h1>Usuarios <small><?php echo $titulo; ?></small></h1>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-hover table-bordered table-condensed">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Tipo Usuario</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $ses = $this->getSesion(); 
                      $user = $ses->getUsuario();
                      if(count($allusers) > 0) {
                        foreach($allusers as $u){
                            echo "<tr>";
                            echo "<td>{$u->id}</td>";
                            echo "<td>{$u->nombre}</td>";
                            echo "<td>{$u->apellido}</td>";
                            echo "<td>{$u->email}</td>";
                            echo "<td>{$u->tipo}</td>";
                            echo "<td><a href=\"" . $asist->url("usuario","editar") . "&id=" . $u->id ."\" class=\"btn ";
                            echo $user->getId() == $u->id ? "disabled " : "";
                            echo "btn-success\">Editar</a>"
                                    . " <a href=\"" . $asist->url("usuario","borrar") . "&id=" . $u->id ."\" class=\"btn ";
                            echo $user->getId() == $u->id ? "disabled " : "";
                            echo "btn-danger\">Borrar</a></td>";
                            echo "</tr>";
                        }
                      }
                      else echo "<tr><td colspan=\"6\">Sin Usuarios registrados</td></tr>";
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6">
                  <h4 class="text-center text-info">Registrar Usuario</h4>
                  <p>
                    Complete todos los campos para registrar un usuario.
                  </p>
                  <form role="form" method="post" action="<?php echo $asist->url("usuario","nuevo"); ?>">
                    <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input class="form-control" id="nombre" name="nombre" type="text" <?php if(isset($nombre)) echo "value=\"$nombre\""; ?> required/>
                    </div>
                    <div class="form-group">
                      <label for="apellido">Apellido</label>
                      <input class="form-control" id="apellido" name="apellido" type="text" <?php if(isset($apellido)) echo "value=\"$apellido\""; ?> required/>
                    </div>
                    
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input class="form-control" id="email" name="email" type="email" required/>
                    </div>
                    <div class="form-group">
                      <label for="email">Confirmar Email</label>
                      <input class="form-control" id="emailc" name="emailc" type="email" required/>
                    </div>
                    
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input class="form-control" id="password" name="password" type="password" required/>
                    </div>
                    <div class="form-group">
                      <label for="password">Repetir Password</label>
                      <input class="form-control" id="passwordc" name="passwordc" type="password" required/>
                    </div>
                    
                    <div class="checkbox">
                      <label><input type="checkbox" name="administrador" id="administrador" /> Es administrador</label>
                    </div> 
                    <input type="hidden" value="true" name="nuevo" id="nuevo" />
                    <button type="submit" class="btn btn-default">Crear</button>
                  </form>
                </div>
              </div>
            </div>
          </div>