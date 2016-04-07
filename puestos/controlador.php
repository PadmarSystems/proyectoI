<?php
require('../clases/empresa.class.php');
$objPuesto = new empresas;
# $idEmp = $_SESSION['empresa']; // 
$idEmp = '1';

if(isset($_POST)){
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			#$dCreate = date('Y-m-d');
			if ( !empty($_POST['puesto2'] )){
				$puestos=array($_POST['puesto1'],$_POST['puesto2']);
			} else {
				$puestos=array($_POST['puesto1']);
			}
			foreach($puestos as $pues){
				$saveArray=array(
					$idEmp, /***/
					$pues
				);
				echo "<pre>"; print_r($saveArray); echo "</pre>";
				// guardar saveArray // $objPuesto->nuevoPuesto($saveArray)
			}
			header('Location: ../view.php?com=puestos&mod=form&ac=nuevo&stt=success');
		break;
		case 'Editar';
			$nomPuesto = 'Programador Web'; // $nomPuesto = $objPuesto->verPuestoxID(...); $nomPuesto=$nomPuesto[0]['nombrePuesto'];
			if($_POST['nombreNuevo'] == $nomPuesto){
				echo "igual";
				header('Location: ../view.php?com=puestos&mod=form&ac=editar&stt=nochng');
			} else {
				$saveArray=array(
					$_POST['nombreNuevo'],
					$_POST['idP']
				);
				echo "<pre>"; print_r($saveArray); echo "</pre>";
				# guardar saveArray (alias, fechaActualizacion) // $objPuesto->$nomPuesto($saveArray);
				header('Location: ../view.php?com=puestos&mod=form&ac=editar&stt=success');
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