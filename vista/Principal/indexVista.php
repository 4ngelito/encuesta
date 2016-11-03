      <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h1>Bienvenido <small>Inicia Sesion.</small></h1>
          </div>
          <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
              <form method="post" name="login" action="<?php echo $asist->url("principal","login"); ?>" class="form-horizontal" role="form">
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10"><input class="form-control" id="email" type="email" name="email"></div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Contrase&ntilde;a</label>
                  <div class="col-sm-10"><input class="form-control" id="password" type="password" name="password"></div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label><input type="checkbox" name="recordar" id="recordar">Recordarme</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" id="login" name="login" value="true">
                    <button type="submit" class="btn btn-default">Iniciar Sesion</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-2">
            </div>
          </div>
        </div>
      </div>
