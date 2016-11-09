      <div class="row">
        <div class="col-md-12">
            <?php if(isset($error) && $error[0] = true) { ?>
          <div class="page-header">
            <h1>Error: <small><?php echo $error['titulo']; ?></small></h1>
          </div>
          <div class="row">
            <div class="col-md-12">
                <p class="text-danger">
                    <?php if(isset($error)){
                        $i = 0;
                        foreach ($error as $e){
                            if($i > 0) echo $e . "<br>";
                            $i++;
                        }
                    }
                    ?>
                </p>
            </div>
          </div>
            <?php } ?>
        </div>
      </div>