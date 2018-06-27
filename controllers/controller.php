<?php
	class MvcController{
		
		public function plantilla(){
			include('views/plantilla.php');
		}
		public function enlacesPaginasController(){
			if (isset($_GET["action"])){
	
				$enlaces=$_GET["action"];
			
			}else{

				$enlaces="index";

			}
			$respuesta= EnlacesPaginas::enlacesPaginasModel($enlaces);	
			echo'<br><br><br>';
			include $respuesta;
		}

		//login
		//****************************************

		public function ingresoUsuarioController(){

			if(isset($_POST["ndl"])){
				$datosController = array( 'nd' =>$_POST["ndl"],
										  'tidoc'=>$_POST["tidocl"],
										  'contra' =>$_POST["contral"]);
				$respuesta = Datos :: ingresoUsuarioModel($datosController,"registro");
				if($respuesta["documento"]==$_POST["ndl"] && $respuesta["tipo_documento"]==$_POST["tidocl"] && $respuesta["contrasena"]==$_POST["contral"]){
					$_SESSION["n"]=$respuesta["primer_nombre"];
					$_SESSION["a"]=$respuesta["primer_apellido"];
					$_SESSION["c"]=$respuesta["correo"];
					$_SESSION["r"]=$respuesta["rol"];
					$_SESSION["documento"]=$respuesta["documento"];
					$_SESSION["tidocumento"]=$respuesta["tipo_documento"];
					//echo $_SESSION["r"];
					header("location:index.php?action=perfil");

				}//if

				else{
					echo '<div class="alert alert-danger alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Atención!</strong> No se pudo ingresar.
				  	</div>';

				}

			}//if

		}//login

		//registro
		//******************************************
		public function registroUsuarioController(){

			if(isset($_POST["pn"])){
				if ($_POST["contra"]==$_POST["contra1"]) {
					$datosController = array( 'pn' =>$_POST["pn"],
							'sn'=>$_POST["sn"],
							'pa' =>$_POST["pa"],
							'sa'=>$_POST["sa"],
							'nd'=>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'correo'=>$_POST["correo"],
							'contra'=>$_POST["contra"],
							'rol'=>"instructor");
				$respuesta = Datos :: registroUsuarioModel($datosController,"registro");

				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}//else
				}
				else{
					echo '<div class="alert alert-danger alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Atención!</strong> Las contraseñas no coinciden
				  	</div>';
				}
				/**/
			}//if
			
		}//registroUsuarioController

		public function navController(){
			session_start();
			if(isset($_SESSION["documento"])){
				$datosController = array( 'nd' =>$_SESSION["documento"],
										  'tidoc'=>$_SESSION["tidocumento"]);

			$respuesta = Datos :: navModel($datosController,"registro");
			if ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="instructor") {
				include("./views/modulos/cuerpo/nav2.php");
				//echo "instructor";
			}//if
			elseif ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="administrador") {
				include("./views/modulos/cuerpo/nav3.php");
				//echo "administrador";
			}
			elseif ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="apoyoadministrador") {
				include("./views/modulos/cuerpo/nav3.php");
				//echo "apoyoadministrador";
			}
			elseif ($_SESSION["documento"]=="" && $_SESSION["tidocumento"]=="" ) {
				include("./views/modulos/cuerpo/nav1.php");
				//echo "apoyoadministrador";
			}
			}//if
			else{
				include("./views/modulos/cuerpo/nav1.php");
			}
			
		}//navController

		public function perfilController(){
			if(isset($_SESSION["documento"])){
				$datosController = array( 'nd' =>$_SESSION["documento"],
										  'tidoc'=>$_SESSION["tidocumento"]);

			$respuesta = Datos :: perfilModel($datosController,"registro");
			if ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="instructor") {
				include("./views/modulos/cuerpo/perfil_instructor.php");
				
			}//if
			elseif ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="administrador") {
				include("./views/modulos/cuerpo/perfil_admin.php");
				
			}//elseif
			elseif ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="apoyoadministrador") {
				include("./views/modulos/cuerpo/perfil_apoyo_admin.php");
				
			}//elseif
			
			}//if
			else{
				include("./views/modulos/cuerpo/nav1.php");
			}
		}//perfilController

		public function registroNovedadController(){

			if(isset($_POST["nd"])){
				$consulta = array('nd' =>  $_POST["nd"],
								  'tidoc' 	=>  $_POST["tidoc"]); 
				$a= Datos :: aprendizModel($consulta,"registroaprendiz");

				if ($a["Documento"]==$_POST["nd"] && $a["TipoDocumento"]==$_POST["tidoc"]) {
					if($_POST["novedad"] == "deserciones"){
					//echo "desercion";
					$tabla =$_POST["novedad"];
					$campos ="documento_aprendiz, tipo_documento, fecha_desercion, fallas, motivo, respuestas";
					$valores=":nd,:tidoc,:fecha,:fallas,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'fecha'=>$_POST["fecha"],
							'fallas'=>$_POST["fallas"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>"respuesta");
				$respuesta = Datos :: registroDesercionModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}
				}//deseiciones
				//****************************************************************
				elseif($_POST["novedad"] == "cambio_de_jornada"){
					echo "cambio_de_jornada";

					$tabla =$_POST["novedad"];
					$campos ="documento_aprendiz, tipo_documento, jornada, fecha_cambio_jornada, motivo, respuestas";
					$valores=":nd,:tidoc,:jornada,:fecha,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'jornada'=>$_POST["jornada"],
							'fecha'=>$_POST["fecha"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>"respuesta");
				$respuesta = Datos :: registroCambioDeJornadaModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}	

					}//CAMBIO_jornada
				elseif($_POST["novedad"] == "reintegro"){
					echo "reintegro";

						$tabla =$_POST["novedad"];
					
					$campos ="documento_aprendiz, tipo_documento, fecha_reintegro, sede_reintegro, motivo, respuesta";
					
					$valores=":nd,:tidoc,:fecha,:sede_reintegro,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'fecha'=>$_POST["fecha"],
							'sede_reintegro'=>$_POST["sede_reintegro"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>$_POST["respuesta"]);
				$respuesta = Datos :: registroReintegroModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}

				}//reintegro
				elseif($_POST["novedad"] == "traslado"){
					echo "traslado";
					$tabla =$_POST["novedad"];
					
					$campos ="documento_aprendiz, tipo_documento, sede_traslado, fecha_traslado, motivo, respuesta";
					
					$valores=":nd,:tidoc,:sede_traslado,:fecha,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'sede_traslado'=>$_POST["sede_traslado"],
							'fecha'=>$_POST["fecha"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>$_POST["respuesta"]);
				$respuesta = Datos :: registroTrasladoModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}

				}//traslado
				else{
					//echo "la novedad que ha escogido tiene 5 opciones";
					$tabla =$_POST["novedad"];
					
					$campos ="documento_aprendiz, tipo_documento, fecha, motivo, respuesta";
					
					$valores=":nd,:tidoc,:fecha,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'fecha'=>$_POST["fecha"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>$_POST["respuesta"]);
				$respuesta = Datos :: registroNovedadModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}

			}//if
				}
				else{
					echo '<div class="alert alert-danger alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Atención!</strong> El aprendiz no esta registrado. Antes de registrar una novedad el aprendiz debe estar registrado
				  	</div>';
				}
			}
		}//registroNovedadController
		/**/
		public function CambioRolController(){
				if(isset($_POST["nd"])){
				$datosController = array( 'nd' =>$_POST["nd"],
										  'tidoc'=>$_POST["tidoc"],
										   'rol' =>$_POST["rol"]);

			$respuesta = Datos :: CambioRolModel($datosController,"registro");
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> se ha realizado el cambio de rol con exito.
				  	</div>';

				}else{
					echo $respuesta;
				

			}//if
			}
		}//CambioRolController

		public function consultaNovedadController(){
			
			if(isset($_POST["nd"])){
				
				$datosController = array( 'nd' =>$_POST["nd"],
										  'tidoc'=>$_POST["tidoc"],
										  );
				$tabla =$_POST["novedad"];
				$respuesta = Datos :: consultaNovedadModel($datosController,$tabla);
				$a = new MvcController();
				$a->tabla($respuesta,$tabla);
				
			}//if

		}//consultaNovedadController

		public function consultaNovedadiController(){
			
			if(isset($_POST["nd"])){
				
				$datosController = array( 'nd' =>$_POST["nd"],
										  'tidoc'=>$_POST["tidoc"],
										  );
				$tabla =$_POST["novedad"];
				$respuesta = Datos :: consultaNovedadModel($datosController,$tabla);
				$a = new MvcController();
				$a->tablai($respuesta,$tabla);
				
			}//if

		}//consultaNovedadController

		public function vistaAprendizController(){
			$respuesta=Datos :: vistaAprendizModel("registroaprendiz");
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["PrimerNombre"]." ".$key["SegundoNombre"]." ".$key["PrimerApellido"]." ".$key["SegundoApellido"].'</td>
			<td>'.$key["Documento"].'</td>
			<td>';
				if($key["TipoDocumento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["TipoDocumento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["TipoDocumento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["TipoDocumento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["TipoDocumento"] ;
			      	}
			echo '</td>
			<td>'.$key["Direccion"].'</td>
			<td>'.$key["Correo"].'</td>
			<td>'.$key["Telefono"].'</td>
			<td>'.$key["Ficha"].'</td>
			<td>'.$key["Sede"].'</td>
			<td>'.$key["Modalidad"].'</td>
			<td>'.$key["Jornada"].'</td>
			<td>'.$key["TipoFormacion"].'</td>
			<td><a href="index.php?action=editar&id='.$key["Documento"].'"><button class="btn"><img src="./views/i/editar.png" width="20"/></button></a></td>
			<td><a href="index.php?action=consulta_aprendiz&idBorrar='.$key["Documento"].'"><a href="index.php?action=consulta_aprendiz&idBorrar='.$key["Documento"].'"><button class="btn"><img src="./views/i/elimi.png" width="20"/></button></a></td>
			</tr>';	
			}//foreach
			
		}//vistaAprendizController
		public function vistaAprendiziController(){
			$respuesta=Datos :: vistaAprendizModel("registroaprendiz");
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["PrimerNombre"]." ".$key["SegundoNombre"]." ".$key["PrimerApellido"]." ".$key["SegundoApellido"].'</td>
			<td>'.$key["Documento"].'</td>
			<td>';
				if($key["TipoDocumento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["TipoDocumento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["TipoDocumento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["TipoDocumento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["TipoDocumento"] ;
			      	}
			echo'</td>
			<td>'.$key["Direccion"].'</td>
			<td>'.$key["Correo"].'</td>
			<td>'.$key["Telefono"].'</td>
			<td>'.$key["Ficha"].'</td>
			<td>'.$key["Sede"].'</td>
			<td>'.$key["Modalidad"].'</td>
			<td>'.$key["Jornada"].'</td>
			<td>'.$key["TipoFormacion"].'</td>
			
			</tr>';	
			}//foreach
			
		}//vistaAprendizController
		public function registroAprendizController(){

			if(isset($_POST["pn"])){
				$datosController = array( 'pn' =>$_POST["pn"],
							'sn'=>$_POST["sn"],
							'pa' =>$_POST["pa"],
							'sa'=>$_POST["sa"],
							'nd'=>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'dir'=>$_POST["dir"],
							'correo'=>$_POST["correo"],
							'tel'=>$_POST["tel"],
							'ficha'=>$_POST["ficha"],
							'sede'=>$_POST["sede"],
							'modal'=>$_POST["modal"],
							'jornada'=>$_POST["jornada"],
							'tipo_form'=>$_POST["tipo_form"]
						);
				$respuesta = Datos :: registroAprendizModel($datosController,"registroaprendiz");

				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}
			}//if
			
		}//registroaprendizcontroller

		public function cambioContrasenaController(){
			if(isset($_POST["nd"])){
				if($_POST["contran"]==$_POST["contran1"]){
					$datosController = $arrayName = array('nd' =>$_POST["nd"],
														 'contra'=> $_POST["contrav"],
														 'contran'=> $_POST["contran"]);
					$respuesta= Datos :: consultaContraseñaModel($datosController,"registro");	
					
					if ($respuesta["contrasena"]==$datosController["contra"]){
						//actualizacion contraseña 
						
						$respuestas= Datos :: contraseñaModel($datosController,"registro");
						if($respuestas="success"){
							echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> Se ha realizado el cambio exitosamente
				  	</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Atención!</strong>no se logro cambiar la contraseña
				  	</div>';
						}

						}//if
					else{
						echo'<div class="alert alert-danger alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Atención!</strong> La contraseña no existe en la base de dase
				  	</div>';
					}
				}//if
				else{
					echo '<div class="alert alert-danger alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Atención!</strong> Las contraseñas no coinciden
				  	</div>';
				}
			}//if
		}//cambioContrasenaController

		public function vistaUnAprendiziController(){
			$datosController = array( 'nd' =>$_POST["nd"],
										  'tidoc'=>$_POST["tidoc"],
										  );
			$respuesta=Datos :: vistaUnAprendizModel($datosController,"registroaprendiz");

			//tabla*********************
			echo '<table class="table table-striped table-responsive ">
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
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["PrimerNombre"]." ".$key["SegundoNombre"]." ".$key["PrimerApellido"]." ".$key["SegundoApellido"].'</td>
			<td>'.$key["Documento"].'</td>
			<td>';
			if($key["TipoDocumento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["TipoDocumento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["TipoDocumento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["TipoDocumento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["TipoDocumento"] ;
			      	}
			echo '</td>
			<td>'.$key["Direccion"].'</td>
			<td>'.$key["Correo"].'</td>
			<td>'.$key["Telefono"].'</td>
			<td>'.$key["Ficha"].'</td>
			<td>'.$key["Sede"].'</td>
			<td>'.$key["Modalidad"].'</td>
			<td>'.$key["Jornada"].'</td>
			<td>'.$key["TipoFormacion"].'</td>
			
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
		}//vistaUnAprendiziController

		public function vistaUnAprendizController(){
			$datosController = array( 'nd' =>$_POST["nd"],
										  'tidoc'=>$_POST["tidoc"],
										  );
			$respuesta=Datos :: vistaUnAprendizModel($datosController,"registroaprendiz");

			//tabla*********************
			echo '<table class="table table-striped table-responsive ">
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

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["PrimerNombre"]." ".$key["SegundoNombre"]." ".$key["PrimerApellido"]." ".$key["SegundoApellido"].'</td>
			<td>'.$key["Documento"].'</td>
			<td>';
			if($key["TipoDocumento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["TipoDocumento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["TipoDocumento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["TipoDocumento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["TipoDocumento"] ;
			      	}
			echo '</td>
			<td>'.$key["Direccion"].'</td>
			<td>'.$key["Correo"].'</td>
			<td>'.$key["Telefono"].'</td>
			<td>'.$key["Ficha"].'</td>
			<td>'.$key["Sede"].'</td>
			<td>'.$key["Modalidad"].'</td>
			<td>'.$key["Jornada"].'</td>
			<td>'.$key["TipoFormacion"].'</td>
			
			<td><button class="btn"><img src="./views/i/editar.png" width="20"/></button></td>
			<td><a href="index.php?action=consulta_aprendiz&idBorrar='.$key["Documento"].'"><button class="btn"><img src="./views/i/elimi.png" width="20"/></button></a></td>
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
		}//vistaUnAprendizController
		/*
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		******************************************************************
		*/
		public function tabla($respuesta,$tabla){
			//var_dump($respuesta);
			echo "<br>"."<h2>".$tabla."</h2>";
			if ($tabla=="aplazamientos") {
				//tabla aplazamiento
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			<th>fecha solicitud</th>
			<th>motivo</th>
			<th>respuesta</th>
			<th>Modificar</th>
			<th>Eliminar</th>
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			<td>'.$key["fecha"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuesta"].'</td>
			<td><a href="index.php?action&id='.$key["documento_aprendiz"].'"><button class="btn"><img src="./views/i/editar.png" width="20"/></button></a></td>
			<td><a href="index.php?action=consultar_novedad&idBorrar='.$key["documento_aprendiz"].'&col='.$tabla.'"><button class="btn"><img src="./views/i/elimi.png" width="20"/></button></a></td>
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla aplazamiento
			}

			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="cambio_de_jornada"){
				//tabla cambio_de_jornada
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			<th>jornada de cambio</th>
			<th>fecha solicitud</th>
			<th>motivo</th>
			<th>respuesta</th>
			<th>Modificar</th>
			<th>Eliminar</th>
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			<td>'.$key["jornada"].'</td>
			<td>'.$key["fecha_cambio_jornada"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuestas"].'</td>
			<td><button class="btn"><img src="./views/i/editar.png" width="20"/></button></td>
			<td><a href="index.php?action=consultar_novedad&idBorrar='.$key["documento_aprendiz"].'&col='.$tabla.'"><button class="btn"><img src="./views/i/elimi.png" width="20"/></button></a></td>
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla cambio_de_jornada
			}
			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="deserciones"){
				//tabla 
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			
			<th>fecha solicitud</th>
			<th>fallas</th>
			<th>motivo</th>
			<th>respuesta</th>
			<th>Modificar</th>
			<th>Eliminar</th>
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			
			<td>'.$key["fecha_desercion"].'</td>
			<td>'.$key["fallas"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuestas"].'</td>
			<td><button class="btn"><img src="./views/i/editar.png" width="20"/></button></td>
			<td><a href="index.php?action=consultar_novedad&idBorrar='.$key["documento_aprendiz"].'&col='.$tabla.'"><button class="btn"><img src="./views/i/elimi.png" width="20"/></button></a></td>
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla 
			}
			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="reintegro"){
				//tabla deserciones
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			
			<th>fecha solicitud</th>
			<th>Sede reintegro</th>
			<th>motivo</th>
			<th>respuesta</th>
			<th>Modificar</th>
			<th>Eliminar</th>
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			
			<td>'.$key["fecha_reintegro"].'</td>
			<td>'.$key["sede_reintegro"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuesta"].'</td>
			<td><button class="btn"><img src="./views/i/editar.png" width="20"/></button></td>
			<td><a href="index.php?action=consultar_novedad&idBorrar='.$key["documento_aprendiz"].'&col='.$tabla.'"><button class="btn"><img src="./views/i/elimi.png" width="20"/></button></a></td>
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla deserciones
			}
			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="retiro_voluntario"){
				//tabla retiro_voluntario
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			<th>fecha solicitud</th>
			<th>motivo</th>
			<th>respuesta</th>
			<th>Modificar</th>
			<th>Eliminar</th>
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			<td>'.$key["fecha"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuesta"].'</td>
			<td><button class="btn"><img src="./views/i/editar.png" width="20"/></button></td>
			<td><a href="index.php?action=consultar_novedad&idBorrar='.$key["documento_aprendiz"].'&col='.$tabla.'"><button class="btn"><img src="./views/i/elimi.png" width="20"/></button></a></td>
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla retiro_voluntario
			}
			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="traslado"){
				//tabla traslado
			echo '<table class="table table-striped table-responsive ">
				<thead class="thead-dark">
					<tr>
					<th>documento</th>
					<th>tipo documento</th>
					<th>Sede traslado</th>
					<th>fecha solicitud</th>
					
					<th>motivo</th>
					<th>respuesta</th>
					<th>Modificar</th>
					<th>Eliminar</th>
					</tr>
				</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			<td>'.$key["sede_traslado"].'</td>
			<td>'.$key["fecha_traslado"].'</td>
			
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuesta"].'</td>
			<td><button class="btn"><img src="./views/i/editar.png" width="20"/></button></td>
			<td><a href="index.php?action=consultar_novedad&idBorrar='.$key["documento_aprendiz"].'&col='.$tabla.'"><button class="btn"><img src="./views/i/elimi.png" width="20"/></button></a></td>
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla traslado
			}

		}//metodotabla

		public function tablai($respuesta,$tabla){
			//var_dump($respuesta);
			echo "<br>"."<h2>".$tabla."</h2>";
			if ($tabla=="aplazamientos") {
				//tabla aplazamiento
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			<th>fecha solicitud</th>
			<th>motivo</th>
			<th>respuesta</th>
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			<td>'.$key["fecha"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuesta"].'</td>
			
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla aplazamiento
			}

			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="cambio_de_jornada"){
				//tabla cambio_de_jornada
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			<th>jornada de cambio</th>
			<th>fecha solicitud</th>
			<th>motivo</th>
			<th>respuesta</th>
			
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			<td>'.$key["jornada"].'</td>
			<td>'.$key["fecha_cambio_jornada"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuestas"].'</td>
			
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla cambio_de_jornada
			}
			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="deserciones"){
				//tabla 
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			
			<th>fecha solicitud</th>
			<th>fallas</th>
			<th>motivo</th>
			<th>respuesta</th>
			
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			
			<td>'.$key["fecha_desercion"].'</td>
			<td>'.$key["fallas"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuestas"].'</td>
			
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla 
			}
			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="reintegro"){
				//tabla deserciones
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			
			<th>fecha solicitud</th>
			<th>Sede reintegro</th>
			<th>motivo</th>
			<th>respuesta</th>
			
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			
			<td>'.$key["fecha_reintegro"].'</td>
			<td>'.$key["sede_reintegro"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuesta"].'</td>
			
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla deserciones
			}
			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="retiro_voluntario"){
				//tabla retiro_voluntario
					echo '<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>documento</th>
			<th>tipo documento</th>
			<th>fecha solicitud</th>
			<th>motivo</th>
			<th>respuesta</th>
			
			</tr>
		</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			<td>'.$key["fecha"].'</td>
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuesta"].'</td>
			
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla retiro_voluntario
			}
			/*
			*******************
			*******************
			*******************
			*/
			elseif($tabla=="traslado"){
				//tabla traslado
			echo '<table class="table table-striped table-responsive ">
				<thead class="thead-dark">
					<tr>
					<th>documento</th>
					<th>tipo documento</th>
					<th>Sede traslado</th>
					<th>fecha solicitud</th>
					
					<th>motivo</th>
					<th>respuesta</th>
					
					</tr>
				</thead>

		<tbody>';
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["documento_aprendiz"].'</td>
			<td>';
			if($key["tipo_documento"]=="1"){
			      		echo "Cédula de ciudadania";
			      	}else if($key["tipo_documento"]=="2"){
			      		echo "tarjeta de identidad";
			      	}
			      	else if($key["tipo_documento"]=="3"){
			      		echo "Cédula extranjera";
			      	}
			      	else if($key["tipo_documento"]=="4"){
			      		echo "Pasaporte";
			      	}
			      	else{
			      		echo $key["tipo_documento"] ;
			      	}
			echo '</td>
			<td>'.$key["sede_traslado"].'</td>
			<td>'.$key["fecha_traslado"].'</td>
			
			<td>'.$key["motivo"].'</td>
			<td>'.$key["respuesta"].'</td>
			
			</tr>';	
			}//foreach
			echo '</tbody>
		</table>
		<br><br><br><br>';
				//tabla traslado
			}

		}//metodotabla

		public function borraraprendizController(){
			if(isset($_GET["idBorrar"])){
				$datosController=$_GET["idBorrar"];
				$respuesta = Datos::borraraprendizModel($datosController,"registroaprendiz");
				if ($respuesta=="success") {
					//header('location:index.php?action=consulta_aprendiz');
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> Se ha realizado la eliminacion exitosamente
				  	</div>';
				}
			}

		}//borrarNovedadController

		public function borrarNovedadController(){
			if(isset($_GET["idBorrar"])){
				$tabla=$_GET["col"];
				$datosController=$_GET["idBorrar"];
				$respuesta = Datos::borraraprendizModel($datosController,$tabla);
				if ($respuesta=="success") {
					//header('location:index.php?action=consulta_aprendiz');
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> Se ha realizado la eliminacion exitosamente
				  	</div>';
				}
			}

		}//borrarNovedadController
