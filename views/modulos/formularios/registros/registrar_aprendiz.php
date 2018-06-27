<!--<script type="text/javascript">
  valor = document.getElementById("campo").value;
if( !(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test(valor)) ) {
  return false;
}
</script>-->
<div id="main">
    <div class="container">
    	<br>
      <?php

          $registro = new MvcController();
          $registro -> registroAprendizController();
          if(isset($_GET["action"])){

            if ($_GET["action"]=="ok") {
                echo"registro exitoso";
            }
          }
          ?>
         <h3 class="">Regístrar Aprendiz</h3>
        	<br>

        	<form method="post">
        		<div class="form-group">
	      			<label for="usr">Primer Nombre</label>
	      			<input type="text" class="form-control" name="pn" autocomplete="off" required>
	      			<label for="usr">Segundo Nombre</label>
	      			<input type="text" class="form-control" name="sn" autocomplete="off">
	      			<label for="usr">Primer Apellido</label>
	      			<input type="text" class="form-control" name="pa" autocomplete="off" required>
	      			<label for="usr">Segundo Apellido</label>
	      			<input type="text" class="form-control" name="sa" autocomplete="off">
	      			<label for="usr">N&uacute;mero de documento</label>
	      			<input type="text" class="form-control" name="nd" autocomplete="off" required>
	      			<label>Tipo de Documento</label>
      				<select class="form-control" name="tidoc">
                <option disabled="">--Seleccione opcion--</option>
        				<option value="1">Cédula de Ciudadania</option>
        				<option value="2">Tarjeta de Identidad</option>
        				<option value="3">Cédula de Extranjeria</option>
        				<option value="4">Pasaporte</option>
      				</select>
              <label for="usr">Direccion</label>
              <input type="text" class="form-control" name="dir" autocomplete="off" required>
      				<label for="usr">Correo</label>
      				<input type="email" class="form-control" name="correo" autocomplete="off" required  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" placeholder="ejemplo@mail.com" >
      				<label for="usr">Teléfono</label>
              <input type="text" class="form-control" name="tel" autocomplete="off" required>
              <label for="usr">Ficha</label>
              <input type="text" class="form-control" name="ficha" autocomplete="off" required>
              <label>Sede</label>
              <select class="form-control" name="sede">
                <option disabled="">--Seleccione opcion--</option>
                <option value="Colombia">Colombia</option>
                <option value="Complejo Sur">Complejo Sur</option>
                <option value="Ricaurte">Ricaurte</option>
                <option value="Álamos">Álamos</option>
                <option value="Restrepo">Restrepo</option>
              </select>
              <label>Modalidad</label>
              <select class="form-control" name="modal">
                <option disabled="">--Seleccione opcion--</option>
                <option value="Presencial">Presencial</option>
                <option value="Complementaria">Complementaria</option>
              </select>
              <label>Jornada</label>
              <select class="form-control" name="jornada">
                <option disabled="">--Seleccione opcion--</option>
                <option value="Diurna">Diurna</option>
                <option value="Nocturna">Nocturna</option>
                <option value="Mixta">Mixta</option>
                <option value="Madrugada">Madrugada</option>
                <option value="Fines de Semana">Fines de Semana</option>
              </select>
              <label>Tipo de Formacion Titulada (Si es virtual seleccione ninguna)</label>
              <select class="form-control" name="tipo_form">
                <option disabled="">--Seleccione opcion--</option>
                <option value="Ninguna">Ninguna</option>
                <option value="Técnico Profesional">Técnico Profesional</option>
                <option value="Tecnólogo">Tecnólogo</option>
              </select>
     			 	<!-- <label for="usr">Confirme Contraseña</label>
     			 	<input type="password" class="form-control" name="contra1"autocomplete="off" required> -->
	   			</div>
	   			<center> <button type="submit" class="btn btn-info">Registrar</button>
	   			</center>
        	</form> 

        <br><br>                           
    </div>  
</div>
<br><br>
