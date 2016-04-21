<?php
require('../clases/ubicacion.class.php');
$objUbic = new ubicacion;

if(isset($_POST)){
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
					'nombreUbicacion'=>$ubc
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
				$array = array('nombreUbicacion'=>$_POST['nombreNuevo'],'fechaActualizacion'=>date("Y-m-d H:i:s"));
				$actualizacion = $objUbic->actualizarUbicacionarray( $array, $_POST['idU'] );
				if ($actualizacion){
					echo "ya";
					header('Location: ../view.php?com=ubicaciones&mod=form&ac=editar&stt=success');
				} else {
					echo "no guardó";
					header('Location: ../view.php?com=ubicaciones&mod=form&ac=editar&stt=error');
				}
			}
		break;
		case 'eliminar':
			$elimina = $objUbic->eliminarubicacion($_POST['id']);
			if($elimina){
				echo "eliminado";
			}else{
				echo "";
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