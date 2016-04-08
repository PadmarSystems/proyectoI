<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class empleado extends SafeMySQL {
	var $con;

	function __construct() {
		$this->con = new SafeMySQL();
	}

	function insertarempleado($datos){
		$result = $this->con->query("INSERT INTO empleado SET ?u", $datos);
		if($result) return true;
	}

	function actualizarempleado($datos,$id){
		$result = $this->con->query("UPDATE empleado SET ?u  WHERE idEmpleado = ?i", $datos,$id);
		if($result) return true;
	}

	function mostrar_empleado($id){
		return $this->con->getRow("SELECT * from empleado WHERE idEmpleado=?i",$id);
	}

	function mostrar_empleados($params="*", $where=""){
		$sql = "SELECT $params FROM empleado $where";
		return $this->con->getAll($sql);
	}

	function eliminarempleado($id){
		$result = $this->con->query("DELETE FROM empleado WHERE idEmpleado= ?i",$id);
		if($result) return true;
	}

	function ultimoidinsertado(){
		return $this->con->insertId();
	}

	function verEmpleados($dato) {
		return $this->con->getAll("SELECT * FROM empleado WHERE idEmpresa=?i",$dato);
	}
	function verEmpleadoxID($dato) {
		return $this->con->getRow("SELECT * FROM empleado WHERE idEmpleado=?i",$dato);
	}
	////////////
	function verUsuarioxNombre($name){
		return $this->con->getRow("SELECT * FROM usuario WHERE nombreUsuario LIKE '".$name."'");
	}
	////
	function mostrar_responsables($params="*", $where=""){
		$sql = "SELECT $params FROM responsable $where";
		return $this->con->getAll($sql);
	}

	function mostrar_ubicaciones($params="*", $where=""){
		$sql = "SELECT $params FROM ubicacion $where";
		return $this->con->getAll($sql);
	}

	function mostrar_puestos($params="*", $where=""){
		$sql = "SELECT $params FROM puesto $where";
		return $this->con->getAll($sql);
	}
}
?>