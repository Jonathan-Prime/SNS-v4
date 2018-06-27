
<div id="main">
	<div class="container">
		<br>
		<h2>Consulta de aprendices</h2>
		<br>
		<?php
	    $registro = new MvcController();
      	
      	$registro -> borraraprendizController();
       
		?>
		<br>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		
		  <form class="form-inline ml-auto" method="post">
		    <input class="form-control mr-sm-2" type="text" placeholder="Numero de documento" name="nd">
              <select class="form-control" name="tidoc">
              	<option disabled=>Tipo de documento</option>
                <option value="1">Cédula de Ciudadania</option>
                <option value="2">Tarjeta de Identidad</option>
                <option value="3">Cédula de Extranjeria</option>
                <option value="4">Pasaporte</option>
              </select>
		    <button class="btn btn-success" type="submit">buscar</button>
		  </form>		  
		</nav>
			<?php
		
        if(isset($_POST["nd"])&&isset($_POST["tidoc"])){

        	$registro = new MvcController();
      		$registro -> vistaUnAprendizController();
        }
		?>
		<h2>listado de aprendices</h2>
		<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>nombre</th>
			<th>documento</th>
			<th>tipo documento</th>
			<th>direccion</th>
			<th>correo</th>
			<th>telefono</th>
			<th>ficha</th>
			<th>sede</th>
			<th>modalidad</th>
			<th>jornada</th>
			<th>tipo formacion</th>
			<th>Modificar</th>
			<th>Eliminar</th>
			</tr>
		</thead>

		<tbody>
			<?php
	    $registro = new MvcController();
      	$registro -> vistaAprendizController();
        if(isset($_GET["action"])){

        if ($_GET["action"]=="ok") {
            echo"registro exitoso";
         }
        }
		?>
		</tbody>
		</table>	
		<br>	
		<br>	
		</div>
</div>

