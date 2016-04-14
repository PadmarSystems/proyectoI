<?php
$msg = "Todos los campos son obligatorios.";
$stt = "aviso";

if (isset($_GET['ac'])) {
	if($_GET['ac'] == "nuevo"){
		$form = array('folio'=>'','empleado'=>'','idEmpleado'=>'','tipoIncidencia'=>'','motivo'=>'');
	}
}

?>
<script type="text/javascript" src="<?php echo $ruta; ?>incidencias/incidencias.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
  $(function() {
    $( "#empleado" ).autocomplete({
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
    });
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
		<label>Empleado: </label>
		<div>
			<input type="text" id="empleado" name="empleado" value="<?php echo $form['empleado'] ?>" required />
		</div>
	</div>
	<div>
		<label>Tipo de incidencia: </label>
		<div>
			<select id="tipoIncidencia" name="tipoIncidencia" required>
				<option value="0">Seleccione</option>
				<option value="1">Tipo 1</option>
				
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