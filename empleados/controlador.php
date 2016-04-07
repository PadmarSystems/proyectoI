<?php
require('../clases/empleado.class.php');
$empleado = new empleado;

if(isset($_POST)){
	$accion=$_POST['a'];
	
	switch ($accion){
		case 'Registrar':
			$nombre=$_POST['nombre'].'-'.$_POST['apellidoPat'].'-'.$_POST['apellidoMat'];
			/*if(empty($_POST['responsable'])){
				$responsable = '0';
			} else {
				$responsable = $_POST['responsable'];
			}
			if(empty($_POST['ubicacion'])){
				$ubicacion = '0';
			} else {
				$ubicacion = $_POST['ubicacion'];
			}*/
			print_r($_POST);
			return;
			$saveArray=array(
				$_POST['empresaEmp'],
				$nombre,
				$_POST['telefono'],
				$_POST['correo'],
				$responsable,
				$ubicacion,
				$_POST['puesto'],
				$dCreate,
				$dUpdt
			);
			#echo "<pre>"; print_r($saveArray); echo "</pre>";
			// guardar saveArray
			header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=success');
		break;
		case 'Editar';
			$dUpdt = date('Y-m-d');
			$saveArray=array(
				$_POST['empresaEmp'],
				$nombre,
				$_POST['telefono'],
				$_POST['correo'],
				$responsable,
				$ubicacion,
				$_POST['puesto'],
				$dUpdt
			);
			#echo "<pre>"; print_r($saveArray); echo "</pre>";
			// guardar saveArray sin fechaCreacion
			header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=success');
		break;
		default:
			header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=error');
		break;
	}
} else {
	header('Location: ../view.php?mod=notfound');
}
?>
