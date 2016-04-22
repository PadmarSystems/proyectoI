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

    function mostrar_incidencias($params="incidencias.*", $where=""){
        $sql = "SELECT $params,nombreEmpresa,nombreUsuario,nombreEmp,nombreResponsable,nombrePuesto,nombreUbicacion,tipoIncidencia
			FROM `incidencias`
			INNER JOIN usuarios ON incidencias.idUsuario=usuarios.idUsuario
			INNER JOIN empresas ON incidencias.idEmpresa=empresas.idEmpresa
			INNER JOIN empleados ON incidencias.idEmpleado=empleados.idEmpleado
            INNER JOIN tipo_incidencia ON incidencias.idTipoIncidencia=tipo_incidencia.idTipo
			LEFT JOIN puestos ON incidencias.idPuesto=puestos.idPuesto
			LEFT JOIN ubicaciones ON incidencias.idUbicacion=ubicaciones.idUbicacion
			LEFT JOIN responsables ON incidencias.idResponsable=responsables.idResponsable $where";
        return $this->con->getAll($sql);
    }

    function mostrar_incidenciasfiltro($sql){
        return $this->con->getAll($sql);
    }

    function mostrar_tipo_incidencias($params="*", $where=""){
        $sql = "SELECT $params FROM tipo_incidencia $where";
        return $this->con->getAll($sql);
    }

    function mostrar_empresas($params="*", $where=""){
        $sql = "SELECT $params FROM empresas $where";
        return $this->con->getAll($sql);
    }

    function mostrar_ultimaincidencia($id){
        return $this->con->getRow("SELECT idIncidencia,date(fechaInicio) fechaInicio,tipoIncidencia FROM `incidencias`inner JOIN tipo_incidencia on incidencias.idTipoIncidencia=tipo_incidencia.idTipo where idEmpleado=?i ORDER by idIncidencia DESC LIMIT 1",$id);
    }

    function mostrar_numincidencias($id,$month){
        return $this->con->getOne("SELECT count(*)num FROM `incidencias` where idEmpleado=?i and month(fechaInicio) = ?s",$id,$month);
    }

    function mostrar_numincidenciastotal($id){
        return $this->con->getOne("SELECT count(*) FROM `incidencias` where idEmpleado=?i",$id);
    }
}
?>