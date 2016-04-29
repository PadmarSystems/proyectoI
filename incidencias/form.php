<?php
require('clases/empleado.class.php');
$empleado = new empleado;

require('clases/incidencia.class.php');
$incidencia = new incidencia;

$msg = "Todos los campos son obligatorios.";
$stt = "aviso";
$disabled = "";
if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('folio'=>'','empleado'=>'','tipoIncidencia'=>'','motivo'=>'');
	}
}
if(isset($_GET['id'])){
	$disabled = 'disabled';
}
$empleados = $empleado->mostrar_empleados();
$tiposincidencias = $incidencia->mostrar_tipo_incidencias();
?>
<script type="text/javascript" src="<?php echo $ruta; ?>incidencias/incidencias.js"></script>
<script type="text/javascript">
  $(function() {
    /*$( "#empleado" ).autocomplete({
    	source: function(request,response){
    		$.ajax({
    			url : 'incidencias/controlador_incidencias.php',
    			dataType: "json",
    			data: {
    				term: request.term,
    				a: 'autocomplete_empleados'
    			},
    			success: function(data){
    				response($.map(data,function(item){
    					return {
    						label: item,
    						value: item
    					}
    				}));
    			}
    		});
    	},
    	autoFocus: true,
    	minLength: 0
    });*/
    $( "#empleado" ).combobox();
  });
  </script>
<h1>Registrar Incidencia</h1>
<div class="row">
	<p class="<?php echo $stt; ?>" id="msg" ><?php echo $msg; ?></p>
	<form id="formIncidencia" class="col-md-8 group">
		<div class="row">
			<label class="col-md-4">Folio: </label>
			<div class="col-md-8"><input type="text" id="folio" name="folio" value="<?php echo $form['folio'] ?>" required /></div>
		</div>
		<div class="row">
			<label class="col-md-4">Empleado: </label>
			<div class="col-md-8 ui-widget">
			    <select id="empleado" name="empleado" readonly>
			    	<?php if(!isset($_GET['id'])){ ?>
			        <option value="">Seleccionar...</option>
			        <?php }
					foreach ($empleados as $empleado) {
			        	if(isset($_GET['id']) && $empleado['idEmpleado']!=$_GET['id']) {
			        		continue;
						} ?>
			            <option value="<?php echo $empleado['idEmpleado']; ?>"><?php echo str_replace('--',' ',$empleado['nombreEmp']); ?></option>
			        <?php } ?>
			    </select>
			</div>
		</div>
		<div class="row">
			<label class="col-md-4">Tipo de incidencia: </label>
			<div class="col-md-8">
				<select id="tipoIncidencia" name="tipoIncidencia" required>
					<option value="" selected disabled>Seleccionar...</option>
			        <?php foreach ($tiposincidencias as $tipo) { ?>
			            <option value="<?php echo $tipo['idTipo']; ?>"><?php echo str_replace('--',' ',$tipo['tipoIncidencia']); ?></option>
			        <?php } ?>
				</select>
			</div>
		</div>
<<<<<<< HEAD
		<div class="row">
			<label class="col-md-4">Fecha: </label>
			<div class="col-md-4">
				<input type="date" name="fi_inc" >
			</div>
			<div class="col-md-4">
				<input type="time" name="hi_inc">
			</div>
		</div>
		<div class="row">
			<label class="col-md-4">Hasta: </label>
			<div class="col-md-4">
				<input type="date" name="ff_inc" >
			</div>
			<div class="col-md-4">
				<input type="time" name="hf_inc">
			</div>
=======
	</div>
	<div>
		<label>Tipo de incidencia: </label>
		<div>
			<select id="tipoIncidencia" name="tipoIncidencia" required onchange="procesar_incidencia(this.value);">
				<option value="" selected disabled>Seleccione...</option>
		        <?php   foreach ($tiposincidencias as $tipo) {
		        ?>
		            <option value="<?php echo $tipo['idTipo']; ?>"><?php echo str_replace('--',' ',$tipo['tipoIncidencia']); ?></option>
		        <?php   }   ?>	
			</select>
		</div>
	</div>
	<div id="a-campos"></div>
	<div>
		<label>Fecha: </label>
		<div>
			<input type="date" name="fi_inc" ><input type="time" name="hi_inc">
>>>>>>> 141b4cbdc79a2bbee95135073c5d67f2bfd92d74
		</div>
		<div class="row">
			<label class="col-md-4">Motivo: </label>
			<div class="col-md-8"><textarea id="motivo" name="motivo"><?php echo $form['motivo']; ?></textarea></div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-4"><input type="button" value="Guardar" onclick="post_form();" class="icon-check"></div>
		</div>
	</form>
</div>
