<?php
require('../clases/responsable.class.php');
require('../clases/empleado.class.php');
$objRes = new responsable;
$objEmp = new empleado;
$idEmp = $_POST['idEmp'];
print_r($_POST);
echo "<br>";
if(isset($_POST)){
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			$dCreate = date('Y-m-d H:i:s');
			if ( $_POST['responsableSel'] == '0' || $_POST['responsableSel'] == 0){
				if ( $_POST['responsableN'] == ''){
					echo "eligió 'nuevo' y no agregó responsables.";
					header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=error1');
				} else {
					$saveArray = array('idEmpresa'=>$idEmp,'nombreResponsable'=>$_POST['responsableN']);
					echo "<pre>"; print_r($saveArray); echo "</pre>";
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
				echo "<pre>"; print_r($saveArray); echo "</pre>";
				if ($objRes->insertarResponsable($saveArray)){
					header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=success');
				} else {
					header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=error');
				}
			}
		break;
		case 'Editar';
			$nomResponsable = $objRes->verResponsablexID($_POST['idR']);
			$nomResponsable=$nomResponsable['nombreResponsable'];
			if($_POST['nombreNuevo'] == $nomResponsable){
				echo "igual";
				header('Location: ../view.php?com=responsables&mod=form&ac=editar&stt=nochng');
			} else {
				if ($objRes->actualizarResponsable($_POST['nombreNuevo'],$_POST['idR'])){
					header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=success');
				} else {
					header('Location: ../view.php?com=responsables&mod=form&ac=nuevo&stt=error');
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