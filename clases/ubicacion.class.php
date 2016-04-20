<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class ubicacion extends SafeMySQL {
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }

	function actualizarUbicacion($name,$id){
		$result = $this->con->query("UPDATE `ubicaciones` SET `nombreUbicacion` = ?s WHERE `idUbicacion` = ?i",$name,$id);
		if($result) return true;
	}

	function actualizarUbicacionarray($datos,$id){
		$result = $this->con->query("UPDATE ubicaciones SET ?u  WHERE idUbicacion = ?i", $datos,$id);
		if($result) return true;
	}

	function getEmpleadosxUbic($id){
		return $this->con->getAll("SELECT COUNT(*) FROM `empleados` WHERE `idUbicacion`=?i",$id);
	}
	function getUbicacionesxEmp($datos){
		return $this->con->getAll("SELECT * FROM `ubicaciones` WHERE `idEmpresa`= ?i ORDER BY `nombreUbicacion` ASC",$datos);
	}
	function getUbicacionxID($id){
		return $this->con->getRow("SELECT * FROM `ubicaciones` WHERE `idUbicacion`= ?i",$id);
	}
	function insertarUbicacion($datos){
		$result = $this->con->query("INSERT INTO `ubicaciones` SET ?u", $datos);
		if($result) return true;
	}

	function mostrar_ubicaciones($params="*", $where=""){
        $sql = "SELECT $params from ubicaciones $where";
        return $this->con->getAll($sql);
    }

    function mostrar_ubicacion($id){
		return $this->con->getRow("SELECT * from ubicaciones WHERE idUbicacion=?i",$id);
	}
}
?>