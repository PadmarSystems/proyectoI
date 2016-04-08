<?php
require('../clases/empresa.class.php');
require('../clases/ubicacion.class.php');
$objEmp = new empresa;
$objUbic = new ubicaciones;

if(isset($_POST)){
	print_r($_POST);
	$alias = $objEmp->verEmpresaxID($_POST['id']);
	$alias=$alias['aliasEmpresa'];
	echo $alias;
	if($_POST['nombreNuevo'] == $alias){
		header('Location: ../view.php?com=empresa&mod=form&ac=editar&stt=nochng');
	} else {
		$upd = $objEmp->actualizarEmpresa($_POST['nombreNuevo'],$_POST['id']);
		if ($upd){
			$ubicArray=array(
				'idEmpresa'=>$_POST['id'],
				'nombreUbicacion'=>$_POST['nombreNuevo'],
				'fechaCreacion'=>date('Y-m-d H:i:s')
			);
			$objUbic->insertarUbicacion($ubicArray);
			header('Location: ../view.php?com=empresa&mod=form&ac=editar&stt=success');
		}
	}
} else {
	header('Location: ../view.php?mod=notfound');
}
?>