public function editarAprendizController(){
$datosController = $_GET["id"];
$respuesta = Datos::editarAprendizModel($datosController,"registroaprendiz");
			echo '<input type="hidden" class="form-control" name="ideditar" value="'.$respuesta["Documento"].'">';
            echo '<label for="usr">Primer nombre</label> <input type="text" class="form-control" name="pneditar" value='.$respuesta["PrimerNombre"].' required>';
            echo '<label for="usr">Segundo nombre</label> <input type="text" class="form-control" name="sneditar" value='.$respuesta["SegundoNombre"].'>';
            echo '<label for="usr">Primer apellido</label> <input type="text" class="form-control" name="paeditar" value='.$respuesta["PrimerApellido"].' required>';
            echo '<label for="usr">Segundo apellido</label> <input type="text" class="form-control" name="saeditar" value='.$respuesta["SegundoApellido"].'>';
            echo '<label for="usr">N&uacute;mero de documento</label> <input type="text" class="form-control" name="ndeditar" value='.$respuesta["Documento"].' required>';
            echo '<label>Tipo de Documento</label>
              <select class="form-control" name="tidoceditar">
                <option >'.$respuesta["TipoDocumento"].'</option>
                <option value="1">Cédula de Ciudadania</option>
                <option value="2">Tarjeta de Identidad</option>
                <option value="3">Cédula de Extranjeria</option>
                <option value="4">Pasaporte</option>
              </select>';
              echo '<label for="usr">Direcci&oacute;n</label>
              <input type="text" class="form-control" name="direditar" autocomplete="off" value='.$respuesta["Direccion"].' required>';
              echo '<label for="usr">Correo</label>
              <input type="email" class="form-control" name="correoeditar" autocomplete="off" required  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" value='.$respuesta["Correo"].'>';
              echo '<label for="usr">Tel&eacute;fono</label>
              <input type="text" class="form-control" name="teleditar" autocomplete="off" value='.$respuesta["Telefono"].' required>';
              echo '<label for="usr">Ficha</label>
              <input type="text" class="form-control" name="fichaeditar" autocomplete="off" value='.$respuesta["Ficha"].' required>';
              echo '<label>Sede</label>
              <select class="form-control" name="sedeeditar">
                <option >'.$respuesta["Sede"].'</option>
                <option value="1">Colombia</option>
                <option value="2">Complejo Sur</option>
                <option value="3">Ricaurte</option>
                <option value="4">Àlamos</option>
                <option value="5">Restrepo</option>
              </select>';
              echo '<label>Modalidad</label>
              <select class="form-control" name="modaleditar">
                <option disabled="">'.$respuesta["Modalidad"].'</option>
                <option value="1">Presencial</option>
                <option value="2">Complementaria</option>
              </select>';
              echo '<label>Jornada</label>
              <select class="form-control" name="jornadaeditar">
                <option >'.$respuesta["Jornada"].'</option>
                <option value="1">Diurna</option>
                <option value="2">Nocturna</option>
                <option value="3">Mixta</option>
                <option value="4">Madrugada</option>
                <option value="5">Fines de Semana</option>
              </select>';
              echo '<label>Tipo de Formacion Titulada (Si es virtual seleccione ninguna)</label>
              <select class="form-control" name="tipo_formeditar">
                <option >'.$respuesta["TipoFormacion"].'</option>
                <option value="1">Ninguna</option>
                <option value="2">Técnico Profesional</option>
                <option value="3">Tecnólogo</option>
                <option value="4">Especializacion</option>
              </select>';
              echo ' </div>
          <center> <button type="submit" class="btn btn-info">Registrar</button>
          </center>';
}//editarAprendizController
public function actualizarAprendizController(){
		if(isset($_POST["ndeditar"])){
			$datosController = array("id"=>$_POST["ideditar"],"pn"=>$_POST["pneditar"],"sn"=>$_POST["sneditar"],"pa"=>$_POST["paeditar"],"sa"=>$_POST["saeditar"],"nd"=>$_POST["ndeditar"],"tidoc"=>$_POST["tidoceditar"],"dir"=>$_POST["direditar"],"correo"=>$_POST["correoeditar"],"tel"=>$_POST["teleditar"],"ficha"=>$_POST["fichaeditar"],"sede"=>$_POST["sedeeditar"],"modal"=>$_POST["modaleditar"],"jornada"=>$_POST["jornadaeditar"],"tipo_form"=>$_POST["tipo_formeditar"]);
			$respuesta = Datos::actualizarAprendizModel($datosController,"registroaprendiz");
			if($respuesta=="success"){
				//header ("location:index.php?action=cambio");
				echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Hecho!</strong> La actualización se realizó exitosamente
				  	</div>';

  //header ("location:index.php?action=consulta_aprendiz.php");
			}
			else{
				echo "error";
			}		
			}//if
	}//ActualizarAprendizControllerl

