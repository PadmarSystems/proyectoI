<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class ubicaciones extends SafeMySQL {
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }

	function getUbicacion($datos){
		return $this->con->getRow("SELECT * FROM `ubicacion` WHERE idEmpresa= ? ORDER BY `nombreUbicacion` ASC");
	}
	function nuevaUbicacion($datos){
		$result = $this->con->query("INSERT INTO `ubicacion` SET ?u", $datos);
		if($result) return true;
	}

	function actualizarUbicacion($datos=array()){
		//func tiene array como arg
		$result = $this->con->query("UPDATE `ubicacion` SET `nombreUbicacion` = ? WHERE `idUbicacion` = ?");
		if($result) return true;
	}

}
?>