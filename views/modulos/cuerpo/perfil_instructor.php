<div id="main">
	<div class="container">
		<h2><center>Perfil Instructor</h2>	
		<div class="row">
			<div class="col-md-4">
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col" colspan="2"><center>Datos</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">Nombre</th>
			      <td>
			      	<?php
			      		echo $_SESSION["n"]." ". $_SESSION["a"];
			      	?>
			      </td>
			    </tr>
			    <tr>
			      <th scope="row">Documento</th>
			      <td>
			      	<?php  echo $_SESSION["documento"]; ?>
			      </td>
			    </tr>
			    <tr>
			      <th scope="row">Tipo de Documento</th>
			      <td>
			      	<?php  
			      	if($_SESSION["tidocumento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($_SESSION["tidocumento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($_SESSION["tidocumento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($_SESSION["tidocumento"]=="4"){
			      		echo "Pasaporte";
			      	}

			      	?>
			      </td>
			    </tr>
			    <tr>
			      <th scope="row">Correo</th>
			      <td>
			      	<?php  echo $_SESSION["c"]; ?>
			      </td>
			    </tr>
				<tr>
			      <th scope="row">Rol</th>
			      <td>
					<?php echo $_SESSION["r"]; ?>			      	
			      </td>
			    </tr>
			  </tbody>
			</table>	
			</div>
			<div class="col-md-8">
				<nav class="navbar navbar-expand-sm bg-light navbar-secondary" align="center">
				  <ul class="navbar-nav">
				    <li class="nav-item active">
				      <a class="nav-link" href="index.php?action=cambio_contra">Cambiar Contraseña</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="index.php?action=consulta_aprendizi">Consultar Aprendiz</a>
				    </li>				    
				  </ul>
				</nav>
				<center>En esta pagina podras cambiar tus datos personales o actualizar los datos de los aprendices que esten registrados en el sistema

			</div>
		</div>

	</div>
</div>
	