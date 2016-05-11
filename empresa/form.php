<?php
require('clases/empresa.class.php');
$objEmp = new empresa;
$msg = "";
$stt = "";

if (isset($_GET['ac'])) {
	if ($_GET['ac']=="editar") {
		$idEmpresa = $_SESSION['idEmpresa'];
		if(isset($_GET['id'])){
			$idEmpresa=$_GET['id'];
		}

		$nombre=$objEmp->verEmpresaxID($idEmpresa);
		$nombre=$nombre['aliasEmpresa'];
		$form = array('id'=>$idEmpresa,'alias'=>$nombre,'clave'=>'','accion'=>'Editar');
	}else{
		header('Location: view.php?com=empresa&mod=form&ac=editar&stt=error');
	}
}else{
	header('Location: view.php?mod=notfound');
}

if (isset($_GET['stt'])) {
	$stt = $_GET['stt'];
	if ($stt == "error") {
		$msg = "No se pudo llevar a cabo la petición deseada.";
	}
	if ($stt == "success") {
		$msg="Su empresa fue editada exitosamente.";
	}
	if ($stt == "nochng") {
		$msg="No se detectaron cambios en el nombre de su empresa.";
	}
}

?>
<h2>Cambiar nombre de mi empresa</h2>
<div class="row">
	<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
	<form action="empresa/controlador.php" method="post" class="col-md-8 group">
		<div class="row">
			<label class="col-md-4">Nombre actual de la empresa: </label>
			<div class="col-md-8"><label id="nombre" name="nombre"><?php echo $form['alias'] ?></label></div>
		</div>
		<div class="row">
			<label class="col-md-4">Nuevo nombre de la empresa: </label>
			<div class="col-md-8"><input type="text" id="nombreNuevo" name="nombreNuevo" required/></div>
			<input type="hidden" name="id" value="<?php echo $form['id']?>"/>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-4">
			<!--<div style="padding-top:15px;">-->
				<!--<input type="button" name="back" onclick="history.back();" value="Regresar">-->
				<input type="submit" name="a" value="Editar">
			</div>
		</div>
	</form>
</div>