<?php
require('clases/empleado.class.php');
$empobj = new empleado;
$msg = "";
$stt = "";

if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombre'=>'----','empresa'=>'','correo'=>'','telefono'=>'','responsable'=>'','ubicacion'=>'','puesto'=>'','clave'=>'','accion'=>'Registrar');
		$name = explode('--', $form['nombre']);
		$nombre = $name[0];
		$apePaterno = $name[1];
		$apeMaterno = $name[2];
	}elseif ($_GET['ac']=="editar") {
		//obtener id
		//arreglo prueba:
		$form = array('nombre'=>'Nombre 1--Apellido Uno--Apellido no. Dos','empresa'=>'100','correo'=>'empleado@dominio.com','telefono'=>'8334444444','responsable'=>'22','ubicacion'=>'33','puesto'=>'101','clave'=>'','accion'=>'');
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
	}

	if ($stt == "success") {
		$msg="El empleado fue agregado correctamente.";
	}
}
?>

<h2><?php echo $form['accion'].' empleado'; ?></h2>
<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
<form action="empleados/controlador.php" method="post">
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
		<label>Empresa: </label>
		<span>
			<!---<select id="empresaEmp" name="empresaEmp" required>
				<?php
				foreach ($empresas as $val){
					echo '<option value="'.$val['idEmpresa'].'"';
						if ($form['empresa'] == $val['idEmpresa']){ // $form
							echo ' selected="selected" ';
						}
					echo '>'.$val['aliasEmpresa'].'</option>';
				}
				?>
			</select>--->
			<input type="text" id="empresaEmp" name="empresaEmp" required value="<?php echo $form['empresa']; ?>"/>
		</span>
	</div>
	<div>
		<label>Correo electrónico*: </label>
		<div><input type="email" name="correo" id="correo" value="<?php echo $form['correo']; ?>" required /></div>
	</div>
	<div>
		<label>Teléfono: </label>
		<div><input type="text" name="telefono" id="telefono" pattern="\d{10}" value="<?php echo $form['telefono']; ?>" required /></div>
	</div>
	<div>
		<label>Responsable: </label>
		<span>
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
		</span>
	</div>
	<div>
		<label>Ubicación: </label>
		<span>
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
		</span>
	</div>
	<div>
		<label>Puesto: </label>
		<span>
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
		</span>
	</div>
	<div>
		<label></label>
		<div style="padding-top:15px;"><input type="submit" name="a" value="<?php echo $form['accion']; ?>"></div>
	</div>	
</form>
