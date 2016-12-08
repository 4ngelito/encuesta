<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/encuesta/icon.png" rel="apple-touch-icon" />
    <link href="/encuesta/icon.png" rel="icon" sizes="128x128" />

    <title><?php echo $titulo; echo " - "; echo TITULO_SITIO; ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css">
        

  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                <span class="sr-only">Ver Menu</span>
                <span class="icon-bar"> </span>
                <span class="icon-bar"> </span>
                <span class="icon-bar"> </span>
              </button>
              <a class="navbar-brand" href="/encuesta"><?php echo TITULO_SITIO; ?></a>
            </div>
            <?php if($this->sesionActiva()){
            $ses = $this->getSesion(); 
            $u = $ses->getUsuario();?>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $asist->url("encuesta", "tomar"); ?>">Encuestas</a></li>
                <li><a href="<?php echo $asist->url("encuesta", "resumen"); ?>">Resumen</a></li>
                <?php if($u->esAdministrador()) { ?>
                <li><a href="<?php echo $asist->url("usuario"); ?>">Usuarios</a></li>
                <?php } ?>
                <li><a href="<?php echo $asist->url("principal", "logout"); ?>">Salir</a></li>
              </ul>
            </div>
            <?php } ?>
          </nav>
        </div>
        &nbsp;
      </div>

