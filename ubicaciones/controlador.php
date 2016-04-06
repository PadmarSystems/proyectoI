<?php
require('../clases/ubicacion.class.php');
$objUbic = new ubicaciones;
# $idEmp = $_SESSION['empresa']; // 

if(isset($_POST)){
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			#$dCreate = date('Y-m-d');
			if ( !empty($_POST['ubicacion2']) && !empty($_POST['ubicacion3']) ){
				$ubicaciones=array($_POST['ubicacion1'],$_POST['ubicacion2'],$_POST['ubicacion3']);
			} elseif ( !empty($_POST['ubicacion2']) && empty($_POST['ubicacion3']) ){
				$ubicaciones=array($_POST['ubicacion1'],$_POST['ubicacion2']);
			} elseif ( !empty($_POST['ubicacion3']) && empty($_POST['ubicacion2']) ){
				$ubicaciones=array($_POST['ubicacion1'],$_POST['ubicacion3']);
			} elseif ( empty($_POST['ubicacion2']) && empty($_POST['ubicacion3']) ){
				$ubicaciones=array($_POST['ubicacion1']);
			}
			foreach($ubicaciones as $ubc){
				$saveArray=array(
					$idEmp, /***/
					$ubc
					//$dCreate
				);
				echo "<pre>"; print_r($saveArray); echo "</pre>";
				// guardar saveArray // $objUbic->nuevaUbicacion(...)
			}
			header('Location: ../view.php?com=ubicaciones&mod=form&ac=nuevo&stt=success');
		break;
		case 'Editar';
			$nomUbicacion = 'PS Col. Aurora';
			if($_POST['nombreNuevo'] == $nomUbicacion){
				echo "igual";
				header('Location: ../view.php?com=ubicaciones&mod=form&ac=editar&stt=nochng');
			} else {
				$saveArray=array(
					$_POST['nombreNuevo'],
					$_POST['idU']
				);
				echo "<pre>"; print_r($saveArray); echo "</pre>";
				# guardar saveArray (alias, fechaActualizacion) // $objUbic->actualizarUbicacion($saveArray);
				header('Location: ../view.php?com=ubicaciones&mod=form&ac=editar&stt=success');
			}
		break;
		default:
			header('Location: ../view.php?com=ubicaciones&mod=form&ac=nuevo&stt=error');
		break;
	}
} else {
	header('Location: ../view.php?mod=notfound');
}
?>