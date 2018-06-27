<div id="main">
	<div class="container">
		<br>
    <?php

      $registro = new MvcController();
      $registro -> CambioRolController();
      if(isset($_GET["action"])){

        if ($_GET["action"]=="ok") {
            echo"registro exitoso";
        }
      } 
    ?>
    <br>
		<h2>Cambio Rol</h2>
		<form method="post">
        		<div class="form-group">
	      			<label for="usr">N&uacute;mero de documento</label>
              <input type="text" class="form-control" name="nd" autocomplete="off" required>
              <label>Tipo de Documento</label>
              <select class="form-control" name="tidoc">
                <option value="1">Cédula de Ciudadania</option>
                <option value="2">Tarjeta de Identidad</option>
                <option value="3">Cédula de Extranjeria</option>
                <option value="4">Pasaporte</option>
              </select>
	      		<label for="usr" >Seleccione Rol</label>
	      		<select class="form-control" name="rol">
                <option value="instructor">instructor</option>
                <option value="administrador">administrador</option>
                <option value="apoyoadministrador">apoyoadministrador</option>
                </select>
     			 	
	   			</div>
	   			<center> <button type="submit" class="btn btn-info">Registrar novedad</button>
	   			</center>
        	</form>                             
        <br><br>

		
	</div>
</div>