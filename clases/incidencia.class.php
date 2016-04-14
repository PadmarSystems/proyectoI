<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class incidencia extends SafeMySQL {
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }

    function insertarincidencia($datos){
        $result = $this->con->query("INSERT INTO incidencias SET ?u", $datos);
        if($result) return true;
    }
}
?>