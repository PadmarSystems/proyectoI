<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class puesto extends SafeMySQL {
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }

	function mostrar_empresas($params="*", $where=""){
        $sql = "SELECT $params from empresas $where";
        return $this->con->getAll($sql);
	}

	function mostrar_puestos($params="*", $where=""){
        $sql = "SELECT $params from puestos inner join empresas on puestos.idEmpresa=empresas.idEmpresa $where";
        return $this->con->getAll($sql);
	}

	function mostrar_puesto($id){
		return $this->con->getRow("SELECT * from puestos WHERE idPuesto=?i",$id);
	}

	function actualizarPuesto($name,$id){
		$result = $this->con->query("UPDATE `puestos` SET `nombrePuesto` = ?s  WHERE `idPuesto` = ?i", $name,$id);
		if($result) return true;
	}

	function actualizarPuestoarray($datos,$id){
		$result = $this->con->query("UPDATE puestos SET ?u  WHERE idPuesto = ?i", $datos,$id);
		if($result) return true;
	}

	function eliminarpuesto($id){
		$result = $this->con->query("DELETE FROM `puestos` WHERE `idPuestos`= ?i",$id);
		if($result) return true;
	}
	function nuevoPuesto($datos){
		$result = $this->con->query("INSERT INTO `puestos` SET ?u", $datos);
		if($result) return true;
	}
	function verPuestoxID($id){
		return $this->con->getRow("SELECT * FROM `puestos` WHERE `idPuesto`=?i",$id);
	}
	function ultimoidinsertado(){
		return $this->con->insertId();
	}
	function verUsuario($id){
		return $this->con->getRow("SELECT * FROM `usuarios` WHERE `idUsuario`=?i",$id);
	}
}
?>