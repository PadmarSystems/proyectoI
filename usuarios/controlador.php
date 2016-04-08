<?php
require('../clases/usuario.class.php');
$usuario = new usuario;

if(isset($_POST['a'])){
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			$usuarioValido = $usuario->valida_usuario($_POST['correo']);
			if($usuarioValido){
				$array = array('idEmpresa'=>$_POST['empresa'],'nombreUsuario'=>$_POST['usuario'],'email'=>$_POST['correo'],'contrasena'=>$usuario->encriptaPass($_POST['pass']));
				$inserta = $usuario->insertarusuario($array);
				if($inserta){
					header('Location: ../view.php?com=usuarios&mod=form&ac=nuevo&stt=csuccess');
				}else{
					header('Location: ../view.php?com=usuarios&mod=form&ac=nuevo&stt=cfailed');
				}	
			}else{
				header('Location: ../view.php?com=usuarios&mod=form&ac=nuevo&stt=nvuser');
			}
			
			header('Location: ../view.php?com=usuarios&mod=form&ac=nuevo&stt=success');
			break;
		default:
			header('Location: ../view.php?com=usuarios&mod=form&ac=nuevo&stt=error');
			break;
	}
}else{
	header('Location: ../view.php?mod=notfound');
}
?>