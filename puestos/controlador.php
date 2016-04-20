<?php
require('../clases/puesto.class.php');
$objPuesto = new puesto;
$idEmp = $_POST['idEmp'];

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
				echo "<pre>"; print_r($saveArray); echo "</pre>";
				if ($objPuesto->nuevoPuesto($saveArray)){
					echo "guardó info";
					header('Location: ../view.php?com=puestos&mod=form&ac=nuevo&stt=success');
				} else {
					echo "no guardó";
					header('Location: ../view.php?com=puestos&mod=form&ac=nuevo&stt=error');
				}
			}
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
		default:
			header('Location: ../view.php?com=puestos&mod=form&ac=nuevo&stt=error');
		break;
	}
} else {
	header('Location: ../view.php?mod=notfound');
}
?>