<?php
require('clases/empleado.class.php');
$empleado = new empleado;

$msg = "";
$stt = "";
$responsables = $empleado->mostrar_responsables();
$ubicaciones = $empleado->mostrar_ubicaciones();
$puestos = $empleado->mostrar_puestos();
$tiposnomina = $empleado->mostrar_tiposnomina();
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombre'=>'', 'apellidoPat'=>'', 'apellidoMat'=>'','idEmpresa'=>$_SESSION['idEmpresa'],'empresa'=>$_SESSION['empresa'],'correo'=>'','telefono'=>'','tipoNomina'=>'','responsable'=>'','ubicacion'=>'','puesto'=>'','nombreAa'=>'','telAa'=>'','fotoEmp'=>'','accion'=>'Registrar');

	}elseif ($_GET['ac']=="editar") {
		//obtener id
		//arreglo prueba:
		$row = $empleado->mostrar_empleado($_GET['id']);
		$emp = explode("--", $row['nombreEmp']);

        if(!isset($emp[0])){
            $emp[0] = '';
        }

        if(!isset($emp[1])){
            $emp[1] = '';
        }

        if(!isset($emp[2])){
            $emp[2] = '';
        }
		$form = array('idEmpleado'=>$_GET['id'],'nombre'=>$emp[0], 'apellidoPat'=>$emp[1], 'apellidoMat'=>$emp[2],'idEmpresa'=>$row['idEmpresa'],'correo'=>$row['emailEmp'],'telefono'=>$row['telEmp'],'tipoNomina'=>$row['tipoNomina'],'responsable'=>$row['idResponsable'],'ubicacion'=>$row['idUbicacion'],'puesto'=>$row['idPuesto'],'nombreAa'=>$row['contactoAccidente'],'telAa'=>$row['numeroAccidente'],'fotoEmp'=>$row['fotoEmp']);
		$form['accion']="Editar";
	}else{
		header('Location: view.php?com=empleados&mod=form&ac=nuevo&stt=error');
	}
}else{
	header('Location: view.php?mod=notfound');
}

