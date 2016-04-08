<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class puestos extends SafeMySQL {
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }
	function mostrar_empresas($params="*", $where=""){
        $sql = "SELECT $params from empresa $where";
        return $this->con->getAll($sql);
	}
	function actualizarPuesto($name,$id){
		$result = $this->con->query("UPDATE `puesto` SET `nombrePuesto` = ?s  WHERE `idPuesto` = ?i", $name,$id);
		if($result) return true;
	}
	function eliminarempleado($id){
		$result = $this->con->query("DELETE FROM `puesto` WHERE `idEmpleado`= ?i",$id);
		if($result) return true;
	}
	function nuevoPuesto($datos){
		$result = $this->con->query("INSERT INTO `puesto` SET ?u", $datos);
		if($result) return true;
	}
	function verPuestoxID($id){
		return $this->con->getRow("SELECT * FROM `puesto` WHERE `idPuesto`=?i",$id);
	}
	function ultimoidinsertado(){
		return $this->con->insertId();
	}
	function verUsuario($id){
		return $this->con->getRow("SELECT * FROM `usuario` WHERE `idUsuario`=?i",$id);
	}
}
?>