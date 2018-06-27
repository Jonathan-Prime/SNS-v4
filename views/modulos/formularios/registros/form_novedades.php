<div id="main">
    <div class="container">
      <br>
      <?php

      $registro = new MvcController();
      $registro -> registroNovedadController();
      if(isset($_GET["action"])){

        if ($_GET["action"]=="ok") {
            echo"registro exitoso";
        }
      } 
    ?>
    	<br>
        <h3 class="">Ingresar novedad</h3>
        	<br>
        	<form method="post">
            <label>Seleccione novedad</label>
              <select class="form-control" name="novedad" id="select">
                <option disabled="">--Seleccione opcion--</option>
                <option value="aplazamientos">Aplazamiento</option>
                <option value="cambio_de_jornada">Cambio de jornada</option>
                <option value="deserciones">Desercion</option>
                <option value="reintegro">Reintegro</option>
                <option value="retiro_voluntario">Retiro voluntario</option>
                <option value="traslado">Traslado</option>
              </select>

              <div id="pai">
                        <div id="deserciones">
                            <label for="usr">Fallas</label>
                            <input type="number" class="form-control" name="fallas" autocomplete="off">
                        </div>

                        <div id="cambio_de_jornada">
                            <label for="usr">nueva jornada</label>
                            <select class="form-control" name="jornada">
                            <option value="Diurna">Diurna</option>
                            <option value="Nocturna">Nocturna</option>
                            <option value="Madrugada">Madrugada</option>
                          </select>
                        </div>

                        <div id="reintegro">
                            <label for="usr">sede reintegro</label>
                            <select class="form-control" name="sede_reintegro" id="sede_reintegro">
                            <option disabled="">--Seleccione opcion--</option>
                            <option value="complejo">complejo sur</option>
                            <option value="Ricaurte">Ricaurte</option>
                            <option value="Álamos">Álamos</option>
                            <option value="Restrepo">Restrepo</option>
                            <option value="Colombia">Colombia</option>
                
                        </select>
                        </div>

                        <div id="traslado">
                            <label for="usr">sede traslado</label>
                            <select class="form-control" name="sede_traslado" id="sede_traslado">
                            <option disabled="">--Seleccione opcion--</option>
                            <option value="complejo">complejo sur</option>
                            <option value="Ricaurte">Ricaurte</option>
                            <option value="Álamos">Álamos</option>
                            <option value="Restrepo">Restrepo</option>
                            <option value="Colombia">Colombia</option>
                
                      </select>
                        </div>


                  </div>

            
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


                  



	      			<label for="usr">Fecha</label>
	      			<input type="date" class="form-control" name="fecha" autocomplete="off">
	      			<label for="usr">Motivo</label>
	      			<textarea class="form-control" name="motivo" autocomplete="off" required>
                </textarea>
	      			<label for="usr" >Respuesta</label>
	      			<select class="form-control" name="respuesta">
                 <option value="Aceptada">1. Aceptada</option>
                 <option value="Rechazada">2. Rechazada</option>
               </select>
     			 	
	   			</div>
	   			<center> <button type="submit" class="btn btn-info">Registrar novedad</button>
	   			</center>
        	</form>                             
        <br><br>                           
    </div>  
</div>
<br><br>
