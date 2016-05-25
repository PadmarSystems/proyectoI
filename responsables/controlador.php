<?php
require('../clases/responsable.class.php');
require('../clases/empleado.class.php');
$objRes = new responsable;
$objEmp = new empleado;
$idEmp = $_POST['idEmp'];

if(isset($_POST)){
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			$dCreate = date('Y-m-d H:i:s');
			if ( $_POST['responsableSel'] == '0' || $_POST['responsableSel'] == 0){
				if ($_POST['responsableNm'] == ''){
					header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=error');
				} else {
					print_r($_POST);
					$nombre = $_POST['responsableNm'].'--'.$_POST['responsableApP'].'--'.$_POST['responsableApM'];
					echo $nombre;
					$saveArray = array('idEmpresa'=>$idEmp,'nombreResponsable'=>$nombre);
					echo "<pre>"; print_r($saveArray); echo "</pre>";
					if($_SESSION['plan'] == 1){
						$where = "WHERE idEmpresa= ".$_SESSION['idEmpresa']." ";
						$responsablesnum = $objRes->mostrar_responsables('*',$where);
						if (count($responsablesnum) >= 2) {
							$stt = "limit-user";
							header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt='.$stt);
						}
					}
					if ($objRes->insertarResponsable($saveArray)){
						header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=success');
					} else {
						header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=error');
					}
				}
			} else {
				$nameEmp = $objEmp -> verEmpleadoxID($_POST['responsableSel']);
				echo $nameEmp['nombreEmp'];
				$saveArray = array('idEmpresa'=>$idEmp,'nombreResponsable'=>$nameEmp['nombreEmp']);
				//echo "<pre>"; print_r($saveArray); echo "</pre>";
				if($_SESSION['plan'] == 1){
					$where = "WHERE idEmpresa= " . $_SESSION['idEmpresa'] . " ";
					$responsablesnum = $objRes->mostrar_responsables('*',$where);
					if (count($responsablesnum) >= 2) {
						$stt = "limit-user";
						header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt='.$stt);
					}
				}
				if ($objRes->insertarResponsable($saveArray)){
					header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=success');
				} else {
					header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=error');
				}
			}
		break;
		case 'Editar';
			$nomResponsable = $objRes->verResponsablexID($_POST['idR']);
			$nombre = $_POST['nombreNuevo'].'--'.$_POST['ApPnuevo'].'--'.$_POST['ApMnuevo'];
			$nomResponsable=$nomResponsable['nombreResponsable'];
		print_r($_POST);
			if($nombre == $nomResponsable){
				header('Location: ../view.php?com=responsables&mod=form&ac=editar&id='.$_POST['idR'].'&stt=nochng');
			} else {
				$array = array('nombreResponsable'=>$nombre,'fechaActualizacion'=>date("Y-m-d H:i:s"));
				print_r($array);
				$actualiza = $objRes->actualizarResponsablearray($array,$_POST['idR']);
				if ($actualiza){
					header('Location: ../view.php?com=responsables&mod=form&ac=editar&id='.$_POST['idR'].'&stt=success');
				} else {
					header('Location: ../view.php?com=responsables&mod=form&ac=editar&id='.$_POST['idR'].'&stt=error');
				}
			}
		break;
		case 'eliminar':
			$elimina = $objRes->eliminarresponsable($_POST['id']);
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