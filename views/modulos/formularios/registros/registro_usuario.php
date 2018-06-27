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
$registro -> registroUsuarioController();
if(isset($_GET["action"])){

  if ($_GET["action"]=="ok") {
      echo"registro exitoso";
  }
}
?>
    	<br>
        <h3 class="">Regístrate</h3>
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
        				<option value="1">Cédula de Ciudadania</option>
        				<option value="2">Tarjeta de Identidad</option>
        				<option value="3">Cédula de Extranjeria</option>
        				<option value="4">Pasaporte</option>
      				</select>
      				<label for="usr">Correo</label>
      				<input type="email" class="form-control" name="correo" autocomplete="off" required  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" placeholder="ejemplo@mail.com" >
      				<label for="usr">Contrase&ntilde;a</label>
     			 	<input type="password" class="form-control" name="contra"autocomplete="off" required>
     			 	<label for="usr">Confirme Contraseña</label>
     			 	<input type="password" class="form-control" name="contra1"autocomplete="off" required> 
	   			</div>
	   			<center> <button type="submit" class="btn btn-info">Registrar</button>
	   			</center>
        	</form>                             
        <br><br>                           
    </div>  
</div>
<br><br>
