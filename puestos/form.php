<?php
require('clases/puesto.class.php');
$puesto = new puesto;
$msg = "";
$stt = "";
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('puesto'=>'','idP'=>'','empresa'=>$_SESSION['idEmpresa'],'accion'=>'Registrar');
	}elseif ($_GET['ac']=="editar") {
		$row = $puesto->mostrar_puesto($_GET['id']);
		$form = array('puesto'=>$row['nombrePuesto'],'idP'=>$row['idPuesto'],'empresa'=>$row['idEmpresa'],'accion'=>'Editar');
	}else{
		header('Location: view.php?com=puestos&mod=form&ac=nuevo&stt=error');
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
		$msg="El puesto fue agregado correctamente.";
	}
	if ($stt == "nochng") {
		$msg="No se detectaron cambios en el nombre del puesto.";
	}
}
?>
<h1><?php echo $form['accion']; ?> Puesto</h1>
<script src="js/validacion.js"></script>
<div class="row">
	<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
	<form action="puestos/controlador.php" method="post" class="col-md-8 group" onsubmit="return validPuesto()">
	<?php
	switch ($form['accion']) {
		case 'Registrar':
			?>
			<p>Aquí puede agregar dos puestos a la vez. Tiene que llenar por lo menos un campo.</p>
			<div class="row">
				<label class="col-md-4">Primer puesto: </label>
				<div class="col-md-8"><input type="text" id="puesto1" name="puesto1" required /></div>
			</div>
			<div class="row">
				<label class="col-md-4">Segundo puesto: </label>
				<div class="col-md-8"><input type="text" id="puesto2" name="puesto2"/></div>
			</div>
			<?php
		break;
		case 'Editar':
			?>
			<div class="row">
				<label class="col-md-4">Nombre del puesto: </label>
				<div class="col-md-8"><label id="puesto" name="puesto"><?php echo $form['puesto']; ?></label></div>
			</div>
			<div class="row">
				<label class="col-md-4">Nuevo nombre del puesto: </label>
				<div class="col-md-8"><input type="text" id="nombreNuevo" name="nombreNuevo" required /></div>
				<input type="hidden" id="idP" name="idP" value="<?php echo $form['idP']; ?>"/>
			</div>
			<?php
		break;
		default:
		break;
	}
	?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<input type="hidden" name="idEmp" value="<?php echo $form['empresa']; ?>"/>
				<input type="submit" name="a" value="<?php echo $form['accion']; ?>">
			</div>
			<div class="col-md-4">
				<input type="button" onclick="history.back();" value="Regresar">
			</div>
		</div>
	</form>
</div>