<?php
require('../clases/empresa.class.php');
$objEmp = new empresa;

require('../clases/usuario.class.php');
$usuario = new usuario;

require('../clases/ubicacion.class.php');
$objUbic = new ubicacion;

session_start();

if ($_SESSION['rol'] == 0) { 
	if (isset($_POST)) {
		$nombreEmpresa= $_POST['empresa'];
		$valida = $objEmp->valida_empresa($nombreEmpresa);
		if($valida){
			$inserta = $objEmp->insertarempresa(array('nombreEmpresa'=>$nombreEmpresa,'aliasEmpresa' => $nombreEmpresa));
			if ($inserta) {

				$idEmpresa = $objEmp->ultimoidinsertado();
				$ubicArray=array(
					'idEmpresa'=>$idEmpresa,
					'nombreUbicacion'=>$nombreEmpresa . "reggy"
				);

				$insertaubicacion = $objUbic->insertarUbicacion($ubicArray);
				

				$usuArray = array(
					'idEmpresa' => $idEmpresa,
					'nombreUsuario' => $nombreEmpresa . "reggy",
					'email' => $_POST['correo'],
					'contrasena' => $usuario->encriptaPass($_POST['pass'])
				);

				$insertUsuario = $usuario->insertarusuario($usuArray);

				$idUsuario = $usuario->ultimoidinsertado();

				//rol 1 es propietario perfil de usuario
				$insert = $usuario->insertarprp(array('idUsuario'=>$idUsuario , 'idPlan' => $_POST['plan'],'idRol' => 1,'idPerfil' => 2));

				if ($insert) {
					header('Location: ../view.php?com=empresa&mod=buscar&stt=success');
				}else{
					header('Location: ../view.php?com=empresa&mod=buscar&stt=error');
				}

			}
		}
	}
}
?>