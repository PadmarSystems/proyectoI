<?php
require('clases/empleado.class.php');
$empobj = new empleado;
$msg = "";
$stt = "";

if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombre'=>'----','correo'=>'','telefono'=>'','nomina'=>'','responsable'=>'','ubicacion'=>'','puesto'=>'','nombreAa'=>'','telAa'=>'','fotoEmp'=>'','accion'=>'Registrar');
		$name = explode('--', $form['nombre']);
		$nombre = $name[0];
		$apePaterno = $name[1];
		$apeMaterno = $name[2];
	}elseif ($_GET['ac']=="editar") {
		//obtener id
		//arreglo prueba:
		$form = array('nombre'=>'Empleado--de Prueba--no. 1','correo'=>'empleado@prueba.com','telefono'=>'8331001122','nomina'=>'2','responsable'=>'11','ubicacion'=>'10','puesto'=>'1','nombreAa'=>'Aa Nombre Comp','telAa'=>'8332998877','fotoEmp'=>'empleados/files/tstFile.jpg','accion'=>'');
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
		<label>Fotografía de empleado: </label>
		<div>
			<input type="file" id="foto" name="foto"/>
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
		<label><b>*</b> Nombre: </label>
		<div><input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" required /></div>
	</div>
	<div>
		<label><b>*</b> Apellido Paterno: </label>
		<div><input type="text" id="apellidoPat" name="apellidoPat" value="<?php echo $apePaterno; ?>" required /></div>
	</div>
	<div>
		<label><b>*</b> Apellido Materno: </label>
		<div><input type="text" id="apellidoMat" name="apellidoMat" value="<?php echo $apeMaterno; ?>" required /></div>
	</div>
	<div>
		<label><b>*</b> Correo electrónico: </label>
		<div><input type="email" name="correo" id="correo" value="<?php echo $form['correo']; ?>" required /></div>
	</div>
	<div>
		<label><b>*</b> Teléfono: </label>
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
		<div>
			<!--- <select id="responsable" name="responsable">
				<?php
				foreach ($responsable as $val){
					echo '<option value="'.$val['idResponsable'].'"';
						if ($form['responsable'] == $val['idResponsable']){ // $form
							echo ' selected="selected" ';
						}
					echo '>'.$val['nombreResponsable'].'</option>';
				}
				?>
			</select>--->
			<input type="text" id="responsable" name="responsable" value="<?php echo $form['responsable']; ?>"/>
		</div>
	</div>
	<div>
		<label>Ubicación: </label>
		<div>
			<!---<select id="ubicacion" name="ubicacion" >
				<?php
				foreach ($ubicacion as $val){
					echo '<option value="'.$val['idUbicacion'].'"';
						if ($form['ubicacion'] == $val['idUbicacion']){
							echo ' selected="selected" ';
						}
					echo '>'.$val['nombreUbicacion'].'</option>';
				}
				?>
			</select>--->
			<input type="text" id="ubicacion" name="ubicacion" value="<?php echo $form['ubicacion']; ?>"/>
		</div>
	</div>
	<div>
		<label><b>*</b> Puesto: </label>
		<div>
			<!---
				<select id="puesto" name="puesto" required>
				<?php
				foreach ($puesto as $val){
					echo '<option value="'.$val['idPuesto'].'"';
						if ($form['puesto'] == $val['idPuesto']){
							echo ' selected="selected" ';
						}
					echo '>'.$val['nombrePuesto'].'</option>';
				}
				?>
			</select>
				</select>--->
			<input type="text" id="puesto" name="puesto" required value="<?php echo $form['puesto']; ?>"/>
		</div>
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