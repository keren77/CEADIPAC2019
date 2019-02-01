<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){

		if($item != null){

			$stmt = ConexionBD::Abrir_Conexion()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = ConexionBD::Abrir_Conexion()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> Cerrar_Conexion();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos){


		$stmt = ConexionBD::Abrir_Conexion()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil) VALUES (:nombre, :usuario, :password, :perfil)");


		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);

		//$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){


		$stmt = ConexionBD::Abrir_Conexion()->prepare("UPDATE $tabla SET Contrasena = :password WHERE Usuario = :usuario");

	//	$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["Contrasena"], PDO::PARAM_STR);
	//	$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
	//	$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["Usuario"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = ConexionBD::Abrir_Conexion()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos){


		$stmt = ConexionBD::Abrir_Conexion()->prepare("DELETE FROM $tabla WHERE Id_usuario = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;


	}

}
