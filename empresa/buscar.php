<?php
$msg = "";
require('clases/usuario.class.php');
$usuobj = new usuario;
//print_r($_SESSION);
$planes = $usuobj->mostrar_planes();
if ($_SESSION['rol'] == 0) { 

if (isset($_GET['stt'])) {
	$stt = $_GET['stt'];
	if ($stt == "error") {
		$msg = "No se pudo llevar a cabo la peticion deseada.";
	}

	if ($stt == "success") {
		$msg="La empresa fue añadida correctamente.";
	}

}

?>
<script type="text/javascript">
$(function() {
  	$( "#empresa" ).change(function() {
	  $('#ubicacion').val($(this).val());
	});
});
</script>
<h1>Nueva Empresa</h1>
<div class="row">
	<div class="<?php echo $stt; ?>"><p><?php echo $msg; ?></p></div>
	<form action="empresa/guardar.php" method="post" class="col-md-8 group">
		<div class="row">
			<label class="col-md-4">Empresa *:</label>
			<div class="col-md-8"><input type="text" name="empresa" id="empresa" value="" required></div>
		</div>
		<div class="row">
			<label class="col-md-4">Ubicación *:</label>
			<div class="col-md-8"><input type="text" name="" id="ubicacion" value="" readonly required></div>
		</div>
		<div class="row">
			<label class="col-md-4">Correo *:</label>
			<div class="col-md-8"><input type="email" name="correo" id="correo" value="" required></div>
		</div>
		<div class="row">
			<label class="col-md-4">Contraseña *:</label>
			<div class="col-md-8"><input type="text" name="pass" value="<?php echo $usuobj->generar_clave(8); ?>" id="pass" required></div>
		</div>
		<div class="row">
			<label class="col-md-4">Plan: </label>
			<div class="col-md-8 ui-widget">
			    <select id="plan" name="plan" >
			        <?php 
					foreach ($planes as $row) {	?>
			            <option value="<?php echo $row['idPlan']; ?>"><?php echo str_replace('--',' ',$row['plan']); ?></option>
			        <?php } ?>
			    </select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-4">
			<input type="submit" name="a" value="Registrar">
			</div>
		</div>
	</form>
</div>

<?php } ?>