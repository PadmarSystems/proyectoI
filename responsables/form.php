<?php
require('clases/empleado.class.php');
$objEmp = new empleado;

require('clases/responsable.class.php');
$responsable = new responsable;

$msg = "";
$stt = "";
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombreResponsable'=>'','idR'=>'','empresa'=>$_SESSION['idEmpresa'],'accion'=>'Registrar');
	}elseif ($_GET['ac']=="editar") {
		$row = $responsable->mostrar_responsable($_GET['id']);
		$form = array('nombreResponsable'=>$row['nombreResponsable'],'idR'=>$row['idResponsable'],'empresa'=>$row['idEmpresa'],'accion'=>'Editar');
	} else {
		header('Location: view.php?com=responsables&mod=form&ac=nuevo&stt=error');
	}
} else {
	header('Location: view.php?mod=notfound');
}

if (isset($_GET['stt'])) {
	$stt = $_GET['stt'];
	if ($stt == "error") {
		$msg = "No se pudo llevar a cabo la petición deseada.";
	}
	if ($stt == "success") {
		$msg="El responsable fue agregado correctamente.";
	}
	if ($stt == "nochng") {
		$msg="No se detectaron cambios en el nombre del responsable.";
	}
}
?>
<h1><?php echo $form['accion']; ?> responsable</h1>
<script src="js/validacion.js"></script>
<div class="row">
	<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
	<form action="responsables/controlador.php" method="post" class="col-md-8 group" onsubmit="return validResp();">
	<?php
	switch ($form['accion']) {
		case 'Registrar':
			?>
			<p>Si quiere asignar como responsable a un empleado registrado, búsquelo en la lista. Si no lo encuentra, puede agregarlo.</p>
			<div class="row">
				<label class="col-md-4">Seleccione un responsable: </label>
				<div class="col-md-8">
					<select id="responsableSel" name="responsableSel" required>
					<option value="0">Nuevo responsable</option>
					<?php
						$lista = $objEmp->verEmpleados($_SESSION['idEmpresa']);
						foreach ($lista as $val){
							$fName=explode("--",$val['nombreEmp']);
							$fName=$fName[0].' '.$fName[1].' '.$fName[2];
							echo '
							<option value="'.$val['idEmpleado'].'">'.$fName.'</option>
							';
						}
					?>
					</select>
				</div>
			</div>
			<div class="row">
				<label class="col-md-4">Nombre del responsable: </label>
				<div class="col-md-8"><input type="text" id="responsableN" name="responsableN"/></div>
			</div>
			<?php
		break;
		case 'Editar':
			?>
			<div class="row">
				<label class="col-md-4">Nombre del responsable: </label>
				<div class="col-md-8"><label id="responsable" name="resposable"><?php echo $form['nombreResponsable']; ?></label></div>
			</div>
			<div class="row">
				<label class="col-md-4">Nuevo nombre del responsable: </label>
				<div class="col-md-8"><input type="text" id="nombreNuevo" name="nombreNuevo" required /></div>
				<input type="hidden" id="idR" name="idR" value="<?php echo $form['idR']; ?>"/>
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
