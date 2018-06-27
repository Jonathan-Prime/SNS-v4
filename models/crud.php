<?php

require_once ('conexion.php');

class Datos extends Conexion{

	public static function registroUsuarioModel($datos,$tabla){

		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, documento, tipo_documento, correo, contrasena, rol) VALUES (:pn,:sn,:pa,:sa,:nd,:tidoc,:correo,:contra,:rol)");
		$stmt->bindParam(":pn",$datos["pn"], PDO::PARAM_STR);
		$stmt->bindParam(":sn",$datos["sn"], PDO::PARAM_STR);
		$stmt->bindParam(":pa",$datos["pa"], PDO::PARAM_STR);
		$stmt->bindParam(":sa",$datos["sa"], PDO::PARAM_STR);
		$stmt->bindParam(":nd",$datos["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datos["tidoc"], PDO::PARAM_INT);
		$stmt->bindParam(":correo",$datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":contra",$datos["contra"], PDO::PARAM_STR);
		$stmt->bindParam(":rol",$datos["rol"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Atención!</strong> No se pudo registrar el usuario vuelva a intentarlo.
  </div>';
		}

	}// funcion registroUsuarioModel

	//login
	//**********************************************************
	public static function ingresoUsuarioModel($datosModel,$tabla){
		 $stmt=Conexion::conectar()->prepare("SELECT primer_nombre, primer_apellido, documento, tipo_documento,correo, contrasena, rol FROM $tabla WHERE documento = :nd" );
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}//ingresoUsuarioModel

	public static function navModel($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("SELECT documento, tipo_documento, rol FROM $tabla WHERE documento = :nd" );
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}//navModel

	public static function perfilModel($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("SELECT documento, tipo_documento, rol FROM $tabla WHERE documento = :nd" );
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}//navModel


	//registro novedades
	//*************************************************

	public static function registroDesercionModel($datosModel,$tabla,$campos,$valores){
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla($campos) VALUES ($valores)");
		//:nd,:tidoc,:fecha,:fallas,:motivo,:respuesta
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha",$datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":fallas",$datosModel["fallas"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo",$datosModel["motivo"], PDO::PARAM_STR);
		$stmt->bindParam(":respuesta",$datosModel["respuesta"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <strong>Atención!</strong> No se pudo registrar el usuario vuelva a intentarlo.
		  </div>';
		}

	}//registroDesercionModel

	public static function registroReintegroModel($datosModel,$tabla,$campos,$valores){
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla($campos) VALUES ($valores)");
		//:nd,:tidoc,:fecha,:fallas,:motivo,:respuesta
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha",$datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":sede_reintegro",$datosModel["sede_reintegro"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo",$datosModel["motivo"], PDO::PARAM_STR);
		$stmt->bindParam(":respuesta",$datosModel["respuesta"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <strong>Atención!</strong> No se pudo registrar el usuario vuelva a intentarlo.
		  </div>';
		}

	}//registroReintegroModel

	public static function registroTrasladoModel($datosModel,$tabla,$campos,$valores){
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla($campos) VALUES ($valores)");
		//:nd,:tidoc,:fecha,:fallas,:motivo,:respuesta
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_INT);
		$stmt->bindParam(":sede_traslado",$datosModel["sede_traslado"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo",$datosModel["motivo"], PDO::PARAM_STR);
		$stmt->bindParam(":respuesta",$datosModel["respuesta"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <strong>Atención!</strong> No se pudo registrar el usuario vuelva a intentarlo.
		  </div>';
		}

	}//registroReintegroModel

	public static function registroCambioDeJornadaModel($datosModel,$tabla,$campos,$valores){
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla($campos) VALUES ($valores)");
		//:nd,:tidoc,:fecha,:fallas,:motivo,:respuesta
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_INT);
		$stmt->bindParam(":jornada",$datosModel["jornada"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo",$datosModel["motivo"], PDO::PARAM_STR);
		$stmt->bindParam(":respuesta",$datosModel["respuesta"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <strong>Atención!</strong> No se pudo registrar el usuario vuelva a intentarlo.
		  </div>';
		}

	}//registroReintegroModel
	public static function registroNovedadModel($datosModel,$tabla,$campos,$valores){
		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla($campos) VALUES ($valores)");
		//:nd,:tidoc,:fecha,:fallas,:motivo,:respuesta
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha",$datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo",$datosModel["motivo"], PDO::PARAM_STR);
		$stmt->bindParam(":respuesta",$datosModel["respuesta"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <strong>Atención!</strong> No se pudo registrar el usuario vuelva a intentarlo.
		  </div>';
		}


	}//registroNovedadModel

	public static function CambioRolModel($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET rol=:rol WHERE documento=:nd and tipo_documento=:tidoc");
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_INT);
		$stmt->bindParam(":rol",$datosModel["rol"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <strong>Atención!</strong> No se pudo realizar el cambio de rol.
		  </div>';
		}

	}//CambioRolModel

	public static function consultaNovedadModel($datosModel,$tabla){

		

		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE documento_aprendiz=:nd and tipo_documento=:tidoc");
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_INT);
		// $stmt1=Conexion::conectar()->prepare("SELECT * FROM registroaprendiz WHERE Documento=:nd and TipoDocumento=:tidoc");
		// $stmt1->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		// $stmt1->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return $stmt->fetchAll();
		}else
		return "lose";
		
	}//consultaNovedadModel

	public static function vistaAprendizModel($tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();
		return $stmt->fetchAll();

	}//vistaAprendizModel
	
	public static function registroAprendizModel($datos,$tabla){

		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla VALUES (:pn,:sn,:pa,:sa,:nd,:tidoc,:dir,:correo,:tel,:ficha,:sede,:modal,:jornada,:tipo_form)");
		$stmt->bindParam(":pn",$datos["pn"], PDO::PARAM_STR);
		$stmt->bindParam(":sn",$datos["sn"], PDO::PARAM_STR);
		$stmt->bindParam(":pa",$datos["pa"], PDO::PARAM_STR);
		$stmt->bindParam(":sa",$datos["sa"], PDO::PARAM_STR);
		$stmt->bindParam(":nd",$datos["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datos["tidoc"], PDO::PARAM_INT);
		$stmt->bindParam(":dir",$datos["dir"], PDO::PARAM_STR);
		$stmt->bindParam(":correo",$datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":tel",$datos["tel"], PDO::PARAM_INT);
		$stmt->bindParam(":ficha",$datos["ficha"], PDO::PARAM_STR);
		$stmt->bindParam(":sede",$datos["sede"], PDO::PARAM_STR);
		$stmt->bindParam(":modal",$datos["modal"], PDO::PARAM_STR);
		$stmt->bindParam(":jornada",$datos["jornada"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_form",$datos["tipo_form"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Atención!</strong> No se pudo registrar el usuario vuelva a intentarlo.
  </div>';
		}

	}// funcion registroAprendizoModel

	public static function consultaContraseñaModel($datosModel, $tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE documento=:nd");
				$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);

		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return '<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <strong>Atención!</strong>no hay registros .
		  </div>';
		}
	}//consultaContraseñaModel

	public static function contraseñaModel($datosModel, $tabla){
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET contrasena=:contran WHERE documento=:nd");
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":contran",$datosModel["contran"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <strong>Atención!</strong> No se pudo realizar el cambio de contraseña.
		  </div>';
		}
	}//contraseñaModel

	public static function vistaUnAprendizModel($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE Documento=:nd and  TipoDocumento=:tidoc");
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();

	}//vistaUnAprendizModel

	public static function aprendizModel($datosModel,$tabla){
		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE Documento=:nd  and  TipoDocumento=:tidoc");
		$stmt->bindParam(":nd",$datosModel["nd"], PDO::PARAM_INT);
		$stmt->bindParam(":tidoc",$datosModel["tidoc"], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();

	}//vistaUnAprendizModel

	public static function borraraprendizModel($datosModel,$tabla){
		if ($tabla=="registroaprendiz") {
		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE Documento =:nd");
		$stmt->bindParam(":nd",$datosModel, PDO::PARAM_INT);
		}else{
		$stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE documento_aprendiz =:nd");
		$stmt->bindParam(":nd",$datosModel, PDO::PARAM_INT);
		}
		if($stmt->execute()){
			return "success";
		}else{
			return '<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert">×</button>
		    <strong>Atención!</strong> No se pudo eliminar el aprendiz
		  </div>';
		}
	}//borraraprendizModel
	public static function editarAprendizModel($datosModel,$tabla){
       
       $smtp = Conexion::conectar()->prepare("SELECT PrimerNombre,SegundoNombre,PrimerApellido,SegundoApellido,Documento,TipoDocumento,Direccion,Correo,Telefono,Ficha,Sede,Modalidad,Jornada,TipoFormacion FROM $tabla WHERE Documento=:id");
       $smtp->bindParam(":id", $datosModel, PDO::PARAM_INT);
       $smtp->execute();
       return $smtp->fetch();
       $smtp->close();
	}//editarAprendizModel
	public static function actualizarAprendizModel($datosModel,$tabla){

		$smtp = Conexion::conectar()->prepare("UPDATE $tabla SET PrimerNombre=:pn,SegundoNombre=:sn,PrimerApellido=:pa,SegundoApellido=:sa,Documento=:nd,TipoDocumento=:tidoc,Direccion=:dir,Correo=:correo,Telefono=:tel,Ficha=:ficha,Sede=:sede,Modalidad=:modal,Jornada=:jornada,TipoFormacion=:tipo_form WHERE Documento=:id");
		$smtp->bindParam(":pn", $datosModel["pn"], PDO::PARAM_STR);
		$smtp->bindParam(":sn", $datosModel["sn"], PDO::PARAM_STR);
		$smtp->bindParam(":pa", $datosModel["pa"], PDO::PARAM_STR);
		$smtp->bindParam(":sa", $datosModel["sa"], PDO::PARAM_STR);
		$smtp->bindParam(":nd", $datosModel["nd"], PDO::PARAM_INT);
		$smtp->bindParam(":tidoc", $datosModel["tidoc"], PDO::PARAM_STR);
		$smtp->bindParam(":dir", $datosModel["dir"], PDO::PARAM_STR);
		$smtp->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
		$smtp->bindParam(":tel", $datosModel["tel"], PDO::PARAM_INT);
		$smtp->bindParam(":ficha", $datosModel["ficha"], PDO::PARAM_STR);
		$smtp->bindParam(":sede", $datosModel["sede"], PDO::PARAM_STR);
		$smtp->bindParam(":modal", $datosModel["modal"], PDO::PARAM_STR);
		$smtp->bindParam(":jornada", $datosModel["jornada"], PDO::PARAM_STR);
		$smtp->bindParam(":tipo_form", $datosModel["tipo_form"], PDO::PARAM_STR);
		$smtp->bindParam(":id", $datosModel["id"], PDO::PARAM_STR);
		if($smtp->execute()){
			return "success";
		}
		else{
			return "error";
		}
	}//actualizarAprendizModel

}//clase datod


?>