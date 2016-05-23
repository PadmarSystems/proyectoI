<?php
require('clases/empresa.class.php');
$objEmp = new empresa;
$msg = "";
$stt = "";

if (isset($_GET['ac'])) {
	if ($_GET['ac']=="editar") {
		$idEmpresa = $_SESSION['idEmpresa'];
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
<h1>Cambiar nombre de mi empresa</h1>
<script src="js/validacion.js"></script>
<div class="row">
	<p class="<?php echo $stt; ?>"><?php echo $msg; ?></p>
	<form action="empresa/controlador.php" method="post" class="col-md-8 group" onsubmit="return validAlias();">
		<div class="row">
			<label class="col-md-4">Nombre de la empresa: </label>
			<div class="col-md-8"><label id="nombre" name="nombre"><?php echo $form['alias']?></label></div>
		</div><br>
		<div class="row">
			<label class="col-md-4">Nuevo nombre de la empresa: </label>
			<div class="col-md-8"><input type="text" id="nombreNuevo" name="nombreNuevo" required /></div>
			<input type="hidden" name="id" value="<?php echo $form['id']?>"/>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<input type="submit" name="a" value="Editar">
			</div>
			<div class="col-md-4">
				<input type="button" name="back" onclick="history.back();" value="Regresar">
			</div>
		</div>
	</form>
</div>