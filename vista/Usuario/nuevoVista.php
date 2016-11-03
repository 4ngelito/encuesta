          <div class="row">
            <div class="col-md-12">
              <div class="page-header">
                <h1>Usuarios <small><?php echo $titulo; ?></small></h1>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center text-info">Registrar Usuario</h4>
                  <p <?php if(isset($error) && $error[0] = true) echo "class=\"text-danger\"" ?>>
                    <?php if(isset($error)){
                        $i = 0;
                        foreach ($error as $e){
                            if($i > 0) echo $e . "<br>";
                            $i++;
                        }
                    }
                    else echo "Complete todos los campos para registrar un usuario."?>
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
                      <label><input type="checkbox" name="administrador" id="administrador"/> Es administrador</label>
                    </div> 
                    <input type="hidden" value="true" name="nuevo" id="nuevo" />
                    <button type="submit" class="btn btn-default">Crear</button>
                  </form>
                </div>
              </div>
            </div>
          </div>