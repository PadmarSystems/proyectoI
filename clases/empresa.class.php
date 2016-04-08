<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class empresa extends SafeMySQL {
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }
	function actualizarEmpresa($name,$id){
		$result = $this->con->query("UPDATE `empresa` SET `aliasEmpresa` = ?s WHERE `idEmpresa` = ?i",$name,$id);
		if($result) return true;
	}
	function getEmpresas(){
		return $this->con->getAll("SELECT * FROM `empresa` ORDER BY `aliasEmpresa` ASC");
	}
	function verEmpresaxID($id){
		return $this->con->getRow("SELECT * FROM `empresa` WHERE `idEmpresa` = ?i",$id);
	}
	function nuevaEmpresa($datos){
		$result = $this->con->query("INSERT INTO `empresa` SET ?u", $datos);
		if($result) return true;
	}

	function mostrar_empresas($params="*", $where=""){
        $sql = "SELECT $params from empresa $where";
        return $this->con->getAll($sql);
    }
}
?>