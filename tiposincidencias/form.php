<?php
require('clases/incidencia.class.php');

$incidencia = new incidencia;

$msg = "";
$stt = "";

if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('idTipo'=>'','tipo'=>'' , 'accion'=>'Registrar');
	}elseif ($_GET['ac']=="editar") {
		//obtener id
		$row = $incidencia->mostrar_tipo_incidencia($_GET['id']);
		$form = array('idTipo'=>$row['idTipo'],'tipo'=>$row['tipoIncidencia']);
		$form['accion']="Editar";
	}else{
		header('Location: view.php?com=usuarios&mod=form&ac=nuevo&stt=error');
	}
}else{
	header('Location: view.php?mod=notfound');
}

if (isset($_GET['stt'])) {
	$stt = $_GET['stt'];
	if ($stt == "error") {
		$msg = "No se pudo llevar a cabo la peticion deseada.";
	}

	if ($stt == "created") {
		$msg="El tipo de incidencia fue agregado correctamente.";
	}
}
?>
<script src="js/validacion.js"></script>
<h1><?php echo $form['accion'] ?> tipo de incidencia</h1>
<div class="row">
	<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
	<form action="tiposincidencias/controlador.php" method="post" class="col-md-8 group" onsubmit="return validTipo();">
		<div class="row">
			<label class="col-md-4">Tipo de incidencia:</label>
			<div class="col-md-8"><input type="text" name="tipo" id="tipo" value="<?php echo $form['tipo']; ?>"></div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-4">
			<?php if($_GET['ac']=="editar"){ ?>
			<input type="hidden" id="idTipo" name="idTipo" value="<?php echo $form['idTipo']; ?>" required readonly />
			<?php } ?>
			<input type="submit" name="a" value="<?php echo $form['accion']; ?>">
			</div>
		</div>
	</form>
</div>
