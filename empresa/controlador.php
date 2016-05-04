<?php
require('../clases/empleado.class.php');
$objemp = new empleado;
$idEmp = '1'; // =$_SESSION['empresa'];
$stt = "default";
if(isset($_POST)){
	$accion=$_POST['a'];

	if($accion == "Registrar" || $accion == "Editar"){
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
				
				$empleadoValido = $objemp->valida_empleado($nombre);
				if($empleadoValido){
					$array = array('idEmpresa'=>$_POST['idEmpresaEmp'],'nombreEmp'=>$nombre,'telEmp'=>$_POST['telefono'],'emailEmp'=>$_POST['correo'],'tipoNomina'=>$_POST['tipoNomina'],'idResponsable'=>$_POST['responsable'],'idUbicacion'=>$_POST['ubicacion'],'idPuesto'=>$_POST['puesto'],'contactoAccidente'=>$_POST['nombreAa'],'numeroAccidente'=>$_POST['telefonoAa'],'fotoEmp'=>$rutaFoto);
					$inserta = $objemp->insertarempleado($array);
					if($inserta){
						$stt = "csuccess";
						//header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=csuccess');
					}else{
						$stt = "cfailded";
						//header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=cfailed');
					}	
				}else{
					$stt = "nvuser";
					//header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=nvuser');
				}
				header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt='.$stt);
				// guardar saveArray
				//header('Location: ../view.php?com=empleados&mod=form&ac=nuevo&stt=success');
			break;
			case 'Ver':
				print_r($_POST);
				header('Location: ../view.php?com=empleados&mod=form&ac=editar&id='.$_POST['idEmpleado']);
			break;
			case 'Editar';

				$array = array();

				$row = $objemp->mostrar_empleado($_POST['idEmpleado']);

				if($nombre != $row['nombreEmp']){
					$empleadoValido = $objemp->valida_empleado($nombre);
					$array['nombreEmp'] = $nombre;
				}else{
					$empleadoValido = true;
				}

				if($_POST['telefono'] != $row['telEmp']){
					$array['telEmp'] = $_POST['telefono'];
				}

				if ($_POST['correo'] != $row['emailEmp']) {
					$array['emailEmp'] = $_POST['correo'];
				}

				if($_POST['tipoNomina'] != $row['tipoNomina']){
					$array['tipoNomina'] = $_POST['tipoNomina'];
				}

				if($_POST['responsable'] != $row['idResponsable']){
					$array['idResponsable'] = $_POST['responsable'];
				}

				if($_POST['ubicacion'] != $row['idUbicacion']){
					$array['idUbicacion'] = $_POST['ubicacion'];
				}

				if($_POST['puesto'] != $row['idPuesto']){
					$array['idPuesto'] = $_POST['puesto'];
				}

				if($_POST['nombreAa'] != $row['contactoAccidente']){
					$array['contactoAccidente'] = $_POST['nombreAa'];
				}

				if($_POST['telefonoAa'] != $row['numeroAccidente']){
					$array['numeroAccidente'] = $_POST['telefonoAa'];
				}

				if($rutaFoto != $row['fotoEmp']){
					$array['fotoEmp'] = $rutaFoto;
				}

				if($empleadoValido && count($array) > 0){
					$array['fechaActualizacion'] = date("Y-m-d H:i:s");
					$actualiza = $objemp->actualizarempleado($array,$$_POST['idEmpleado']);
					if($actualiza){
						$stt = "esuccess";
					}else{
						$stt = "efailded";
					}
				}else{
					$stt = "nvuser";
				}
				
				// guardar saveArray sin fechaCreacion
				header('Location: ../view.php?com=empleados&mod=form&ac=editar&id='.$_POST['id'].'&stt='.$stt);
			break;
			case 'eliminar':
				
				$elimina = $objemp->eliminarempleado($_POST['id']);
				if($elimina){
					echo "eliminado";
				}else{
					echo "";
				}
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
