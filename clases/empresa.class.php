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

	function getEmpresas(){
		return $this->con->getRow("SELECT * FROM `empresa` ORDER BY `aliasEmpresa` ASC");
	}
	function nuevaEmpresa($datos){
		$result = $this->con->query("INSERT INTO `empresa` SET ?u", $datos);
		if($result) return true;
	}
	/******************/
	function actualizarEmpresa($array){
		$result = $this->con->query("UPDATE `empresa` SET `aliasEmpresa` = ?, `fechaActualizacion` = ?  WHERE `idEmpresa` = ?");
		if($result) return true;
	}

}
?>
