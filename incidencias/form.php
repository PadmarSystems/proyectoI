<?php
require('clases/empleado.class.php');
$empleado = new empleado;

require('clases/incidencia.class.php');
$incidencia = new incidencia;

$msg = "Todos los campos son obligatorios.";
$stt = "aviso";

if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('folio'=>'','empleado'=>'','tipoIncidencia'=>'','motivo'=>'');
	}
}

$empleados = $empleado->mostrar_empleados();
$tiposincidencias = $incidencia->mostrar_tipo_incidencias();

?>
<script type="text/javascript" src="<?php echo $ruta; ?>incidencias/incidencias.js"></script>
<style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }
</style>
<script>
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
<h2>Registrar Incidencia</h2>
<div class="<?php echo $stt; ?>" id="msg" ><p><?php echo $msg; ?></p></div>
<form id="formIncidencia" >
	<div>
		<label>Folio: </label>
		<div><input type="text" id="folio" name="folio" value="<?php echo $form['folio'] ?>" required /></div>
	</div>
	<div>
		<div>
			<label>Empleado: </label>
			<div class="ui-widget">
		    <select id="empleado" name="empleado" >
		        <option value="">Select one...</option>
		        <?php   foreach ($empleados as $empleado) {
		        ?>
		            <option value="<?php echo $empleado['idEmpleado']; ?>"><?php echo str_replace('--',' ',$empleado['nombreEmp']); ?></option>
		        <?php   }   ?>
		    </select>
		</div>
		</div>
	</div>
	<div>
		<label>Tipo de incidencia: </label>
		<div>
			<select id="tipoIncidencia" name="tipoIncidencia" required>
				<option value="" selected disabled>Seleccione...</option>
		        <?php   foreach ($tiposincidencias as $tipo) {
		        ?>
		            <option value="<?php echo $tipo['idTipo']; ?>"><?php echo str_replace('--',' ',$tipo['tipoIncidencia']); ?></option>
		        <?php   }   ?>	
			</select>
		</div>
	</div>
	<div>
		<label>Fecha: </label>
		<div>
			<input type="date" name="fi_inc" ><input type="time" name="hi_inc">
		</div>
		<label>Hasta: </label>
		<div>
			<input type="date" name="ff_inc" ><input type="time" name="hf_inc">
		</div>
	</div>
	<div>
		<label>Motivo: </label>
		<div>
			<textarea id="motivo" name="motivo"><?php echo $form['motivo']; ?></textarea>
		</div>
	</div>
	<div>
		<div style="padding-top:15px;"><input type="button" value="Guardar" onclick="post_form();" class="icon-check"></div>
	</div>
</form>