<?php
require('clases/empleado.class.php');
$empobj = new empleado;
$msg = "";
$stt = "";

if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombre'=>'','rfc'=>'','empresa'=>'','correo'=>'','telefono'=>'','celular'=>'','usuario'=>'','responsable'=>'','ubicacion'=>'','puesto'=>'','clave'=>'','accion'=>'Registrar');
	}elseif ($_GET['ac']=="editar") {
		//obtener id
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
	}

	if ($stt == "success") {
		$msg="El empleado fue agregado correctamente.";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
	<head>
		<title>Empleado</title>
	</head>
	<body>
		<h1>Empleados</h1>
		<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
		<form action="empleados/controlador.php" method="post">
			<p>Datos personales</p>
			<div>
				<label>Nombre completo: </label>
				<div><input type="text" name="nombre" id="nombre" value="<?php echo $form['nombre']; ?>" required /></div>
			</div>
			<div>
				<label>RFC: </label>
				<div><input type="text" name="rfc" id="rfc" pattern="^(([A-Z]|[a-z]){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))" value="<?php echo $form['rfc']; ?>" required /></div>
			</div>
			<div>
				<label>Empresa: </label>
				<span>
					<!---<select id="empresaEmp" name="empresaEmp" required></select>--->
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
				<label>Celular: </label>
				<div><input type="text" name="celular" id="celular" pattern="\d{10}" value="<?php echo $form['celular']; ?>" required/></div>
			</div>
			<div>
				<label>Responsable: </label>
				<span>
					<!--- <select id="responsable" name="responsable" required></select> --->
					<input type="text" id="responsable" name="responsable" required value="<?php echo $form['responsable']; ?>"/>
				</span>
			</div>
			<div>
				<label>Ubicación: </label>
				<span>
					<!---<select id="ubicacion" name="ubicacion" required></select>--->
					<input type="text" id="ubicacion" name="ubicacion" required value="<?php echo $form['ubicacion']; ?>"/>
				</span>
			</div>
			<div>
				<label>Puesto: </label>
				<span>
					<!---<select id="puesto" name="puesto" required></select>--->
					<input type="text" id="puesto" name="puesto" required value="<?php echo $form['puesto']; ?>"/>
				</span>
			</div>
			<div>
				<label></label>
				<div style="padding-top:15px;"><input type="submit" name="a" value="<?php echo $form['accion']; ?>"></div>
			</div>	
		</form>
	</body>
</html>
