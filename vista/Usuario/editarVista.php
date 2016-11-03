          <div class="row">
            <div class="col-md-12">
              <div class="page-header">
                <h1>Usuarios <small><?php echo $titulo; ?></small></h1>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center text-info">Modificar Usuario</h4>
                  <p <?php if(isset($error) && $error[0] = true) echo "class=\"text-danger\"" ?>>
                    <?php if(isset($error)){
                        $i = 0;
                        foreach ($error as $e){
                            if($i > 0) echo $e . "<br>";
                            $i++;
                        }
                    }
                    else echo "Complete todos los campos para modificar un usuario."?>
                  </p>
                  <form role="form" method="post" action="<?php echo $asist->url("usuario","editar"); ?>">
                    <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $usuario->nombre; ?>" required/>
                    </div>
                    <div class="form-group">
                      <label for="apellido">Apellido</label>
                      <input class="form-control" id="apellido" name="apellido" type="text" value="<?php echo $usuario->apellido; ?>" required/>
                    </div>
                    
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input class="form-control" id="email" name="email" type="email" value="<?php echo $usuario->email; ?>" required/>
                    </div>
                    
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input class="form-control" id="password" name="password" type="password" />
                    </div>
                    <div class="form-group">
                      <label for="password">Repetir Password</label>
                      <input class="form-control" id="passwordc" name="passwordc" type="password" />
                    </div>
                    
                    <div class="checkbox">
                      <label><input type="checkbox" name="administrador" id="administrador" <?php if($usuario->tipo == "Administrador") echo "checked"; ?>/> Es administrador</label>
                    </div> 
                    <input type="hidden" value="true" name="editar" id="editar" />
                    <input type="hidden" value="<?php echo $usuario->id; ?>" name="id" id="id" />
                    <button type="submit" class="btn btn-success">Actualizar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>