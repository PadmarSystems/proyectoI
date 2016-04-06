<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class empresa extends SafeMySQL {
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }
	function getEmpresas(){
		return $this->con->getRow("SELECT * FROM `empresa` ORDER BY `aliasEmpresa` ASC");
	}
	function nuevaEmpresa($datos){
		$result = $this->con->query("INSERT INTO `empresa` SET ?u", $datos);
		if($result) return true;
	}

	function actualizarEmpresa($datos=array()){
		//func con array como srg
		$result = $this->con->query("UPDATE `empresa` SET `aliasEmpresa` = ?  WHERE `idEmpresa` = ?");
		if($result) return true;
	}

	function mostrar_empresas($params="*", $where=""){
        $sql = "SELECT $params from empresa $where";
        return $this->con->getAll($sql);
    }
}
?>