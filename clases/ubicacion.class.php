<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class ubicaciones extends SafeMySQL {
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }

	function actualizarUbicacion($name,$id){
		$result = $this->con->query("UPDATE `ubicacion` SET `nombreUbicacion` = ?s WHERE `idUbicacion` = ?i",$name,$id);
		if($result) return true;
	}
	function getEmpleadosxUbic($id){
		return $this->con->getAll("SELECT COUNT(*) FROM empleado WHERE idUbicacion=?i",$id);
	}
	function getUbicacionesxEmp($datos){
		return $this->con->getAll("SELECT * FROM `ubicacion` WHERE idEmpresa= ?i ORDER BY `nombreUbicacion` ASC",$datos);
	}
	function insertarUbicacion($datos){
		$result = $this->con->query("INSERT INTO `ubicacion` SET ?u", $datos);
		if($result) return true;
	}
}
?>