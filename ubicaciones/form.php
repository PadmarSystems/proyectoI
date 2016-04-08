<?php
require('clases/empleado.class.php');
$objEmp = new empleado;
$msg = "";
$stt = "";
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('ubicacion'=>'','idU'=>'','empresa'=>'','accion'=>'Registrar');
	}elseif ($_GET['ac']=="editar") {
		# obtener id
		# arreglo ejemplo:
		$form = array('ubicacion'=>'prueba','idU'=>'2','empresa'=>'1','accion'=>'Editar');
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
<h2><?php echo $form['accion']; ?> ubicación</h2>
<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>

<form action="ubicaciones/controlador.php" method="post">
<?php 
switch ($form['accion']) {
	case 'Registrar':
		?>
		<p>Aquí puede agregar hasta tres ubicaciones o proyectos a la vez. Tiene que llenar por lo menos un campo.</p>
		<div>
			<label>Primera ubicación: </label>
			<div><input type="text" id="ubicacion1" name="ubicacion1" required /></div>
		</div>
		<div>
			<label>Segunda ubicación: </label>
			<div><input type="text" id="ubicacion2" name="ubicacion2"/></div>
		</div>
		<div>
			<label>Tercera ubicación: </label>
			<div><input type="text" id="ubicacion3" name="ubicacion3"/></div>
		</div>
		<?php
	break;
	case 'Editar':
		?>
		<div>
			<label>Nombre de la ubicación: </label>
			<div><label id="ubicacion"><?php echo $form['ubicacion']; ?></label></div>
		</div>
		<div>
			<label>Nuevo nombre de la ubicación: </label>
			<div><input type="text" id="nombreNuevo" name="nombreNuevo" required /></div>
			<input type="hidden" id="idU" name="idU" value="<?php echo $form['idU']; ?>"/>
		</div>
		<?php
	break;
	default:
	break;
}
?>
	<div>
		<label></label>
		<div style="padding-top:15px;">
			<input type="hidden" name="idEmp" value="<?php echo $_SESSION['idEmpresa']; ?>"/>
			<input type="button" name="back" onclick="history.back();" value="Regresar">
			<input type="submit" name="a" value="<?php echo $form['accion']; ?>">
		</div>
	</div>	
</form>
