<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class responsable extends SafeMySQL {
	var $con;

	function __construct() {
		$this->con = new SafeMySQL();
	}

	function insertarResponsable($datos){
		$result = $this->con->query("INSERT INTO responsable SET ?u", $datos);
		if($result) return true;
	}

	function actualizarResponsable($name,$id){
		$result = $this->con->query("UPDATE responsable SET nombreResponsable = ?s  WHERE idResponsable = ?i", $name,$id);
		if($result) return true;
	}

	function verUsuario($id){
		return $this->con->getRow("SELECT * FROM usuario WHERE idUsuario=?i",$id);
	}
	function eliminarempleado($id){
		$result = $this->con->query("DELETE FROM empleado WHERE idEmpleado= ?i",$id);
		if($result) return true;
	}

	function ultimoidinsertado(){
		return $this->con->insertId();
	}
}
?>