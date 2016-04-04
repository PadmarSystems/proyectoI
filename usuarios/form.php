<?php
require('clases/usuario.class.php');
$usuobj = new usuario;
$msg = "";
$stt = "";
$perfiles = $usuobj->mostrar_perfiles('idPerfil,perfil',1,' AND idPerfil <> 1');
$estaciones = $usuobj->mostrar_estaciones('idEstacion,estacion',1);
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('nombre'=>'','rfc'=>'','correo'=>'','telefono'=>'','celular'=>'','usuario'=>'','clave'=>$usuobj->generar_clave(8),'accion'=>'Registrar');
	}elseif ($_GET['ac']=="editar") {
		//obtener id
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
		$msg = "No se pudo llevar a cabo la peticion deseada.";
	}

	if ($stt == "success") {
		$msg="El usuario fue agregado correctamente.";
	}
}
?>
<script src="usuarios/js/formulario.js"></script>
<script src="js/valida.js"></script>
<script type="text/javascript">
	$(function() {
		$( "#correo" ).change(function() {
			if (valida_email($(this).val())) {
				var usuario = sugiere_usuario($(this).val());
				$("#usuario").val(usuario);
			}
		});
	});
</script>
<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
<form action="usuarios/controlador.php" method="post">
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
	<p>Datos de acceso</p>
	<div>
		<label>Nombre de usuario:</label>
		<div><input type="text" name="usuario" id="usuario" pattern"^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" value="<?php echo $form['usuario']; ?>" required></div>
	</div>
	<div>
		<label>Contraseña:</label>
		<div><input type="text" name="pass" id="pass" value="<?php echo $form['clave']; ?>" onclick="this.select()" required></div>
	</div>
	<div>
		<label>Enviar por correo</label>
		<div><input type="checkbox" name="chkmail" id="chkmail" value="1">&nbsp(Especificar correo*)</div>
	</div>
	<div>
		<label>Perfil:</label>
		<div>
			<select name="idPerfil" id="idPerfil">
				<?php foreach ($perfiles as $perfil): ?>
					<option value="<?php echo $perfil['idPerfil']; ?>"><?php echo $perfil['perfil']; ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
	</div>
	<p>Datos de Estación</p>
	<div>
		<label>Estación:</label>
		<div>
			<select name="idEstacion" id="idEstacion">
				<?php foreach ($estaciones as $estacion): ?>
					<option value="<?php echo $estacion['idEstacion']; ?>"><?php echo $estacion['estacion']; ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
	</div>
	<div>
		<label></label>
		<div style="padding-top:15px;"><input type="submit" name="a" value="<?php echo $form['accion']; ?>"></div>
	</div>	
</form>