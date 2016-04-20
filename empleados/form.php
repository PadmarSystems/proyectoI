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
<h2><?php echo $form['accion'].' empleado'; ?></h2>
<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
<form action="empleados/controlador.php" enctype="multipart/form-data" method="post">
	<p>Los campos marcados con un asterisco (<b>*</b>) son obligatorios.</p>
	<div>
		<label>Nombre: </label>
		<div><input type="text" id="nombre" name="nombre" value="<?php echo $form['nombre'] ?>" required /></div>
	</div>
	<div>
		<label>Apellido Paterno: </label>
		<div><input type="text" id="apellidoPat" name="apellidoPat" value="<?php echo $form['apellidoPat']; ?>" required /></div>
	</div>
	<div>
		<label>Apellido Materno: </label>
		<div><input type="text" id="apellidoMat" name="apellidoMat" value="<?php echo $form['apellidoMat']; ?>" required /></div>
	</div>
	<div>
		<label>Fotografía de empleado: </label>
		<div>
			<input type="file" id="foto" name="foto"/>
			<input type="hidden" id="idEmpresaEmp" name="idEmpresaEmp" value="<?php echo $form['idEmpresa']; ?>" required readonly/>
		</div>

		<?php #if ($form['fotoEmp'] != ''){
			echo '
			<div>
				<img src="'.$form['fotoEmp'].'"/>
				<input type="hidden" value="'.$form['fotoEmp'].'" name="fotoActual" />
			</div>';
		#}
		?>
	</div>
	<div>
		<label>Correo electrónico: </label>
		<div><input type="email" name="correo" id="correo" value="<?php echo $form['correo']; ?>" required /></div>
	</div>
	<div>
		<label>Teléfono: </label>
		<div><input type="text" name="telefono" id="telefono" pattern="\d{10}" value="<?php echo $form['telefono']; ?>" required /></div>
	</div>
	<div>
		<label><b>*</b> Tipo de nómina: </label>
		<div><span>
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
	<div>
		<label>Responsable: </label>
		<span>
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
		</span>
	</div>
	<div>
		<label>Ubicación: </label>
		<span>
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
		</span>
	</div>
	<div>
		<label>Puesto: </label>
		<span>
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
		</span>
	</div>
	<p>¿A quén deberíamos contactar en caso de accidente?</p>
	<div>
		<label>Nombe completo: </label>
		<div><input type="text" name="nombreAa" id="nombreAa" value="<?php echo $form['nombreAa']; ?>"/></div>
	</div>
	<div>
		<label>Teléfono de contacto: </label>
		<div><input type="text" name="telefonoAa" id="telefonoAa" pattern="\d{10}" value="<?php echo $form['telAa']; ?>"/></div>
	</div>
	<div>
		<label></label>
		<?php if($_GET['ac']=="editar"){ ?>
		<input type="hidden" id="idEmpleado" name="idEmpleado" value="<?php echo $form['idEmpleado']; ?>" required readonly/>
		<?php } ?>
		<div style="padding-top:15px;"><input type="submit" name="a" value="<?php echo $form['accion']; ?>"></div>
		<input type="button" name="back" onclick="history.back();" value="Regresar">
	</div>	
</form>