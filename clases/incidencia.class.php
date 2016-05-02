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

    function insertarincidenciaadic($datos){
        $result = $this->con->query("INSERT INTO incidencias_campos SET ?u", $datos);
        if($result) return true;
    }

    function actualizarincidencia($datos,$id){
        $result = $this->con->query("UPDATE incidencias SET ?u  WHERE idIncidencia = ?i", $datos,$id);
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

    function ultimoidinsertado(){
        return $this->con->insertId();
    }

    function mostrar_numincidencias($id,$month){
        return $this->con->getOne("SELECT count(*)num FROM `incidencias` where idEmpleado=?i and month(fechaInicio) = ?s",$id,$month);
    }

    function mostrar_numincidenciastotal($id){
        return $this->con->getOne("SELECT count(*) FROM `incidencias` where idEmpleado=?i",$id);
    }

    function mostrar_campos($id){
        return $this->con->getAll("SELECT DISTINCT nombreCampo FROM `campos_adicionales` WHERE idTipo=?i GROUP by nombreCampo order by idCampo",$id);
    }

    function mostrar_valorescampos($nombreCampo){
        return $this->con->getAll("SELECT valorCampo FROM `campos_adicionales` where nombreCampo = ?s ORDER BY nombreCampo",$nombreCampo);
    }

    function verIncidenciasTipoFecha($id,$tipo,$month){
        return $this->con->getAll("SELECT * FROM `incidencias` WHERE idEmpleado=?i AND idTipoIncidencia=?i AND month(fechaInicio)=?s",$id,$tipo,$month);
    }
}
?>