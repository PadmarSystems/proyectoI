<?php
require('../clases/empleado.class.php');
$objemp = new empleado;
$idEmp = '1'; // =$_SESSION['empresa'];

if(isset($_POST)){
	$accion=$_POST['a'];
	$nombre=$_POST['nombre'].'--'.$_POST['apellidoPat'].'--'.$_POST['apellidoMat'];
	if(empty($_POST['responsable'])){
		$responsable = '0';
	} else {
		$responsable = $_POST['responsable'];
	}
	if(empty($_POST['ubicacion'])){
		$ubicacion = '0';
	} else {
		$ubicacion = $_POST['ubicacion'];
	}
	if(empty($_POST['nombreAa'])){
		$nombreAa = '0';
	} else {
		$nombreAa = $_POST['nombreAa'];
	}
	if(empty($_POST['telefonoAa'])){
		$telefonoAa = '0';
	} else {
		$telefonoAa = $_POST['telefonoAa'];
	}
	$fileProcess = 'FALSE';
	$load="true"; //flag
	if ( $accion == 'Registrar' ){
		if ($_FILES['foto']['error'] != 4 OR $_FILES['foto']['error'] != '4'){
			$fileProcess = 'TRUE';
		} else {
			$fileProcess = 'FALSE';
			$rutaFoto = 0;
		}
	} elseif ( $accion =='Editar' ){
		if ($_FILES['foto']['error'] != 4 OR $_FILES['foto']['error'] != '4'){
			$fileProcess = 'TRUE';
		} else {
			$fileProcess = 'FALSE';
			if ( empty($_POST['fotoActual']) ){
				$rutaFoto = 0;
			} else {
				$rutaFoto = $_POST['fotoActual'];
			}
		}
	}
	if ($fileProcess == 'TRUE'){
		$size=$_FILES['foto']['size'];
		if ($size>200000){
			$load='false';
			echo "ñam1 tamaño";
			header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=error&img=z');
		}
		if (!($_FILES['foto']['type'] =="image/jpeg" OR $_FILES['foto']['type'] =="image/bmp" OR $_FILES['foto']['type'] =="image/gif" OR $_FILES['foto']['type'] =="image/png" )) {
			$load='false';
			echo "ñam tipo";
			header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=error&img=t');
		}
		$target_path = "files/";
		$target_path = $target_path.$_FILES['foto']['name'];
		if($load=="true"){
			if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) {
				$rutaFoto = "empleados/".$target_path;
			} else {
				header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=error');
			}
		}
	}
	if ($load == 'true'){
		switch ($accion){
			case 'Registrar':
				//$dCreate = date('Y-m-d');
				/*$saveArray=array(
					$idEmp,
					$nombre,
					$_POST['telefono'],
					$_POST['correo'],
					$_POST['tipoNomina'],
					$responsable,
					$ubicacion,
					$_POST['puesto'],
					$nombreAa,
					$telefonoAa,
					$rutaFoto
				);*/
				echo "<pre>"; print_r($_POST); echo "</pre>";
				// guardar saveArray
				//header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=success');
			break;
			case 'Editar';
				$saveArray=array(
					$idEmp,
					$nombre,
					$_POST['telefono'],
					$_POST['correo'],
					$_POST['tipoNomina'],
					$responsable,
					$ubicacion,
					$_POST['puesto'],
					$rutaFoto
				);
				echo "<pre>"; print_r($saveArray); echo "</pre>".$rutaFoto;
				// guardar saveArray sin fechaCreacion
				header('Location: ../view.php?com=empleados&mod=form&ac=editar&stt=success');
			break;
			default:
				header('Location: ../view.php?com=empleados&mod=form&ac=editar&stt=error');
			break;
		}
	}
}else {
	header('Location: ../view.php?mod=notfound');
}
?>
