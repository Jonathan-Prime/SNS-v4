<div id="main">
	<div class="container">
		<br>
    <?php

      $registro = new MvcController();
      $registro -> cambioContrasenaController();
      if(isset($_GET["action"])){

        if ($_GET["action"]=="ok") {
            echo"registro exitoso";
        }
      } 

   ?>
    <br>
		<h2>Cambio de contrase&ntilde;a</h2>
		<form method="post">
        		<div class="form-group">
	      			<label for="usr">Digite su actual contrase&ntilde;a</label>
              <input type="password" class="form-control" name="contrav" autocomplete="off" required>
              <label for="usr">Digite su nueva contrase&ntilde;a</label>
              <input type="password" class="form-control" name="contran" autocomplete="off" required>
              <label for="usr">Vuelva a digitar su nueva contrase&ntilde;a</label>
              <input type="password" class="form-control" name="contran1" autocomplete="off" required>
              <input type="hidden" name="nd" value=<?php echo $_SESSION["documento"] ?> >
              <input type="hidden" name="tidoc" value=<?php echo $_SESSION["tidocumento"] ?>>
              <center> <br><button type="submit" class="btn btn-info">Verificar</button>
              </center>
           
        	</form>                             
        <br><br>

		 </div>
	</div>
</div>