<?php
require('clases/empleado.class.php');
$empleado = new empleado;

$msg = "";
$stt = "";
$responsables = $empleado->mostrar_responsables();
$ubicaciones = $empleado->mostrar_ubicaciones();
$puestos = $empleado->mostrar_puestos();
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombre'=>'----','idEmpresa'=>$_SESSION['idEmpresa'],'empresa'=>$_SESSION['empresa'],'correo'=>'','telefono'=>'','responsable'=>'','ubicacion'=>'','puesto'=>'','clave'=>'','nombreAa'=>'','telAa'=>'','fotoEmp'=>'','accion'=>'Registrar');
		$name = explode('--', $form['nombre']);
		$nombre = $name[0];
		$apePaterno = $name[1];
		$apeMaterno = $name[2];
	}elseif ($_GET['ac']=="editar") {
		//obtener id
		//arreglo prueba:
		$form = array('nombre'=>'Nombre 1--Apellido Uno--Apellido no. Dos','idEmpresa'=>'','empresa'=>'100','correo'=>'empleado@dominio.com','telefono'=>'8334444444','responsable'=>'22','ubicacion'=>'33','puesto'=>'101','clave'=>'','nombreAa'=>'Aa Nombre Comp','telAa'=>'8332998877','fotoEmp'=>'empleados/files/tstFile.jpg','accion'=>'');
		$form['accion']="Editar";
		$name = explode('--', $form['nombre']);
		$nombre = $name[0];
		$apePaterno = $name[1];
		$apeMaterno = $name[2];
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
		<div><input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" required /></div>
	</div>
	<div>
		<label>Apellido Paterno: </label>
		<div><input type="text" id="apellidoPat" name="apellidoPat" value="<?php echo $apePaterno; ?>" required /></div>
	</div>
	<div>
		<label>Apellido Materno: </label>
		<div><input type="text" id="apellidoMat" name="apellidoMat" value="<?php echo $apeMaterno; ?>" required /></div>
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
				<option value="1">Semanal</option>
				<option value="2">Quincenal</option>
				<option value="3">Mensual</option>
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
					if($form['responsable'] == $responsable['nombreResponsable']){
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
					if($form['ubicacion'] == $ubicacion['nombreUbicacion']){
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
					if($form['ubicacion'] == $puesto['idPuesto']){
						$selected = "selected";
					}
				?>
		            <option value="<?php echo $puesto['idPuesto']; ?>" <?php echo $selected; ?>><?php echo $puesto['nombrePuesto']; ?></option>
		    	<?php 	}	?>
			</select>
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
		<div style="padding-top:15px;"><input type="submit" name="a" value="<?php echo $form['accion']; ?>"></div>
	</div>	
</form>