<?php

class EnlacesPaginas{

	public static function enlacesPaginasModel($enlaces){
		if( $enlaces=="registros/registro_usuario"||$enlaces=="registros/form_novedades"||$enlaces=="consultar_novedad"||$enlaces=="consultar_novedadi"||$enlaces=="registros/registrar_aprendiz"||$enlaces=="rol"||$enlaces=="consulta_aprendiz"||$enlaces=="consulta_aprendizi"||$enlaces=="cambio_contra"||$enlaces=="editar"||$enlaces=="editar_nov"){
			$modulo="views/modulos/formularios/".$enlaces.".php";
		}
		else if($enlaces=="index"){
			$modulo="views/modulos/cuerpo/slider.php";
		}
		else if($enlaces=="perfil") {
			$modulo="views/modulos/cuerpo/perfil.php";
		}
		else if($enlaces=="perfil_apoyo_admin") {
			$modulo="views/modulos/cuerpo/perfil_apoyo_admin.php";
		}
		else if($enlaces=="salir") {
			$modulo="views/modulos/cuerpo/salir.php";
		}
		else if($enlaces=="consultar") {
			$modulo="views/modulos/formularios/consultar_novedad.php";
		}
		else{

			if ($_SESSION["r"]=="instructor"||$_SESSION["r"]=="apoyoadministrador"||$_SESSION["r"]=="administrador") {
				$modulo="views/modulos/cuerpo/perfil.php";
				}else{
				$modulo="views/modulos/cuerpo/slider.php";		
			}
			
		}
		return $modulo;
	}

}

?>