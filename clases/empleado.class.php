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
		$result = $this->con->query("INSERT INTO empleados SET ?u", $datos);
		if($result) return true;
	}

	function actualizarempleado($datos,$id){
		$result = $this->con->query("UPDATE empleados SET ?u  WHERE idEmpleado = ?i", $datos,$id);
		if($result) return true;
	}

	function mostrar_empleado($id){
		return $this->con->getRow("SELECT * from empleados WHERE idEmpleado=?i",$id);
	}

	function mostrar_empleado_nombre($clave){
		$this->con->query("SET NAMES utf8");
		return $this->con->getRow("SELECT * from empleados WHERE nombreEmp like ?s COLLATE utf8_bin",$clave);
	}

	function mostrar_empleadodetalle($id){
		return $this->con->getRow("SELECT empleados.*, nombrePuesto,nombreUbicacion,nombreResponsable,nombreEmpresa
				FROM `empleados`
				inner join empresas ON empleados.idEmpresa=empresas.idEmpresa
				LEFT JOIN puestos ON empleados.idPuesto=puestos.idPuesto
				LEFT JOIN ubicaciones ON empleados.idUbicacion = ubicaciones.idUbicacion
				LEFT JOIN responsables ON empleados.idResponsable=responsables.idResponsable 
				 WHERE idEmpleado=?i ORDER by empleados.nombreEmp",$id);
	}

	function mostrar_empleados($params="*", $where=""){
		$sql = "SELECT empleados.*, nombrePuesto,nombreUbicacion,nombreResponsable,nombreEmpresa
				FROM `empleados`
				inner join empresas ON empleados.idEmpresa=empresas.idEmpresa
				LEFT JOIN puestos ON empleados.idPuesto=puestos.idPuesto
				LEFT JOIN ubicaciones ON empleados.idUbicacion = ubicaciones.idUbicacion
				LEFT JOIN responsables ON empleados.idResponsable=responsables.idResponsable 
				ORDER by empleados.nombreEmp";
		return $this->con->getAll($sql);
	}

	function autocompletar_nombreEmpleados($clave,$params="nombreEmp", $where=""){
		$sql = "SELECT $params FROM empleados WHERE nombreEmp LIKE '%$clave%' $where";
		return $this->con->getAll($sql);
	}

	function eliminarempleado($id){
		$result = $this->con->query("DELETE FROM empleados WHERE idEmpleado= ?i",$id);
		if($result) return true;
	}

	function ultimoidinsertado(){
		return $this->con->insertId();
	}

	function verEmpleados($dato) {
		return $this->con->getAll("SELECT * FROM empleados WHERE idEmpresa=?i",$dato);
	}
	function verEmpleadoxID($dato) {
		return $this->con->getRow("SELECT * FROM empleados WHERE idEmpleado=?i",$dato);
	}
	////////////
	function verUsuarioxNombre($name){
		return $this->con->getRow("SELECT * FROM usuarios WHERE nombreUsuario LIKE '".$name."'");
	}
	////
	function mostrar_responsables($params="*", $where=""){
		$sql = "SELECT $params FROM responsables $where";
		return $this->con->getAll($sql);
	}

	function mostrar_ubicaciones($params="*", $where=""){
		$sql = "SELECT $params FROM ubicaciones $where";
		return $this->con->getAll($sql);
	}

	function mostrar_puestos($params="*", $where=""){
		$sql = "SELECT $params FROM puestos $where";
		return $this->con->getAll($sql);
	}

	function mostrar_tiposnomina($params="*", $where=""){
		$sql = "SELECT $params FROM tipo_nomina $where";
		return $this->con->getAll($sql);
	}

	function valida_empleado($usuario) {
        $result = $this->con->query("SELECT 1 FROM empleados WHERE nombreEmp LIKE ?s",$usuario);
        $nReg = $this->con->numRows($result);
        if($nReg>0) return FALSE;
        else return TRUE;
    }
}
?>