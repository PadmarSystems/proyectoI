<?php
								/****/
require('../clases/empresa.class.php');
$objempre = new empresas;

if(isset($_POST)){
	print_r($_POST);
	# con id, buscar alias
	# $alias[0]['aliasEmpresa];
	$alias = 'Ejemplo Empresa';
	if($_POST['nombreNuevo'] == $alias){
		header('Location: ../view.php?com=empresa&mod=form&ac=editar&stt=nochng');
	} else {
		$dUpdt = date('Y-m-d');
		$saveArray=array(
			$_POST['nombreNuevo'],
			$dUpdt,
			$_POST['id']
		);
		echo "<pre>"; print_r($saveArray); echo "</pre>";
		# guardar saveArray (alias, fechaActualizacion) // $objempre->actualizarEmpresa($saveArray);
		header('Location: ../view.php?com=empresa&mod=form&ac=editar&stt=success');
	}
} else {
	header('Location: ../view.php?mod=notfound');
}
?>