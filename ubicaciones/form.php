<?php
require('clases/ubicacion.class.php');
$ubicacion = new ubicacion;
$msg = "";
$stt = "";
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('ubicacion'=>'','idU'=>'','empresa'=>'','accion'=>'Registrar');
	}elseif ($_GET['ac']=="editar") {
		$row = $ubicacion->mostrar_ubicacion($_GET['id']);
		$form = array('ubicacion'=>$row['nombreUbicacion'],'idU'=>$row['idUbicacion'],'empresa'=>$row['idEmpresa'],'accion'=>'Editar');
	}else{
		header('Location: view.php?com=ubicaciones&mod=form&ac=nuevo&stt=error');
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
		$msg="La ubicación fue agregada correctamente.";
	}
	if ($stt == "nochng") {
		$msg="No se detectaron cambios en el nombre de la ubicación.";
	}
}

?>
<h1><?php echo $form['accion']; ?> ubicación</h1>
<script src="js/validacion.js"></script>
<div class="row">
	<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
	<form action="ubicaciones/controlador.php" method="post" class="col-md-8 group" onsubmit="return validUbic();">
	<?php
	switch ($form['accion']) {
		case 'Registrar':
			?>
			<p>Aquí puede agregar hasta tres ubicaciones o proyectos a la vez. Tiene que llenar por lo menos un campo.</p>
			<div class="row">
				<label class="col-md-4">Primera ubicación: </label>
				<div class="col-md-8"><input type="text" id="ubicacion1" name="ubicacion1" required /></div>
			</div>
			<div class="row">
				<label class="col-md-4">Segunda ubicación: </label>
				<div class="col-md-8"><input type="text" id="ubicacion2" name="ubicacion2"/></div>
			</div>
			<div class="row">
				<label class="col-md-4">Tercera ubicación: </label>
				<div class="col-md-8"><input type="text" id="ubicacion3" name="ubicacion3"/></div>
			</div>
			<?php
		break;
		case 'Editar':
			?>
			<div class="row">
				<label class="col-md-4">Nombre de la ubicación: </label>
				<div class="col-md-8"><label id="ubicacion"><?php echo $form['ubicacion']; ?></label></div>
			</div>
			<div class="row">
				<label class="col-md-4">Nuevo nombre de la ubicación: </label>
				<div class="col-md-8"><input type="text" id="nombreNuevo" name="nombreNuevo" required /></div>
				<input type="hidden" id="idU" name="idU" value="<?php echo $form['idU']; ?>"/>
			</div>
			<?php
		break;
		default:
		break;
	}
	?>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<input type="hidden" name="idEmp" value="<?php echo $_SESSION['idEmpresa']; ?>"/>
				<input type="submit" name="a" value="<?php echo $form['accion']; ?>">
			</div>
			<div class="col-md-4">
				<input type="button" name="back" onclick="history.back();" value="Regresar">
			</div>
		</div>
	</form>
</div>