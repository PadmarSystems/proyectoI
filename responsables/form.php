<?php
require('clases/empleado.class.php');
$objEmp = new empleado;

require('clases/responsable.class.php');
$responsable = new responsable;

$msg = "";
$stt = "";
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombreResponsable'=>'Empleado Responsable 1','idR'=>'1','empresa'=>'1','accion'=>'Registrar');
	}elseif ($_GET['ac']=="editar") {
				# obtener id
		$row = $responsable->mostrar_responsable($_GET['id']);
		$form = array('nombreResponsable'=>$row['nombreResponsable'],'idR'=>$row['idResponsable'],'empresa'=>$row['idEmpresa'],'accion'=>'Editar');
	}else{
		header('Location: view.php?com=responsables&mod=form&ac=nuevo&stt=error');
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
		$msg="El responsable fue agregado correctamente.";
	}
	if ($stt == "nochng") {
		$msg="No se detectaron cambios en el nombre del responsable.";
	}
}
?>
<h2><?php echo $form['accion']; ?> responsable</h2>
<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>

<form action="responsables/controlador.php" method="post">
<?php
switch ($form['accion']) {
	case 'Registrar':
		?>
		<p>Si el empleado al que quiere asignar como responsable ya está dado de alta, búsquelo en la lista. Si no lo encuentra, puede agregarlo.</p>
		<div>
			<label>Seleccione un responsable: </label>
			<div><select id="responsableSel" name="responsableSel" required>
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
			</select></div>
		</div>
		<div>
			<label>Nombre del responsable: </label>
			<div><input type="text" id="responsableN" name="responsableN"/></div>
		</div>
		<?php
	break;
	case 'Editar':
		?>
		<div>
			<label>Nombre del responsable: </label>
			<div><label id="responsable" name="resposable"><?php echo $form['nombreResponsable']; ?></label></div>
		</div>
		<div>
			<label>Nuevo nombre del responsable: </label>
			<div><input type="text" id="nombreNuevo" name="nombreNuevo" required /></div>
			<input type="hidden" id="idR" name="idR" value="<?php echo $form['idR']; ?>"/>
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