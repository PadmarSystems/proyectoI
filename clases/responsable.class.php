<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class responsable extends SafeMySQL {
	var $con;

	function __construct() {
		$this->con = new SafeMySQL();
	}

	function actualizarResponsable($name,$id){
		$result = $this->con->query("UPDATE responsables SET nombreResponsable = ?s  WHERE idResponsable = ?i", $name,$id);
		if($result) return true;
	}
	function eliminarempleado($id){
		$result = $this->con->query("DELETE FROM empleados WHERE idEmpleado= ?i",$id);
		if($result) return true;
	}
	function insertarResponsable($datos){
		$result = $this->con->query("INSERT INTO responsables SET ?u", $datos);
		if($result) return true;
	}
	function ultimoidinsertado(){
		return $this->con->insertId();
	}
	function verResponsablexID($id){
		return $this->con->getRow("SELECT * FROM responsables WHERE idResponsable = ?i",$id);
	}
	function verUsuario($id){
		return $this->con->getRow("SELECT * FROM usuarios WHERE idUsuario=?i",$id);
	}

	function mostrar_responsables($params="*", $where=""){
        $sql = "SELECT $params from responsables $where";
        return $this->con->getAll($sql);
    }
}
?>