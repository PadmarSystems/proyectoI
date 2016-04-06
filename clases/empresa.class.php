<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class empresas extends SafeMySQL {
    private $keyHash = 'sad.SD$24';//clave hashing para encriptar
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }
	/** EMPRESA **/
	function getEmpresas(){
		return $this->con->getRow("SELECT * FROM `empresa` ORDER BY `aliasEmpresa` ASC");
	}
	function nuevaEmpresa($datos){
		$result = $this->con->query("INSERT INTO `empresa` SET ?u", $datos);
		if($result) return true;
	}

	function actualizarEmpresa($datos=array()){
		//func con array como srg
		$result = $this->con->query("UPDATE `empresa` SET `aliasEmpresa` = ?  WHERE `idEmpresa` = ?",$datos);
		if($result) return true;
	}
	
	/** PUESTOS **/
	function getPuestos(){
		return $this->con->getRow("SELECT * FROM `puesto` WHERE idEmpresa = ? ORDER BY `nombrePuesto` ASC");
	}
	function nuevoPuesto($datos){ /**/
		$result = $this->con->query("INSERT INTO `puesto` (`idEmpresa`,`nombrePuesto`,`fechaCreacion`) VALUES (?, ?, ?)", $datos);
		if($result) return true;
	}

	function actualizarPuesto($datos=array()){ /**/
		//func con array como srg 
		$result = $this->con->query("UPDATE `puesto` SET `nombrePuesto`= ? WHERE `idPuesto`=?",$datos);
		if($result) return true;
	}
	function verPuestoxID($datos=array()){ /**/
		$result = $this->con->query("SELECT * FROM `puesto` WHERE `idPuesto`=?",$datos);
		if($result) return true;
	}
}
?>