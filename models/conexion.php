<?php

class conexion{

	public static function conectar(){

		$link=new PDO("mysql:host=localhost;dbname=sns","root","");
		return $link;
	}

}
?>