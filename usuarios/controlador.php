<?php
require('../clases/usuario.class.php');
$usuario = new usuario;
$stt="";
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
		case 'Editar':
			$array = array();

			$row = $usuario->mostrar_usuario($_POST['idUsuario']);
			
			echo "<pre>"; print_r($_POST); echo "</pre>";
			return;

			if($_POST['pass'] != ""){
				$array[''] = $_POST['pass'];
			}
			
			if ($_POST['usuario'] != $row['nombreUsuario']) {
				$array['nombreUsuario'] = $_POST['usuario'];
			}

			if ($_POST['correo'] != $row['email']) {
				$usuarioValido = $usuario->valida_usuario($_POST['correo']);
				$array['email'] = $_POST['correo'];
			}else{
				$usuarioValido = true;
			}

			//
			if( count( $array ) > 0 ){
				$array['fechaActualizacion'] = date("Y-m-d H:i:s"); 
			}

			if($usuarioValido){
				$actualiza = $usuario->actualizarusuario($array,$_POST['idUsuario']);
				if($actualiza){
					$stt = "asuccess";
				}else{
					$stt = "afailed";
				}
			}else{
				$stt = "unv";
			}
			header('Location: ../view.php?com=usuarios&mod=listar&stt='.$stt);
			break;
		default:
			header('Location: ../view.php?com=usuarios&mod=form&ac=nuevo&stt=error');
			break;
	}
}else{
	header('Location: ../view.php?mod=notfound');
}
?>