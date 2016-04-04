<?php
require('../clases/empleado.class.php');
$objemp = new empleado;

if(isset($_POST['a'])){
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			print_r($_POST);
			
			header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=success');
			break;
		default:
			header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=error');
			break;
	}
}else{
	header('Location: ../view.php?mod=notfound');
}
?>