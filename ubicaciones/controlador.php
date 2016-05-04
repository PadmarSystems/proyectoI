<?php
session_start();
require('../clases/ubicacion.class.php');
$objUbic = new ubicacion;
$stt = "";
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
				//echo "<pre>"; print_r($saveArray); echo "</pre>";
				if($_SESSION['plan'] == 1){
					$where = "WHERE idEmpresa= " . $_SESSION['idEmpresa'];
					$ubicacionesnum = $objUbic->mostrar_ubicaciones('*',$where);
					if (count($ubicacionesnum) >= 2) {
						$stt = "limit-user";
						header('Location: ../view.php?com=puestos&mod=form&ac=nuevo&stt='.$stt);
					}
				}

				if ($objUbic->insertarUbicacion($saveArray)){
					$stt = "success";
				} else {
					$stt="error";
				}
			}
			header('Location: ../view.php?com=ubicaciones&mod=form&ac=nuevo&stt='.$stt);
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