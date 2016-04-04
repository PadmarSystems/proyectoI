<?php
require('../clases/usuario.class.php');
$usuario = new usuario;

if(isset($_POST['a'])){
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			print_r($_POST);
			/*

			*/
			$usuarioValido = $usuario->valida_usuario($_POST['usuario']);
			return;
			$array = array();
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