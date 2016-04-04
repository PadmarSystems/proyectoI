<?php
require('clases/empleado.class.php');
$empobj = new empleado;
$msg = "";
$stt = "";

if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombre'=>'','rfc'=>'','correo'=>'','telefono'=>'','celular'=>'','usuario'=>'','clave'=>'','accion'=>'Registrar');
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
		$msg = "No se pudo llevar a cabo la peticion deseada.";
	}

	if ($stt == "success") {
		$msg="El empleado fue agregado correctamente.";
	}
}
?>

<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
<form action="empleados/controlador.php" method="post">
	<p>Datos personales</p>
	<div>
		<label>Nombre completo:</label>
		<div><input type="text" name="nombre" id="nombre" value="<?php echo $form['nombre']; ?>"></div>
	</div>
	<div>
		<label>RFC:</label>
		<div><input type="text" name="rfc" id="rfc" pattern="^(([A-Z]|[a-z]){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))" value="<?php echo $form['rfc']; ?>"></div>
	</div>
	<div>
		<label>Correo *:</label>
		<div><input type="email" name="correo" id="correo" value="<?php echo $form['correo']; ?>"></div>
	</div>
	<div>
		<label>Telefono:</label>
		<div><input type="text" name="telefono" id="telefono" pattern="\d{10}" value="<?php echo $form['telefono']; ?>"></div>
	</div>
	<div>
		<label>Celular:</label>
		<div><input type="text" name="celular" id="celular" pattern="\d{10}" value="<?php echo $form['celular']; ?>"></div>
	</div>
	<div>
		<label></label>
		<div style="padding-top:15px;"><input type="submit" name="a" value="<?php echo $form['accion']; ?>"></div>
	</div>	
</form>