if (isset($_GET['stt'])) {
	$stt = $_GET['stt'];
	if ($stt == "error") {
		$msg = "No se pudo llevar a cabo la petición deseada.";
		if ( isset($_GET['img']) && ($_GET['img'] == 't') ){
			$msg = $msg.'<br>El archivo debe ser extensión JPG, GIF, PNG o BMP. Otros archivos no son permitidos.';
		}
		if ( isset($_GET['img']) && ($_GET['img'] == 'z') ){
			$msg = $msg.'<br>El archivo es mayor que 200KB. Reduzca la imagen o suba una más pequeña.';
		}
	}

	if ($stt == "success") {
		$msg="El empleado fue agregado correctamente.";
	}
}
?>
<h1><?php echo $form['accion'].' Empleado'; ?></h1>
<div class="row">
	<p class="<?php echo $stt; ?>"><?php echo $msg; ?></p>
	<form action="empleados/controlador.php" enctype="multipart/form-data" method="post" class="col-md-8 group">
		<p>Los campos marcados con un asterisco (<b>*</b>) son obligatorios.</p>
		<div class="row">
			<label class="col-md-4">Nombre: </label>
			<div class="col-md-8"><input type="text" id="nombre" name="nombre" value="<?php echo $form['nombre'] ?>" required /></div>
		</div>
		<div class="row">
			<label class="col-md-4">Apellido Paterno: </label>
			<div class="col-md-8"><input type="text" id="apellidoPat" name="apellidoPat" value="<?php echo $form['apellidoPat']; ?>" required /></div>
		</div>
		<div class="row">
			<label class="col-md-4">Apellido Materno: </label>
			<div class="col-md-8"><input type="text" id="apellidoMat" name="apellidoMat" value="<?php echo $form['apellidoMat']; ?>" required /></div>
		</div>
		<div class="row">
			<label class="col-md-4">Fotografía de empleado: </label>
			<div class="col-md-8">
				<input type="file" id="foto" name="foto"/>
				<input type="hidden" id="idEmpresaEmp" name="idEmpresaEmp" value="<?php echo $form['idEmpresa']; ?>" required readonly/>
			</div>
		<?php #if ($form['fotoEmp'] != '') {
			echo '<div>
					<img src="'.$form['fotoEmp'].'"/>
					<input type="hidden" value="'.$form['fotoEmp'].'" name="fotoActual" />
				</div>';
		#} ?>
		</div>
		<div class="row">
			<label class="col-md-4">Correo electrónico: </label>
			<div class="col-md-8"><input type="email" name="correo" id="correo" value="<?php echo $form['correo']; ?>" required /></div>
		</div>
		<div class="row">
			<label class="col-md-4">Teléfono: </label>
			<div class="col-md-8"><input type="text" name="telefono" id="telefono" pattern="\d{10}" value="<?php echo $form['telefono']; ?>" required /></div>
		</div>
		<div class="row">
			<label class="col-md-4"><b>*</b> Tipo de nómina: </label>
			<div class="col-md-8"><span>
				<select id="tipoNomina" name="tipoNomina" required>
					<option value="0">Seleccione</option>
					<?php 	foreach ($tiposnomina as $row) {
						$selected = "";
						if($form['tipoNomina'] == $row['idTipoNomina']){
							$selected = "selected";
						}
					?>
			            <option value="<?php echo $row['idTipoNomina']; ?>" <?php echo $selected; ?>><?php echo $row['tipoNomina']; ?></option>
			    	<?php 	}	?>
				</select>
			</span></div>
		</div>
		<div class="row">
			<label class="col-md-4">Responsable: </label>
			<div class="col-md-8">
				<select id="responsable" name="responsable">
					<option value="0">Seleccione</option>
					<?php 	foreach ($responsables as $responsable) {
						$selected = "";
						if($form['responsable'] == $responsable['idResponsable']){
							$selected = "selected";
						}
					?>
			            <option value="<?php echo $responsable['idResponsable']; ?>" <?php echo $selected; ?>><?php echo $responsable['nombreResponsable']; ?></option>
			    	<?php 	}	?>
				</select>
			</div>
		</div>
		<div class="row">
			<label class="col-md-4">Ubicación: </label>
			<div class="col-md-8">
				<select id="ubicacion" name="ubicacion" >
					<option value="0">Seleccione</option>
					<?php 	foreach ($ubicaciones as $ubicacion) {
						$selected = "";
						if($form['ubicacion'] == $ubicacion['idUbicacion']){
							$selected = "selected";
						}
					?>
			            <option value="<?php echo $ubicacion['idUbicacion']; ?>" <?php echo $selected; ?>><?php echo $ubicacion['nombreUbicacion']; ?></option>
			    	<?php 	}	?>
				</select>
			</div>
		</div>
		<div class="row">
			<label class="col-md-4">Puesto: </label>
			<div class="col-md-8">
				<select id="puesto" name="puesto">
					<option value="0">Seleccione</option>
					<?php 	foreach ($puestos as $puesto) {
						$selected = "";
						if($form['puesto'] == $puesto['idPuesto']){
							$selected = "selected";
						}
					?>
			            <option value="<?php echo $puesto['idPuesto']; ?>" <?php echo $selected; ?>><?php echo $puesto['nombrePuesto']; ?></option>
			    	<?php 	}	?>
				</select>
			</div>
		</div>
		<p>¿A quén deberíamos contactar en caso de accidente?</p>
		<div class="row">
			<label class="col-md-4">Nombe completo: </label>
			<div class="col-md-8"><input type="text" name="nombreAa" id="nombreAa" value="<?php echo $form['nombreAa']; ?>"/></div>
		</div>
		<div class="row">
			<label class="col-md-4">Teléfono de contacto: </label>
			<div class="col-md-8"><input type="text" name="telefonoAa" id="telefonoAa" pattern="\d{10}" value="<?php echo $form['telAa']; ?>"/></div>
		</div>
		<div class="row">
			<?php if($_GET['ac']=="editar"){ ?>
			<input type="hidden" id="idEmpleado" name="idEmpleado" value="<?php echo $form['idEmpleado']; ?>" required readonly/>
			<?php } ?>
			<div class="col-md-4 col-md-offset-4">
				<input type="submit" name="a" value="<?php echo $form['accion']; ?>">
			</div>
			<div class="col-md-4">
				<input type="button" name="back" onclick="history.back();" value="Regresar">
			</div>
		</div>
	</form>
</div>
