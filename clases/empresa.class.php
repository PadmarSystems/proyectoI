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
		$result = $this->con->query("UPDATE `empresas` SET `aliasEmpresa` = ?s WHERE `idEmpresa` = ?i",$name,$id);
		if($result) return true;
	}
	function getEmpresas(){
		return $this->con->getAll("SELECT * FROM `empresas` ORDER BY `aliasEmpresa` ASC");
	}
	function verEmpresaxID($id){
		return $this->con->getRow("SELECT * FROM `empresas` WHERE `idEmpresa` = ?i",$id);
	}
	function nuevaEmpresa($datos){
		$result = $this->con->query("INSERT INTO `empresas` SET ?u", $datos);
		if($result) return true;
	}

	function actualizarPuesto($datos=array()){ /**/
		//func con array como srg 
		$result = $this->con->query("UPDATE `puestos` SET `nombrePuesto`= ? WHERE `idPuesto`=?",$datos);
		if($result) return true;
	}
	function verPuestoxID($datos=array()){ /**/
		$result = $this->con->query("SELECT * FROM `puestos` WHERE `idPuesto`=?",$datos);
		if($result) return true;
	}

	function mostrar_empresas($params="*", $where=""){
        $sql = "SELECT $params from empresas $where";
        return $this->con->getAll($sql);
    }
}
?>