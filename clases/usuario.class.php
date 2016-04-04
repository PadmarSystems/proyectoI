<?php
//include_once("conexion.class.php");
require_once 'config.gral.php';
require_once 'safemysql.php';

class usuario extends SafeMySQL {
    private $keyHash = 'sad.SD$24';//clave hashing para encriptar
    var $con;

    function __construct() {
        $this->con = new SafeMySQL();
    }

    function insertarusuario($datos){
        $result = $this->con->query("INSERT INTO usuarios SET ?u", $datos);
        if($result) return true;
    }

    function actualizarusuario($datos,$id){
        $result = $this->con->query("UPDATE usuarios SET ?u  WHERE idUsuario = ?i", $datos,$id);
        if($result) return true;
    }

    function mostrar_usuario($id){
        return $this->con->getRow("SELECT * from usuarios WHERE idUsuario=?i",$id);
    }

    function mostrar_usuarios($params="*", $where=""){
        $sql = "SELECT $params from usuarios $where";
        return $this->con->getAll($sql);
    }

    function eliminarusuario($id){
        $result = $this->con->query("DELETE FROM usuarios WHERE idUsuario= ?i",$id);
        if($result) return true;
    }

    function ultimoidinsertado(){
        return $this->con->insertId();
    }
    
    function encriptaPass($param) {
        return crypt($param, $this->keyHash);
    }

    function generar_clave($longitud){ 
       $cadena="[^A-Z0-9]"; 
       return substr(preg_replace($cadena, "", md5(rand())) . preg_replace($cadena, "", md5(rand())) . preg_replace($cadena, "", md5(rand())), 0, $longitud);
    }
    
    function valida_usuario($usuario) {
        $result = $this->con->query("SELECT 1 FROM usuarios WHERE usuario LIKE ?s",$usuario);
        $nReg = $this->con->numRows($result);
        if($nReg>0) return TRUE;
        else return FALSE;
    }

    function loginusuario($usuario, $password) {
        $password = $this->encriptaPass($password);
        $sql = "SELECT * FROM usuarios WHERE usuario LIKE '$usuario' AND contrasena LIKE '$password' LIMIT 1";
        $result = $this->con->query($sql);
        $nReg = $this->con->numRows($result);
        if ($nReg > 0) return $this->con->fetch($result);
        else return false;
    }
}
?>