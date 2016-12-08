      <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h1>Bienvenido <small><?php 
                      $user = $this->getSesion()->getUsuario();
                      echo $user->getNombre();
                      ?></small></h1>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p>Seleccione una opcion del menu superior.</p>   
            </div>
          </div>
        </div>
      </div>
