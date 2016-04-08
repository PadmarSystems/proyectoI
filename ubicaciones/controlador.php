<?php
require('../clases/ubicacion.class.php');
$objUbic = new ubicaciones;

if(isset($_POST)){
	print_r($_POST);
	$idEmp = $_POST['idEmp'];
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			$dCreate =  date('Y-m-d H:i:s');
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
					'idEmpresa'=>$idEmp,
					'nombreUbicacion'=>$ubc,
					'fechaCreacion'=>$dCreate
				);
				echo "<pre>"; print_r($saveArray); echo "</pre>";
				if ($objUbic->insertarUbicacion($saveArray)){
					echo "ya";
					header('Location: ../view.php?com=ubicaciones&mod=form&ac=nuevo&stt=success');
				} else {
					echo "no guardó";
					header('Location: ../view.php?com=ubicaciones&mod=form&ac=nuevo&stt=error');
				}
			}
			
		break;
		case 'Editar';
			$nomUbicacion = $objUbic->getUbicacionxID($_POST['idU']);
			$nomUbicacion=$nomUbicacion['nombreUbicacion'];
			if($_POST['nombreNuevo'] == $nomUbicacion){
				echo "igual";
				header('Location: ../view.php?com=ubicaciones&mod=form&ac=editar&stt=nochng');
			} else {
				if ($objUbic->actualizarUbicacion( $_POST['nombreNuevo'], $_POST['idU'] )){
					echo "ya";
					header('Location: ../view.php?com=ubicaciones&mod=form&ac=editar&stt=success');
				} else {
					echo "no guardó";
					header('Location: ../view.php?com=ubicaciones&mod=form&ac=editar&stt=error');
				}
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