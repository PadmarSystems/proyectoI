<?php
session_start();
require('../clases/puesto.class.php');
$objPuesto = new puesto;
$idEmp = $_POST['idEmp'];
$stt = "";
if(isset($_POST)){
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			$dCreate = date('Y-m-d H:i:s');
			if ( !empty($_POST['puesto2'] )){
				$puestos=array($_POST['puesto1'],$_POST['puesto2']);
			} else {
				$puestos=array($_POST['puesto1']);
			}
			foreach($puestos as $pues){
				$saveArray=array(
					'idEmpresa'=>$idEmp,
					'nombrePuesto'=>$pues
				);
				if($_SESSION['plan'] == 1){
					$where = "WHERE puestos.idEmpresa= " . $_SESSION['idEmpresa'];
					$puestosnum = $objPuesto->mostrar_puestos('puestos.*,nombreEmpresa',$where);
					if (count($puestosnum) >= 3) {
						$stt = "limit-user";
						header('Location: ../view.php?com=puestos&mod=form&ac=nuevo&stt='.$stt);
					}
				}

				if ($objPuesto->nuevoPuesto($saveArray)){
					$stt = "success";
				} else {
					$stt = "error";	
				}
			}
			header('Location: ../view.php?com=puestos&mod=form&ac=nuevo&stt='.$stt);
		break;
		case 'Editar';
			$nomPuesto = $objPuesto->verPuestoxID($_POST['idP']);
			$nomPuesto=$nomPuesto['nombrePuesto'];
			if($_POST['nombreNuevo'] == $nomPuesto){
				echo "igual";
				header('Location: ../view.php?com=puestos&mod=form&ac=editar&stt=nochng');
			} else {
				$array = array('nombrePuesto'=>$_POST['nombreNuevo'],'fechaActualizacion'=>date("Y-m-d H:i:s"));
				$actualizar = $objPuesto->actualizarPuestoarray($array,$_POST['idP']);
				if ($actualizar){
					echo "guardó info";
					header('Location: ../view.php?com=puestos&mod=form&ac=editar&stt=success');
				} else {
					echo "no guardó";
					header('Location: ../view.php?com=puestos&mod=form&ac=nuevo&stt=error');
				}
			}
		break;
		case 'eliminar':
			$elimina = $objPuesto->eliminarpuesto($_POST['id']);
			if($elimina){
				echo "eliminado";
			}else{
				echo "";
			}
		break;
		default:
			header('Location: ../view.php?com=puestos&mod=form&ac=nuevo&stt=error');
		break;
	}
} else {
	header('Location: ../view.php?mod=notfound');
}
?>