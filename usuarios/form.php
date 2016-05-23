<?php
require('clases/usuario.class.php');
require('clases/empresa.class.php');
$usuobj = new usuario;
$empobj = new empresa;
$msg = "";
$stt = "";
$required = "";
$empresas = $empobj->mostrar_empresas();
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombre'=>'','rfc'=>'','correo'=>'','telefono'=>'','celular'=>'','usuario'=>'','clave'=>$usuobj->generar_clave(8),'accion'=>'Registrar');
	}elseif ($_GET['ac']=="editar") {
		$row = $usuobj->mostrar_usuario($_GET['id']);
		$form = array('idUsuario'=>$_GET['id'],'nombre'=>$row['nombreUsuario'],'rfc'=>'','correo'=>$row['email'],'telefono'=>'','celular'=>'','usuario'=>$row['nombreUsuario'],'clave'=>$usuobj->generar_clave(8));
		$form['accion']="Editar";
	}else{
		header('Location: view.php?com=usuarios&mod=form&ac=nuevo&stt=error');
	}
}else{
	header('Location: view.php?mod=notfound');
}

if (isset($_GET['stt'])) {
	$stt = $_GET['stt'];
	if ($stt == "error") {
		$msg = "No se pudo llevar a cabo la petición deseada.";
	}

	if ($stt == "created") {
		$msg="El usuario fue agregado correctamente.";
	}

	if ($stt == "nvuser") {
		$msg="El correo que intentas registrar ya existe en el sistema.";
	}
}
?>
<script src="usuarios/js/formulario.js"></script>
<script src="js/validacion.js"></script>
<script type="text/javascript">
	$(function() {
		$( "#correo" ).change(function() {
			var usuario = sugiere_usuario($(this).val());
			$("#usuario").val(usuario);
		});
	});
</script>
<h1>Nuevo usuario</h1>
<div class="row">
	<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
	<form action="usuarios/controlador.php" method="post" class="col-md-8 group" onsubmit="return validUsr();">
		<div class="row">
			<label class="col-md-4">* Correo electrónico: </label>
			<div class="col-md-8"><input type="email" name="correo" id="correo" value="<?php echo $form['correo']; ?>"></div>
		</div>
		<div class="row">
			<label class="col-md-4">Nombre de usuario: </label>
			<div class="col-md-8"><input type="text" name="usuario" id="usuario" pattern"^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" value="<?php echo $form['usuario']; ?>" required></div>
		</div>
		<div class="row">
			<label class="col-md-4">Empresa: </label>
			<div class="col-md-8">
				<select name="empresa" id="idEmpresa">
		        <?php 	foreach ($empresas as $empresa) { ?>
		            <option value="<?php echo $empresa['idEmpresa']; ?>"><?php echo $empresa['nombreEmpresa']; ?></option>
		    	<?php } ?>
		        </select>
			</div>
		</div>
		<div class="row">
			<?php  if($_GET['ac']=="Editar"){ $required ="required"; } ?>
			<label class="col-md-4">Contraseña: </label>
			<div class="col-md-8">
				<input type="password" name="pass" placeholder="Sugerido <?php echo $form['clave']; ?>" id="pass" <?php echo $required; ?>>
				<p style="margin-bottom:0;"><i>Sólo ingrese la contraseña si desea cambiar a la sugerida. De lo contrario, deje el campo vacío.</i></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-4">
			<?php if($_GET['ac']=="editar"){ ?>
			<input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $form['idUsuario']; ?>" required readonly />
			<?php } ?>
			<input type="submit" name="a" value="<?php echo $form['accion']; ?>">
			</div>
		</div>
	</form>
</div>
