<?php
require('clases/incidencia.class.php');
$incidencia = new incidencia;

$msg = "Incidencia";
if (!isset($_GET['id'])) {
	$msg = "No se puede buscar la incidencia";
	return;
}
$idIncidencia= $_GET['id'];

$where = " WHERE incidencias.idIncidencia=".$idIncidencia;
$row = $incidencia->mostrar_incidencia("incidencias.*",$where);


?>
<h1><?php echo $msg; ?></h1>
<div class="row">	
	<div id="formIncidencia" class="col-md-8 group">
		<div class="row">
			<label class="col-md-4">Folio: </label>
			<div class="col-md-8"><input type="text" id="" name="" value="<?php echo $row['folio']; ?>" readonly /></div>
		</div>
		<div class="row">
			<label class="col-md-4">Empleado: </label>
			<div class="col-md-8 ui-widget">
			    <input type="text" id="" name="" value="<?php echo str_replace('--',' ',$row['nombreEmp']); ?>" readonly />
			</div>
		</div>
		<div class="row">
			<label class="col-md-4">Tipo de incidencia: </label>
			<div class="col-md-8">
				<input type="text" id="" name="" value="<?php echo $row['tipoIncidencia']; ?>" readonly />
			</div>
		</div>
		<div id="a-campos"></div>
		<div class="row">
			<label class="col-md-4">Fecha: </label>
			<div class="col-md-4">
				<input type="text" id="" name="" value="<?php echo $row['fechaInicio']; ?>" readonly />
			</div>
			
		</div>
		<!--<div class="row">
			<label class="col-md-4">Hasta: </label>
			<div class="col-md-4">
				<input type="date" name="ff_inc" >
			</div>
			<div class="col-md-4">
				<input type="time" name="hf_inc">
			</div>
		</div>-->
		<div class="row">
			<label class="col-md-4">Motivo: </label>
			<div class="col-md-8"><textarea id="" name="" readonly><?php echo $row['motivo']; ?></textarea></div>
		</div>
		
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<input type="button" onclick="goto('lista_incidencias','reportes');" value="Regresar">
			</div>
			
		</div>
		
	</div>
</div>