public function editarNovedadController(){
$datosController = $_GET["id"];
$respuesta = Datos::editarNovedadModel($datosController,"aplazamientos");
			echo '<input type="hidden" class="form-control" name="ideditar" value="'.$respuesta["documento_aprendiz"].'">';
            echo '<div class="form-group"><label for="usr">N&uacute;mero de documento</label>
              <input type="text" class="form-control" name="ndeditar" autocomplete="off" vallue='.$respuesta["documento_aprendiz"].'required>';
            echo '<label>Tipo de Documento</label>
              <select class="form-control" name="tidoceditar">
                <option >'.$respuesta["tipo_documento"].'</option>
                <option value="1">Cédula de Ciudadania</option>
                <option value="2">Tarjeta de Identidad</option>
                <option value="3">Cédula de Extranjeria</option>
                <option value="4">Pasaporte</option>
              </select>';
            echo '<label for="usr">Fecha</label>
              <input type="date" class="form-control" name="fechaeditar" autocomplete="off" value='.$respuesta["fecha"].'required>';
            echo '<label for="usr">Fecha</label>
              <input type="text" class="form-control" name="motivoeditar" autocomplete="off" value='.$respuesta["motivo"].'required>';
            echo '<label for="usr" >Respuesta</label>
              <select class="form-control" name="respuestaeditar">
                 <option >'.$respuesta["respuesta"].'</option>
                 <option value="Aceptada">1. Aceptada</option>
                 <option value="Rechazada">2. Rechazada</option>
               </select>';
}//editarAprendizController
public function actualizarNovedadController(){
		if(isset($_POST["ndeditar"])){
			$datosController = array("id"=>$_POST["ideditar"],"nd"=>$_POST["ndeditar"],"tidoc"=>$_POST["tidoceditar"],"correo"=>$_POST["correoeditar"],"tel"=>$_POST["teleditar"],"ficha"=>$_POST["fichaeditar"],"sede"=>$_POST["sedeeditar"],"modal"=>$_POST["modaleditar"],"jornada"=>$_POST["jornadaeditar"],"tipo_form"=>$_POST["tipo_formeditar"]);
			$respuesta = Datos::actualizarAprendizModel($datosController,"registroaprendiz");
			if($respuesta=="success"){
				//header ("location:index.php?action=cambio");
				echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Hecho!</strong> La actualización se realizó exitosamente
				  	</div>';

  //header ("location:index.php?action=consulta_aprendiz.php");
			}
			else{
				echo "error";
			}		
			}//if
	}//ActualizarAprendizControllerl

	}//clase

?>	